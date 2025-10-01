import { mergeAttributes, Node } from '@tiptap/core';
import { Plugin } from '@tiptap/pm/state';

export const Figure = Node.create({
    name: 'figure',

    addOptions() {
        return {
            HTMLAttributes: {},
        };
    },

    group: 'block',

    content: 'image figcaption',

    draggable: true,

    isolating: true,

    parseHTML() {
        return [
            {
                tag: `figure`,
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return ['figure', mergeAttributes(HTMLAttributes, {}), 0];
    },

    addProseMirrorPlugins() {
        return [
            new Plugin({
                props: {
                    handleDOMEvents: {
                        // prevent dragging nodes out of the figure
                        dragstart: (view, event) => {
                            if (!event.target) {
                                return false;
                            }

                            const pos = view.posAtDOM(event.target as HTMLElement, 0);
                            const $pos = view.state.doc.resolve(pos);

                            if ($pos.parent.type === this.type) {
                                event.preventDefault();
                            }

                            return false;
                        },
                    },
                },
            }),
        ];
    },
});
