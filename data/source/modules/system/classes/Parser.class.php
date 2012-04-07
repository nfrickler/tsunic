<!-- s | class to handle datatypes -->
<?php
class $$$Parser {

	/* constructor
	 */
	public function __construct () {
		return;
	}

	/* parse string to save in db
	 * @param string: string to parse
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
	 * @param string: string to parse
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
	 * @param string: string to parse
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
