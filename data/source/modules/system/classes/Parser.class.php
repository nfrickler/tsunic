<!-- s | CLASS Parser -->
<?php
/** Static class to parse strings
 *
 * Parse strings for database, plain text or html
 *
 */
class $$$Parser {

    /** Prepare string to be saved in database
     *
     * @param string $string
     *	Input string
     *
     * @return string
     */
    public function text2db ($string) {
	$search = array("\\", "\0", "\n", '\r', "\x1a", "'", '"');
	$replace = array("\\\\", "\\0", "\\n", '\\r', "\Z", "\'", '\"');
	return str_replace($search, $replace, $string);
    }

    /** Parse string to be plain text
     *
     * @param string $string
     *	Input string
     *
     * @return string
     */
    public function text2plain ($string) {
	$search = array("<", ">");
	$replace = array("&lt;", "&gt;");
	return str_replace($search, $replace, $string);
    }

    /** Parse string to be plain text and prepare for saving in database
     *
     * @param string $string
     *	Input string
     *
     * @return string
     */
    public function text2plain2db ($string) {
	return $this->text2db($this->text2plain($string));
    }

    /** Convert string to int
     *
     * @param string $string
     *	Input string
     *
     * @return int
     */
    public function text2int ($string) {
	return (int) $string;
    }

    /** Prepare string to be displayed as normal text
     *
     * @param string $string
     *	Input string
     *
     * @return string
     */
    public function toText ($string) {

	$string = str_replace('\r', '', $string);
	$string = str_replace('\n', '', $string);

	// strip (back-)slashes
	$search = array("\\\\", "\\/");
	$replace = array("\\", "/");
	return str_replace($search, $replace, $string);
    }

    /** Prepare string to be displayed as HTML
     *
     * @param string $string
     *	Input string
     *
     * @return string
     */
    public function toHtml ($string) {
	$search = array('\"', "\'", '\r', '\n', '\\\\');
	$replace = array('"', "'","\r", "\n", '\\');
	return str_replace($search, $replace, $string);
    }
}
?>
