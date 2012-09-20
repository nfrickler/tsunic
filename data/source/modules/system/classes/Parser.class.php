<!-- s | CLASS parsing datatypes -->
<?php
class $$$Parser {

    /* escape string to save in db
     * @param string: string to escape
     *
     * @return string
     */
    public function text2db ($string) {
	$search = array("\\", "\0", "\n", '\r', "\x1a", "'", '"');
	$replace = array("\\\\", "\\0", "\\n", '\\r', "\Z", "\'", '\"');
	return str_replace($search, $replace, $string);
    }

    /* parse string to plain text
     * @param string: string to escape
     *
     * @return string
     */
    public function text2plain ($string) {
	$search = array("<", ">");
	$replace = array("&lt;", "&gt;");
	return str_replace($search, $replace, $string);
    }

    /* parse and escape string to plain text
     * @param string: string to parse and escape
     *
     * @return string
     */
    public function text2plain2db ($string) {
	return $this->text2db($this->text2plain($string));
    }

    /* parse txt to int
     * @param string: string
     *
     * @return int
     */
    public function text2int ($string) {
	return (int) $string;
    }

    /* parse string to show as normal text
     * @param string: string to parse
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

    /* parse string to show as html-text
     * @param string: string to parse
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
