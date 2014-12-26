<?php return array(
	
	// Directories to search for source files
	'src_dirs' => array(
		App::make('path.public'),
	),
	
	// Maximum number of sizes to allow for a particular
	// source file.  This is to limit scripts from filling
	// up your hard drive with images.  Set to false or comment
	// out to have no limit.
	'max_crops' => 12,
	
);
