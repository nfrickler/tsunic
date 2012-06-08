<!-- s | class to handle datatypes -->
<?php
class $$$Parser {

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

	/* escape string to save in db
	 * @param string: string to escape
	 *
	 * @return string
	 */
	public function txt2db ($string) {
		$search = array("\\", "\0", "\n", "\r", "\x1a", "'", '"');
		$replace=array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"');
		return str_replace($search, $replace, $string);
	}

	/* parse string to plain text
	 * @param string: string to escape
	 *
	 * @return string
	 */
	public function txt2plain ($string) {
		$search = array("<", ">");
		$replace=array("&lt;", "&gt;");
		return str_replace($search, $replace, $string);
	}

	/* parse and escape string to plain text
	 * @param string: string to parse and escape
	 *
	 * @return string
	 */
	public function txt2plain2db ($string) {
		return $this->txt2db($this->txt2plain($string));
	}

	/* parse txt to int
	 * @param string: string
	 *
	 * @return int
	 */
	public function txt2int ($string) {
		return int($string);
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
