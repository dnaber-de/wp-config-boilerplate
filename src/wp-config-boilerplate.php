<?php # -*- coding: utf-8 -*-

namespace WpConfigBoilerplate;

use
	Exception;

/**
 * @param array $config
 *
 * @return callable
 */
function fileRequest( array $config = [] ) {

	return function( $url ) use ( $config ) {
		$curl = curl_init( (string) $url );
		curl_setopt_array(
			$curl,
			[
				CURLOPT_HTTPGET        => TRUE,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_TIMEOUT        => $config[ 'curl_timeout' ]
			]
		);
		$result = curl_exec( $curl );
		$status = (int) curl_getinfo( $curl, CURLINFO_HTTP_CODE );
		if ( 200 !== $status ) {
			throw new Exception( "Request to {$url} failed. Status: {$status}" );
		}
		if ( curl_errno( $curl ) ) {
			throw new Exception( curl_error( $curl ) );
		}
		curl_close( $curl );

		return $result;
	};
}

/**
 * @param array $config
 *
 * @return callable
 */
function constantSanitizer( array $config = [] ) {

	/**
	 * Converts `define('CONST', 'VALUE');` to `const CONST = 'VALUE'`;
	 *
	 * @param string $salts
	 *
	 * @return string
	 */
	return function( $salts ) use ( $config ) {

		// https://regex101.com/r/eQ1zL7/1 ;)
		$pattern = '~^\s?define\s?\(\s?([\'"])([A-Z_]+)\1,(\s+)([\'"])(.+)\4\s?\)\s?;$~m';
		$salts = str_replace( "\r\n", "\n", (string) $salts );
		$salts = preg_replace( $pattern, 'const $2 $3 = $4$5$4;', $salts );

		return $salts;
	};
}

/**
 * @param resource $stream
 * @param array    $config
 *
 * @return callable
 */
function printer( $stream, array $config = [] ) {

	/**
	 * prints a string
	 *
	 * @param string $string
	 */
	return function( $string ) use ( $stream, $config ) {

		if ( $config[ 'quiet' ] )
			return;
		fwrite( $stream, $string );
	};
}

/**
 * @param callable $printer
 *
 * @return callable
 */
function linePrinter( $printer ) {

	/**
	 * Prints a single line
	 *
	 * @param string $string
	 */
	return function ( $string ) use ( $printer ) {

		$string = str_replace( [ "\r", "\n" ], ' ', (string) $string );

		$printer( $string . PHP_EOL );
	};
}

/**
 * @param callable $printer
 *
 * @return callable
 */
function helper( $printer, array $config ) {

	return function () use ( $printer, $config ) {

		$help = <<<OUT
WP Config Bootstrap {$config['version']}
License: MIT

Creates a wp-config.php template with random security salts.

Usage:
    wpconfig [options] [<file_name>]

Arguments: 
    [<file_name>]   If specified, this file will be created. By default
                    a `wp-config.php` will be created in your current working directory.
    
Options:

    -h|--help   Print this help text
    -q|--quiet  Suppress any output

OUT;

		if ( $config[ 'quiet' ] ) {
			// options are '-h -q'
			echo "ಠ_ಠ Srsly?\n";
		}

		$printer( $help );
	};
}

/**
 * @param array $argv
 *
 * @return array
 */
function parseArgs( array $argv, $version ) {

	$arguments = [];
	array_shift( $argv ); //strip script name
	if ( in_array( '-h', $argv ) || in_array( '--help', $argv ) ) {
		$arguments[ 'is_help' ] = TRUE;
	}
	if ( in_array( '-q', $argv ) || in_array( '--quiet', $argv ) ) {
		$arguments[ 'quiet' ] = TRUE;
	}

	$file = array_pop( $argv );
	if ( ! empty( $file ) && '-' !== substr( $file, 0, 1 ) ) {
		// last parameter isn't an option like -q or -h so we treat it as path
		$directory = realpath( dirname( $file ) );
		if ( FALSE === $directory ) {
			throw new Exception( "Can't resolve the path {$file} to a directory" );
		}
		$filename  = basename( $file );
		$arguments[ 'file' ] = "{$directory}/{$filename}";
	}

	// defaults
	$arguments += [
		'is_help'      => FALSE,
		'quiet'        => FALSE,
		'file'         => getcwd() . '/wp-config.php',
		'curl_timeout' => 5,
		'version'      => $version
	];

	
	return $arguments;
}

/**
 * @param string $file
 * @param array  $config
 *
 * @return callable
 */
function fileWriter( $file, array $config ) {

	/**
	 * Write content to file
	 *
	 * @param string $content
	 */
	return function ( $content ) use( $file, $config ) {

		file_put_contents( $file, $content );
	};
}