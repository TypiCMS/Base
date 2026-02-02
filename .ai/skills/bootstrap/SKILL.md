---
name: Bootstrap 5.3 SCSS
description: This skill should be used when the user asks to "style a component", "add CSS", "write SCSS", "create styles", "use Bootstrap", mentions responsive design, breakpoints, spacing utilities, or wants to customize Bootstrap components with SCSS.
version: 1.0.0
---

# Bootstrap 5.3 SCSS Development

This skill provides guidance for writing SCSS with Bootstrap 5.3, emphasizing the use of mixins over utility classes for maintainable, semantic code.

## Core Principle

**Prefer Bootstrap mixins over utility classes in SCSS files.** Utility classes are for HTML prototyping; mixins create cleaner, more maintainable stylesheets.

## Project Setup

Bootstrap is imported modularly in `resources/scss/public/_bootstrap.scss`:
- Functions, variables, maps, mixins, and utilities are imported first
- Only needed components are imported (card, carousel, spinners are disabled)
- Custom SCSS files have access to all Bootstrap mixins and variables

## Essential Mixins

### Responsive Breakpoints

Use `media-breakpoint-*` mixins instead of writing media queries manually:

```scss
.my-component {
    padding: 1rem;

    @include media-breakpoint-up(md) {
        padding: 2rem;
    }

    @include media-breakpoint-up(lg) {
        padding: 3rem;
    }

    @include media-breakpoint-down(sm) {
        padding: 0.5rem;
    }

    @include media-breakpoint-between(md, xl) {
        padding: 2.5rem;
    }
}
```

**Available breakpoints:** `sm` (576px), `md` (768px), `lg` (992px), `xl` (1200px), `xxl` (1400px)

### Spacing Utilities

Use spacing mixins instead of utility classes:

```scss
// Instead of class="mt-3 mb-4 px-2"
.my-component {
    @include margin-top(1rem);
    @include margin-bottom(1.5rem);
    @include padding-x(0.5rem);
}

// Available spacing mixins:
@include margin($value);
@include margin-top($value);
@include margin-bottom($value);
@include margin-start($value);  // LTR: left, RTL: right
@include margin-end($value);
@include margin-x($value);      // horizontal
@include margin-y($value);      // vertical

@include padding($value);
@include padding-top($value);
@include padding-bottom($value);
@include padding-start($value);
@include padding-end($value);
@include padding-x($value);
@include padding-y($value);
```

### Typography

```scss
.heading {
    @include font-size(2rem);      // Responsive font-size with RFS
    @include rfs(24px);            // Alternative RFS syntax
}
```

### Buttons

Use `button-variant` for custom button styles:

```scss
.btn-custom {
    @include button-variant(
        $background,           // background color
        $border,               // border color
        $color,                // text color
        $hover-background,     // hover background
        $hover-border,         // hover border
        $hover-color,          // hover text
        $active-background,    // active/pressed background
        $active-border,        // active border
        $active-color          // active text
    );
}

// Outline variant
.btn-outline-custom {
    @include button-outline-variant(
        $color,
        $color-hover,
        $active-background,
        $active-border,
        $active-color
    );
}
```

### Shadows

```scss
.card {
    @include box-shadow($box-shadow);        // Default shadow
    @include box-shadow($box-shadow-sm);     // Small shadow
    @include box-shadow($box-shadow-lg);     // Large shadow

    // Custom shadow
    @include box-shadow(0 10px 20px rgba($primary, 0.1));
}
```

### Transitions

```scss
.animated {
    @include transition($transition-base);   // Default transition
    @include transition($transition-fade);   // Fade transition

    // Custom transition
    @include transition(transform 0.3s ease, opacity 0.2s);
}
```

### Gradients

```scss
.gradient-bg {
    @include gradient-bg($primary);

    // Directional gradients
    @include gradient-x($start-color, $end-color);
    @include gradient-y($start-color, $end-color);
    @include gradient-directional($start-color, $end-color, $deg);
}
```

### Borders

```scss
.bordered {
    @include border-radius($border-radius);
    @include border-radius($border-radius-lg);
    @include border-top-radius($radius);
    @include border-bottom-radius($radius);
    @include border-start-radius($radius);
    @include border-end-radius($radius);
}
```

### Truncation

```scss
.truncated-text {
    @include text-truncate();  // Single line with ellipsis
}
```

### Visually Hidden

```scss
.sr-only {
    @include visually-hidden();

    // Focusable when using keyboard
    @include visually-hidden-focusable();
}
```

### Grid

```scss
.custom-container {
    @include make-container();
    @include make-container-max-widths();
}

.custom-row {
    @include make-row();
}

.custom-col {
    @include make-col-ready();
    @include make-col(6);  // 6 columns wide

    @include media-breakpoint-up(lg) {
        @include make-col(4);
    }
}
```

## Bootstrap Variables

Use Bootstrap variables for consistency:

```scss
// Colors
color: $primary;
color: $secondary;
background: $gray-100;

// Spacing (based on $spacer: 1rem)
padding: $spacer;           // 1rem
margin: $spacer * 1.5;      // 1.5rem

// Border radius
border-radius: $border-radius;      // 0.375rem
border-radius: $border-radius-sm;   // 0.25rem
border-radius: $border-radius-lg;   // 0.5rem
border-radius: $border-radius-pill; // 50rem

// Shadows
box-shadow: $box-shadow;
box-shadow: $box-shadow-sm;
box-shadow: $box-shadow-lg;

// Transitions
transition: $transition-base;       // all .2s ease-in-out
transition: $transition-fade;       // opacity .15s linear

// Z-index
z-index: $zindex-dropdown;    // 1000
z-index: $zindex-modal;       // 1055
z-index: $zindex-tooltip;     // 1080
```

## Extending Bootstrap Classes

Use `@extend` for Bootstrap utility classes in SCSS:

```scss
.my-container {
    @extend .container-md;
}

.my-flex {
    @extend .d-flex;
    @extend .align-items-center;
}
```

## Anti-Patterns to Avoid

### Bad: Utility classes in SCSS
```scss
// Don't do this
.component {
    @extend .mt-3;
    @extend .p-4;
    @extend .bg-primary;
}
```

### Good: Use mixins and variables
```scss
// Do this instead
.component {
    @include margin-top(1rem);
    @include padding(1.5rem);
    background-color: $primary;
}
```

### Bad: Hardcoded breakpoints
```scss
// Don't do this
@media (min-width: 768px) {
    // styles
}
```

### Good: Use breakpoint mixins
```scss
// Do this instead
@include media-breakpoint-up(md) {
    // styles
}
```

## Additional Resources

### Reference Files

For detailed mixin documentation:
- **`references/mixin-reference.md`** - Complete Bootstrap 5.3 mixin reference
