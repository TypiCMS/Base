<?php return array(
	
	/**
	 * Directories to search for source files
	 */
	'src_dirs' => array(
		app()->make('path.public'),
	),
	
	/**
	 * Maximum number of sizes to allow for a particular
	 * source file.  This is to limit scripts from filling
	 * up your hard drive with images.  Set to false or comment
	 * out to have no limit.
	 */
	'max_crops' => 12,

	/**
	 * The jpeg quality of generated images.  The difference between
	 * 100 and 95 usually cuts the file size in half.  Going down to
	 * 70 looks ok on photos and will reduce filesize by more than another
	 * half but on vector files there is noticeable aliasing.
	 */
	'jpeg_quality' => 95,

	/**
	 * Turn on interlacing to make progessive jpegs
	 */
	'interlace' => true,

	/**
	 * Optional. Specify the host for Croppa::url() to use when generating
	 * absolute paths to images.  If undefined and using Laravel, 
	 * the `Request::host()` is used by default.
	 */
	// 'host' => 'http://mydomain.com',
	
	/**
	 * Optional. Specify the route to the document_root of your app.  If undefined
	 * and using Laravel, the `public_path()` is used by default.
	 */
	// 'public' => '/absolute/path/to/document_root',

	/**
	 * Optional. Ignore cropping for image URLs that match a regular 
	 * expression. Useful for returning animated gifs.
	 */
	 // 'ignore' => '.+\.gif$', 
	
);