<!-- s | class to handle datatypes -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Parser.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$Parser {

	/* constructor
	 * +@param bool/string: path of file
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		return;
	}

	/* parse string to save in db
	 * @param string $string: string to parse
	 *
	 * @return string
	 */
	public function toSave ($string) {

		// parse (single- and double-) quotes
		$string = str_replace('"', '\\"', $string);
		$string = str_replace("'", "\\'", $string);

		// parse < and >
		$string = str_replace('<', '&lt;', $string);
		$string = str_replace('>', '&gt;', $string);

		// escape all (back-)slashes
		$string = str_replace('\\', '\\\\', $string);
		$string = str_replace('/', '\\/', $string);

		return $string;
	}

	/* parse string to show as normal text
	 * @param string $string: string to parse
	 *
	 * @return string
	 */
	public function toText ($string) {

		// parse new lines
		$string = nl2br($string);

		// strip (back-)slashes
		$string = str_replace('\\\\', '\\', $string);
		$string = str_replace('\\/', '/', $string);

		return $string;
	}

	/* parse string to show as html-text
	 * @param string $string: string to parse
	 *
	 * @return string
	 */
	public function toHtml ($string) {

		// parse < and >
		$string = str_replace('&lt;', '<', $string);
		$string = str_replace('&gt;', '>', $string);

		// strip (back-)slashes
		$string = str_replace('\\\\', '\\', $string);
		$string = str_replace('\\/', '/', $string);
		$string = str_replace('\"', '"', $string);

		return $string;
	}
}
?>