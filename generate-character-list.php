<?php
/**
 * For the purpose of generating a list of characters, to be fed into https://yal.cc/r/20/pixelfont/
 * Assumes:
 * - that the tile is 9 rows wide
 * - that the files are contained in glyphs/
 */

/**
 * Turn an array of characters into a string terminated by a newline
 *
 * @param Array $row Array of single characters
 * @echo
 */
function output_row( $row ) {
	return implode( $row, '' ) . "\n";
}

/**
 * Draw from the AGLFN to create an array of character name lookups
 *
 * @uses fgetcsv
 *
 * @return Array of Glyph name => 
 */
function generate_lookup_table() {

	$semicolon_delimited = file( './agl-aglfn/aglfn.txt' );
	foreach ( $semicolon_delimited as $iterator => $row ) {
		if ( '#' === substr( $row, 0, 1 ) ) {
			unset( $semicolon_delimited[$iterator] );
		}
	}

	$lookup_table = array();

	foreach ( $semicolon_delimited as $row ) {
		$array = str_getcsv( $row, ';' );
		// there are three items in this $array at this time:
		//  (1) Standard UV or CUS UV--four uppercase hexadecimal digits
		//  (2) Glyph name--upper/lowercase letters and digits
		//  (3) Character names: Unicode character names for standard UVs, and
		//      descriptive names for CUS UVs--uppercase letters, hyphen, and
		//      space
		//
		// Now, we turn that into 2 => 1
		$lookup_table[$array[1]] = $array[0];
	}

	return $lookup_table;
}

/**
 * Load the files, generate the lists
 *
 * @return text of the character list
 */
function main() {
	$path = './glyphs/';
	$files = scandir( $path );
	$files = array_diff( $files, array( '.', '..' ) );

	$row = array();
	$lookup_table = generate_lookup_table();

	ob_start();

	try {
		foreach ( $files as $file ) {
			if ( count( $row ) === 9 ) {
				echo output_row( $row );
				$row = array();
			}

			$glyph_name = basename( $file, '.png' );
			$uv = $lookup_table[$glyph_name];

			// convert hex code to character:
			// https://stackoverflow.com/a/6058533
			$character = json_decode(sprintf(
				'"\u%1$s"',
				$uv
			));

			$row[] = $character;
		}
	} finally {
		echo output_row( $row );
	}

	return ob_get_clean();
}

echo main();
