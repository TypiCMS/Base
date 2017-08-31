/**
* @file bbcode.js
* @brief BBCode mode for CodeMirror<http://codemirror.net/>
* @author Ruslan Osmanov <rrosmanov@gmail.com>
* @version 2.0
* @date 12.10.2013
*/

CodeMirror.defineMode("bbcode", function(config) {
  var settings, m, last;

  settings = {
    bbCodeTags: "b i u s img quote code list table  tr td size color url",
    bbCodeUnaryTags: "* :-) hr cut"
  };

  if (config.hasOwnProperty("bbCodeTags")) {
    settings.bbCodeTags = config.bbCodeTags;
  }
  if (config.hasOwnProperty("bbCodeUnaryTags")) {
    settings.bbCodeUnaryTags = config.bbCodeUnaryTags;
  }

  var helpers = {
    cont: function(style, lastType) {
      last = lastType;
      return style;
    },
    escapeRegEx: function(s) {
      return s.replace(/([\:\-\)\(\*\+\?\[\]])/g, '\\$1');
    }
  };

  var regs = {
    validIdentifier: /[a-zA-Z0-9_]/,
    stringChar: /['"]/,
    tags: new RegExp("(?:" + helpers.escapeRegEx(settings.bbCodeTags).split(" ").join("|") + ")"),
    unaryTags: new RegExp("(?:" + helpers.escapeRegEx(settings.bbCodeUnaryTags).split(" ").join("|") + ")")
  };

  var parsers = {
    tokenizer: function (stream, state) {
      if (stream.eatSpace()) return null;

      if (stream.match('[', true)) {
        state.tokenize = parsers.bbcode;
        return helpers.cont("tag", "startTag");
      }

      stream.next();
      return null;
    },
    inAttribute: function(quote) {
      return function(stream, state) {
        var prevChar = null;
        var currChar = null;
        while (!stream.eol()) {
          currChar = stream.peek();
          if (stream.next() == quote && prevChar !== '\\') {
            state.tokenize = parsers.bbcode;
            break;
          }
          prevChar = currChar;
        }
        return "string";
      };
    },
    bbcode: function (stream, state) {
      if (m = stream.match(']', true)) {
        state.tokenize = parsers.tokenizer;
        return helpers.cont("tag", null);
      }

      if (stream.match('[', true)) {
        return helpers.cont("tag", "startTag");
      }

      var ch = stream.next();
      if (regs.stringChar.test(ch)) {
        state.tokenize = parsers.inAttribute(ch);
        return helpers.cont("string", "string");
      } else if (/\d/.test(ch)) {
        stream.eatWhile(/\d/);
        return helpers.cont("number", "number");
      } else {
        if (state.last == "whitespace") {
          stream.eatWhile(regs.validIdentifier);
          return helpers.cont("attribute", "modifier");
        } if (state.last == "property") {
          stream.eatWhile(regs.validIdentifier);
          return helpers.cont("property", null);
        } else if (/\s/.test(ch)) {
          last = "whitespace";
          return null;
        }

        var str = "";
        if (ch != "/") {
          str += ch;
        }
        var c = null;
        while (c = stream.eat(regs.validIdentifier)) {
          str += c;
        }
        if (regs.unaryTags.test(str)) {
            return helpers.cont("atom", "atom");
        }
        if (regs.tags.test(str)) {
            return helpers.cont("keyword", "keyword");
        }
        if (/\s/.test(ch)) {
          return null;
        }
        return helpers.cont("tag", "tag");
      }
    }
  };

  return {
    startState: function() {
      return {
        tokenize: parsers.tokenizer,
        mode: "bbcode",
        last: null
      };
    },
    token: function(stream, state) {
      var style = state.tokenize(stream, state);
      state.last = last;
      return style;
    },
    electricChars: ""
  };
});

CodeMirror.defineMIME("text/x-bbcode", "bbcode");
// vim: et ts=2 sts=2 sw=2
