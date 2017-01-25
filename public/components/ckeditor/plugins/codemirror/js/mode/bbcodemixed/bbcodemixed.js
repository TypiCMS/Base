CodeMirror.defineMode("bbcodemixed", function(config) {
  var settings, regs, helpers, parsers,
  htmlMixedMode = CodeMirror.getMode(config, "htmlmixed"),
  bbcodeMode = CodeMirror.getMode(config, "bbcode"),

  settings = {
    bbCodeLiteral: 'literal'
  };
  if (config.hasOwnProperty("bbCodeLiteral")) {
    settings.bbCodeLiteral = config.bbCodeLiteral;
  }

  function escapeRegExp(s) {
    return s.replace(/([\[\]\.\-\+\<\>\?\:\(\)\{\}])/g, '\\$1');
  }

  regs = {
    hasLeftDelimeter: /.*\[/,
    htmlHasLeftDelimeter: /[^\<\>]*\[/,
    literalOpen: new RegExp(escapeRegExp("[" + settings.bbCodeLiteral + "]")),
    literalClose: new RegExp(escapeRegExp("[/" + settings.bbCodeLiteral + "]"))
  };

  helpers = {
    chain: function(stream, state, parser) {
      state.tokenize = parser;
      return parser(stream, state);
    },

    cleanChain: function(stream, state, parser) {
      state.tokenize = null;
      state.localState = null;
      state.localMode = null;
      return (typeof parser == "string") ? (parser ? parser : null) : parser(stream, state);
    },

    maybeBackup: function(stream, pat, style) {
      pat = escapeRegExp(pat);
      var cur = stream.current();
      var close = cur.search(pat),
      m;
      if (close > - 1) stream.backUp(cur.length - close);
      else if (m = cur.match(/<\/?$/)) {
        stream.backUp(cur.length);
        if (!stream.match(pat, false)) stream.match(cur[0]);
      }
      return style;
    }
  };

  parsers = {
    html: function(stream, state) {
      if (!state.inLiteral && stream.match(regs.htmlHasLeftDelimeter, false) && state.htmlMixedState.htmlState.tagName === null) {
        state.tokenize = parsers.bbcode;
        state.localMode = bbcodeMode;
        state.localState = bbcodeMode.startState(htmlMixedMode.indent(state.htmlMixedState, ""));
        return helpers.maybeBackup(stream, "[", bbcodeMode.token(stream, state.localState));
      } else if (!state.inLiteral && stream.match("[", false)) {
        state.tokenize = parsers.bbcode;
        state.localMode = bbcodeMode;
        state.localState = bbcodeMode.startState(htmlMixedMode.indent(state.htmlMixedState, ""));
        return helpers.maybeBackup(stream, "[", bbcodeMode.token(stream, state.localState));
      }
      return htmlMixedMode.token(stream, state.htmlMixedState);
    },

    bbcode: function(stream, state) {
      if (stream.match("]", false)) {
        stream.eat("]");
        state.tokenize = parsers.html;
        state.localMode = htmlMixedMode;
        state.localState = state.htmlMixedState;
        return "tag";
        //return bbcodeMode.token(stream, state);
      }

      return helpers.maybeBackup(stream, "]", bbcodeMode.token(stream, state.localState));
    },

    inBlock: function(style, terminator) {
      return function(stream, state) {
        while (!stream.eol()) {
          if (stream.match(terminator)) {
            helpers.cleanChain(stream, state, "");
            break;
          }
          stream.next();
        }
        return style;
      };
    }
  };

  return {
    startState: function() {
      var state = htmlMixedMode.startState();
      return {
        token: parsers.html,
        localMode: null,
        localState: null,
        htmlMixedState: state,
        tokenize: null,
        inLiteral: false
      };
    },

    copyState: function(state) {
      var local = null, tok = (state.tokenize || state.token);
      if (state.localState) {
        local = CodeMirror.copyState((tok != parsers.html ? bbcodeMode : htmlMixedMode), state.localState);
      }
      return {
        token: state.token,
        tokenize: state.tokenize,
        localMode: state.localMode,
        localState: local,
        htmlMixedState: CodeMirror.copyState(htmlMixedMode, state.htmlMixedState),
        inLiteral: state.inLiteral
      };
    },

    token: function(stream, state) {
      if (stream.match("[", false)) {
        if (!state.inLiteral && stream.match(regs.literalOpen, true)) {
          state.inLiteral = true;
          return "keyword";
        } else if (state.inLiteral && stream.match(regs.literalClose, true)) {
          state.inLiteral = false;
          return "keyword";
        }
      }
      if (state.inLiteral && state.localState != state.htmlMixedState) {
        state.tokenize = parsers.html;
        state.localMode = htmlMixedMode;
        state.localState = state.htmlMixedState;
      }

      var style = (state.tokenize || state.token)(stream, state);
      return style;
    },

    indent: function(state, textAfter) {
      if (state.localMode == bbcodeMode
          || (state.inLiteral && !state.localMode)
        || regs.hasLeftDelimeter.test(textAfter)) {
          return CodeMirror.Pass;
      }
      return htmlMixedMode.indent(state.htmlMixedState, textAfter);
    },

    innerMode: function(state) {
      return {
        state: state.localState || state.htmlMixedState,
        mode: state.localMode || htmlMixedMode
      };
    }
  };
}, "xml", "javascript", "css");

CodeMirror.defineMIME("text/x-bbcode", "bbcodemixed");
// vim: et ts=2 sts=2 sw=2
