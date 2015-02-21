<?php

/**
 *  Simple autoloader
 */
spl_autoload_register( function( $className ){

	list( $dir, $fileName ) = explode( '\\', $className );

	$path = __DIR__
		. DIRECTORY_SEPARATOR
		. $dir
		. DIRECTORY_SEPARATOR
		. $fileName
		. '.php'
	;

	if( file_exists( $path ) ){
		require_once( $path );
		return TRUE;
	}

	return FALSE;
});

