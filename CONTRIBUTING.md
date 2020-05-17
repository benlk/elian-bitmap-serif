# So you want to add to this font

Thank you!

## Adding glyphs to the font:

You'll want:
- an art program
- a standard that describes what the glyph file should be named, which is one of these two:
	- https://github.com/adobe-type-tools/agl-aglfn/blob/master/aglfn.txt
	- a pull request that adds a second definitions file to this repo beyond `aglfn.txt` and incorporates that into `generate-character-list.png`

Your glyph files should be `21x21` PNG files with a white background. The glyph should be marked in black.

Rules of thumb:
- Uppercase glyphs are 15 (preferable) or 21 pixels tall.
- Lowercase glyphs are 9 (preferable) or 15 pixels tall.
- Letters and numbers are drawn with a 3px stroke width
- Punctuation and symbols are generally drawn with a 1px stroke width. Solids are hollow, if possible.

Optional, but highly recommended:
1. Obtain a computer capable of running `php -f generate-character-list.php`. See notes in that file for the requirements to run it.
2. Add your glyph to `glyphs/`, named according to the standard described above
3. Run `php -f generate-character-list.php`
4. Run the generated files through https://yal.cc/r/20/pixelfont/:
	1. Import the `Elian Bitmap Serif.json` included in this repo
	2. Copy `character-list.txt` in as the glyphs list
	3. If you have added characters, edit the preview text to remove the old copy of `character-list.txt` and replace it with the new.
	3. Upload `tileset.png` as the image
	4. Save the generated `Elian Bitmap Serif.ttf`

Finally:
1. Commit on your own branch and make a pull request.
2. Describe the changes your PR makes.
