import { mergeAttributes, Node, wrappingInputRule } from '@tiptap/core';

export interface DivOptions {
    /**
     * The HTML attributes for a div node.
     * @default {}
     * @example { class: 'foo' }
     */
    HTMLAttributes: Record<string, any>;
}

declare module '@tiptap/core' {
    interface Commands<ReturnType> {
        div: {
            /**
             * Set a div node
             */
            setDiv: () => ReturnType;
            /**
             * Toggle a div node
             */
            toggleDiv: () => ReturnType;
            /**
             * Unset a div node
             */
            unsetDiv: () => ReturnType;
        };
    }
}

/**
 * Matches a div to a `>` as input.
 */
export const inputRegex = /^\s*>\s$/;

/**
 * This extension allows you to create divs.
 */
export const Div = Node.create<DivOptions>({
    name: 'div',

    addOptions() {
        return {
            HTMLAttributes: {},
        };
    },

    content: 'block+',

    group: 'block',

    defining: true,

    parseHTML() {
        return [
            {
                tag: 'div',
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return ['div', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), 0];
    },

    addAttributes() {
        return {
            class: {
                default: null,
                renderHTML: (attributes) => {
                    return {
                        class: attributes.class || null,
                    };
                },
            },
        };
    },

    addCommands() {
        return {
            setDiv:
                () =>
                ({ commands }) => {
                    return commands.wrapIn(this.name);
                },
            toggleDiv:
                () =>
                ({ commands }) => {
                    return commands.toggleWrap(this.name);
                },
            unsetDiv:
                () =>
                ({ commands }) => {
                    return commands.lift(this.name);
                },
        };
    },

    addKeyboardShortcuts() {
        return {
            'Mod-Shift-d': () => this.editor.commands.toggleDiv(),
        };
    },

    addInputRules() {
        return [
            wrappingInputRule({
                find: inputRegex,
                type: this.type,
            }),
        ];
    },
});
