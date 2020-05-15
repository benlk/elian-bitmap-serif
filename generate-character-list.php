<?php
/**
 * For the purpose of generating a list of characters, to be fed into https://yal.cc/r/20/pixelfont/
 * Assumes:
 * - that the tile is 9 rows wide
 * - that the files are contained in glyphs/
 */
$path = './glyphs/';
$files = scandir( $path );
$files = array_diff( $files, array( '.', '..' ) );

function output_row( $row ) {
	echo implode( $row, '' ) . "\n";
}

$row = array();

ob_start();

try {
	foreach ( $files as $file ) {
		if ( count( $row ) === 9 ) {
			output_row( $row );
			$row = array();
		}

		$row[] = basename( $file, '.png' );
	}
} finally {
	output_row( $row );
}

echo ob_get_clean();
