<?php

return [

    /*
    |-----------------------------------------------------------------------------
    | Image source and crop destination
    |-----------------------------------------------------------------------------
    */

    /*
     * The directory where source images are found.  This is generally where your
     * admin stores uploaded files.  Can be either an absolute path to your local
     * disk (the default) or the name of an IoC binding of a Flysystem instance.
     *
     * @var string     Absolute path in local fileystem
     *      | string   IoC binding name of League\Flysystem\Filesystem
     *      | string   IoC binding name of League\Flysystem\Cached\CachedAdapter
     */
    'src_dir' => public_path().'/uploads',

    /*
     * The directory where cropped images should be saved.  The route to the
     * cropped versions is what should be rendered in your markup; it must be a
     * web accessible directory.
     *
     * @var string     Absolute path in local fileystem
     *      | string   IoC binding name of League\Flysystem\Filesystem
     *      | string   IoC binding name of League\Flysystem\Cached\CachedAdapter
     */
    'crops_dir' => public_path().'/uploads',

    /*
     * Maximum number of sizes to allow for a particular source file.  This is to
     * limit scripts from filling up your hard drive with images.  Set to falsey or
     * comment out to have no limit.  This is disabled by default because the
     * `signing_key` is a better prevention of malicilous usage.
     *
     * @var integer | boolean
     */
    'max_crops' => false,

    /*
    |-----------------------------------------------------------------------------
    | URL parsing and generation
    |-----------------------------------------------------------------------------
    */

    /*
     * A regex pattern that is applied to both the src url passed to
     * `Croppa::url()` as well as the crop path receieved when handling a crop
     * request to find the path to the src image relative to both the src_dir
     * and crops_dirs. This path will be used to find the source image in the
     * src_dir. The path component of  the regex must exist in the first captured
     * subpattern.  In other words, in the `preg_match` $matches[1].
     *
     * @var string
     */
    'path' => 'uploads/(.*)$',

    /*
     * A regex pattern that works like `path` except it is only used by the
     * `Croppa::url($url)` generator function.  If the $path url matches, it is
     * passed through with no Croppa URL suffixes added.  Thus, it will not be
     * cropped.  This is designed, in particular, for animated gifs which lose
     * animation when cropped.
     *
     * @var string
     */
    'ignore' => '\.(gif|GIF)$',

    /*
     * A string that is prepended to the path captured by the `path` pattern
     * (above) that is used to from the URL to crops.
     */
    // 'url_prefix' =>  '//'.Request::getHttpHost().'/uploads/',        // Local
    // 'url_prefix' => 'https://your-bucket.s3.amazonaws.com/uploads/', // S3

    /*
     * Reject attempts to maliciously create images by signing the generated the
     * request with a hash based on the request parameters and this signing key.
     * Set to 'app.key' to use Laravel's `app.key` config, any other string to use
     * THAT as the key, or false to disable.
     *
     * If you are generating URLs outside of `Croppa::url()`, like the croppa.js
     * module, you can disable this feature by setting the `signing_key` config
     * to false.
     *
     * @var string|boolean
     */
    'signing_key' => 'app.key',

    /*
    |-----------------------------------------------------------------------------
    | Image settings
    |-----------------------------------------------------------------------------
    */

    /*
     * The jpeg quality of generated images.  The difference between 100 and 95
     * usually cuts the file size in half.  Going down to 70 looks ok on photos
     * and will reduce filesize by more than another half but on vector files
     * there is noticeable aliasing.
     *
     * @var integer
     */
    'jpeg_quality' => 95,

    /*
     * Turn on interlacing to make progessive jpegs
     *
     * @var boolean
     */
    'interlace' => true,

    /*
     * If the source image is smaller than the requested size, allow Croppa to
     * scale up the image. This will reduce in quality loss.
     *
     * @var boolean
     */
    'upscale' => true,

];
