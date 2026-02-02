# Bootstrap 5.3 Mixin Reference

Complete reference for Bootstrap 5.3 SCSS mixins.

## Breakpoint Mixins

Located in `bootstrap/scss/mixins/_breakpoints.scss`

### media-breakpoint-up

Apply styles from a breakpoint and up (min-width):

```scss
@include media-breakpoint-up(sm) { }   // >= 576px
@include media-breakpoint-up(md) { }   // >= 768px
@include media-breakpoint-up(lg) { }   // >= 992px
@include media-breakpoint-up(xl) { }   // >= 1200px
@include media-breakpoint-up(xxl) { }  // >= 1400px
```

### media-breakpoint-down

Apply styles below a breakpoint (max-width):

```scss
@include media-breakpoint-down(sm) { }   // < 576px
@include media-breakpoint-down(md) { }   // < 768px
@include media-breakpoint-down(lg) { }   // < 992px
@include media-breakpoint-down(xl) { }   // < 1200px
@include media-breakpoint-down(xxl) { }  // < 1400px
```

### media-breakpoint-between

Apply styles between two breakpoints:

```scss
@include media-breakpoint-between(md, xl) { }  // >= 768px and < 1200px
```

### media-breakpoint-only

Apply styles for a single breakpoint range:

```scss
@include media-breakpoint-only(md) { }  // >= 768px and < 992px
```

## Button Mixins

Located in `bootstrap/scss/mixins/_buttons.scss`

### button-variant

Create a button style with all states:

```scss
@include button-variant(
    $background,           // Normal state background
    $border,               // Normal state border
    $color: color-contrast($background),  // Text color (auto-calculated if omitted)
    $hover-background: if($color == $color-contrast-light, shade-color($background, $btn-hover-bg-shade-amount), tint-color($background, $btn-hover-bg-tint-amount)),
    $hover-border: if($color == $color-contrast-light, shade-color($border, $btn-hover-border-shade-amount), tint-color($border, $btn-hover-border-tint-amount)),
    $hover-color: color-contrast($hover-background),
    $active-background: if($color == $color-contrast-light, shade-color($background, $btn-active-bg-shade-amount), tint-color($background, $btn-active-bg-tint-amount)),
    $active-border: if($color == $color-contrast-light, shade-color($border, $btn-active-border-shade-amount), tint-color($border, $btn-active-border-tint-amount)),
    $active-color: color-contrast($active-background),
    $disabled-background: $background,
    $disabled-border: $border,
    $disabled-color: color-contrast($disabled-background)
);
```

### button-outline-variant

Create an outline button style:

```scss
@include button-outline-variant(
    $color,                    // Border and text color
    $color-hover: color-contrast($color),  // Hover text
    $active-background: $color,
    $active-border: $color,
    $active-color: color-contrast($active-background)
);
```

### button-size

Set button dimensions:

```scss
@include button-size(
    $padding-y,
    $padding-x,
    $font-size,
    $border-radius
);
```

## Grid Mixins

Located in `bootstrap/scss/mixins/_grid.scss`

### make-container

Create a container element:

```scss
@include make-container($padding-x: $container-padding-x);
```

### make-container-max-widths

Apply max-width constraints at each breakpoint:

```scss
@include make-container-max-widths(
    $max-widths: $container-max-widths,
    $breakpoints: $grid-breakpoints
);
```

### make-row

Create a row element:

```scss
@include make-row($gutter: $grid-gutter-width);
```

### make-col-ready

Prepare an element to be a column:

```scss
@include make-col-ready();
```

### make-col

Set column width:

```scss
@include make-col($size: false, $columns: $grid-columns);

// Examples
@include make-col(6);   // 50% width (6 of 12 columns)
@include make-col(4);   // 33.333% width
@include make-col(auto); // Auto width
```

### make-col-offset

Add column offset:

```scss
@include make-col-offset($size, $columns: $grid-columns);
```

## Border Mixins

Located in `bootstrap/scss/mixins/_border-radius.scss`

```scss
@include border-radius($radius: $border-radius, $fallback-border-radius: false);
@include border-top-radius($radius: $border-radius);
@include border-end-radius($radius: $border-radius);
@include border-bottom-radius($radius: $border-radius);
@include border-start-radius($radius: $border-radius);
@include border-top-start-radius($radius: $border-radius);
@include border-top-end-radius($radius: $border-radius);
@include border-bottom-end-radius($radius: $border-radius);
@include border-bottom-start-radius($radius: $border-radius);
```

## Box Shadow Mixin

Located in `bootstrap/scss/mixins/_box-shadow.scss`

```scss
@include box-shadow($shadow...);

// Examples
@include box-shadow($box-shadow);
@include box-shadow($box-shadow-sm);
@include box-shadow($box-shadow-lg);
@include box-shadow(0 0.5rem 1rem rgba($black, 0.15));
@include box-shadow(none);  // Remove shadow
```

## Transition Mixin

Located in `bootstrap/scss/mixins/_transition.scss`

```scss
@include transition($transition...);

// Examples
@include transition($transition-base);  // all .2s ease-in-out
@include transition($transition-fade);  // opacity .15s linear
@include transition(transform .3s ease, opacity .2s linear);
```

## Gradient Mixins

Located in `bootstrap/scss/mixins/_gradients.scss`

```scss
// Enable gradients background on a color
@include gradient-bg($color: null);

// Horizontal gradient (left to right)
@include gradient-x(
    $start-color: $gray-700,
    $end-color: $gray-800,
    $start-percent: 0%,
    $end-percent: 100%
);

// Vertical gradient (top to bottom)
@include gradient-y(
    $start-color: $gray-700,
    $end-color: $gray-800,
    $start-percent: 0%,
    $end-percent: 100%
);

// Directional gradient
@include gradient-directional(
    $start-color: $gray-700,
    $end-color: $gray-800,
    $deg: 45deg
);

// Radial gradient
@include gradient-radial(
    $inner-color: $gray-700,
    $outer-color: $gray-800
);

// Striped gradient (for progress bars)
@include gradient-striped($color: rgba($white, .15), $angle: 45deg);
```

## Typography Mixins

### font-size (RFS)

Located in `bootstrap/scss/vendor/_rfs.scss`

Responsive font sizes that scale smoothly:

```scss
@include font-size($value);

// Examples
@include font-size(2rem);     // Scales responsively
@include font-size(24px);     // Also scales
@include font-size(1.5rem !important);  // With !important
```

### text-truncate

Single line text with ellipsis:

```scss
@include text-truncate();
```

## Visibility Mixins

Located in `bootstrap/scss/mixins/_visually-hidden.scss`

```scss
// Hide visually but keep accessible to screen readers
@include visually-hidden();

// Hide but show on focus (skip links)
@include visually-hidden-focusable();
```

## Form Mixins

Located in `bootstrap/scss/mixins/_forms.scss`

### form-validation-state

Create custom form validation styles:

```scss
@include form-validation-state(
    $state,      // "valid" or "invalid"
    $color,
    $icon,
    $tooltip-color: color-contrast($color),
    $tooltip-bg-color: rgba($color, $form-feedback-tooltip-opacity),
    $focus-box-shadow: 0 0 $input-btn-focus-blur $input-focus-width rgba($color, $input-btn-focus-color-opacity),
    $border-color: $color
);
```

## Image Mixins

Located in `bootstrap/scss/mixins/_image.scss`

```scss
// Responsive images
@include img-fluid();

// Retina image backgrounds
@include img-retina($file-1x, $file-2x, $width-1x, $height-1x);
```

## Clearfix

Located in `bootstrap/scss/mixins/_clearfix.scss`

```scss
@include clearfix();
```

## Reset Mixins

### reset-text

Reset text styles:

```scss
@include reset-text();
```

### list-unstyled

Remove list styles:

```scss
ul {
    @include list-unstyled();
}
```

## Caret Mixin

Create dropdown carets:

```scss
@include caret($direction: down);  // down, up, end, start
```

## Color Functions

Bootstrap provides helpful color functions:

```scss
// Lighten a color
$lighter: tint-color($primary, 20%);

// Darken a color
$darker: shade-color($primary, 20%);

// Shift color (auto light/dark based on lightness)
$shifted: shift-color($color, $weight);

// Get contrasting text color (black or white)
$text: color-contrast($background);

// Mix colors
$mixed: mix($color1, $color2, $weight);
```

## CSS Variables Access

Access Bootstrap CSS custom properties:

```scss
.element {
    color: var(--bs-primary);
    background: var(--bs-body-bg);
    font-family: var(--bs-body-font-family);
    border-radius: var(--bs-border-radius);
}
```

## Spacing Variables

Use spacing scale variables:

```scss
// $spacer = 1rem by default
$spacer * .25   // 0.25rem
$spacer * .5    // 0.5rem
$spacer         // 1rem
$spacer * 1.5   // 1.5rem
$spacer * 3     // 3rem

// Or use the map
map-get($spacers, 1)  // 0.25rem
map-get($spacers, 2)  // 0.5rem
map-get($spacers, 3)  // 1rem
map-get($spacers, 4)  // 1.5rem
map-get($spacers, 5)  // 3rem
```

## Z-Index Scale

Use consistent z-index values:

```scss
$zindex-dropdown:       1000;
$zindex-sticky:         1020;
$zindex-fixed:          1030;
$zindex-offcanvas-backdrop: 1040;
$zindex-offcanvas:      1045;
$zindex-modal-backdrop: 1050;
$zindex-modal:          1055;
$zindex-popover:        1070;
$zindex-tooltip:        1080;
$zindex-toast:          1090;
```
