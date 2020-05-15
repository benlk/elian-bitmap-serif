#! /usr/bin/env bash
montage glyphs/* -geometry +0+0 -tile 9x tileset.png
php -f generate-character-list.php > character-list.txt
