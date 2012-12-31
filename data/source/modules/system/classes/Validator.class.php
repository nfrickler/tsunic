<!-- | Class to validate data -->
<?php
class $$$Validator {

    /* chars allowed in string
     * string
     */
    private static $chars1 = "-a-zA-ZäöüÄÖÜß0-9_";

    /* chars additionally allowed in extString
     * string
     */
    private static $chars2 = "\\\/\s\t@\.!\?;:,|#\$'\"\+\(\)\[\]&=\<\>";

    /* chars additionally allowed in text
     * string
     */
    private static $chars3 = "\r\n";

    /* is string (harmless chars only)
     * @param string: input value
     *
     * @return bool
     */
    public static function isString ($input) {
	return (self::_isMatch("%[^".self::$chars1."]%i", $input))
	    ? false : true;
    }

    /* is string (extended, but harmless chars only)
     * @param string: input value
     *
     * @return bool
     */
    public static function isExtString ($input) {
	return (self::_isMatch("%[^".self::$chars1.self::$chars2."]%", $input))
	    ? false : true;
    }

    /* is text (extended, with newlines)
     * @param string: input value
     *
     * @return bool
     */
    public static function isText ($input) {
	return (self::_isMatch('%[^'.self::$chars1.self::$chars2.self::$chars3.']%s', $input)) ? false : true;
    }

    /* is html text
     * @param string: input value
     *
     * @return bool
     */
    public static function isHtml ($input) {
	return (self::_isMatch('%[^\\\/\wäöüß\d-_@\.!\?;,\s\n\r<>]%si', $input)) ? false : true;
    }

    /* is filename
     * @param string: input value
     *
     * @return bool
     */
    public static function isFilename ($input) {
	if (empty($input)) return false;
	return (self::_isMatch("%[^-_a-z0-9äöüß\.\ ]%i", $input)) ? false : true;
    }

    /* is int
     * @param string: input value
     *
     * @return bool
     */
    public static function isInt ($input) {
	return (is_numeric($input) or $input === 0) ? true : false;
    }

    /* is double?
     * @param string: input value
     *
     * @return bool
     */
    public static function isDouble ($input) {
	$cache = explode('.', $input);
	if (count($cache) <= 2) {
	    foreach ($cache as $index => $value) {
		if (!self::_isInt($cache[0])) return false;
	    }
	    return true;
	}

	return false;
    }


    /* is uri
     * @param string: input value
     *
     * @return bool
     */
    public static function isUri ($input) {
	// TODO: improve!
	return (self::_isMatch("%^([a-z0-9]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}%i", $input)) ? true : false;
    }

    /* is url
     * @param string: input value
     *
     * @return bool
     */
    public static function isUrl ($input) {
	return (self::_isMatch("%^([a-z]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}/?$%i", $input)) ? true : false;
    }

    /* is e-mail address?
     * @param string: input value
     *
     * @return bool
     */
    public static function isEMail ($input) {

	// Might be a better regex-phrase from James Watts and Francisco Jose Martin Moreno:
	// /^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i

	return (self::_isMatch('%^[^\W][a-z0-9_]+(\.[a-z0-9_]+)*\@[-a-z0-9_]+(\.[-a-z0-9_]+)*\.[a-z]{2,10}$%i', $input))
	    ? true : false;
    }

    /* is acceptable password?
     * @param string: input string
     *
     * @return bool
     */
    public static function isPassword ($input) {
	return (strlen($input) >= 7) ? true : false;
    }

    /* does regex match string?
     * @param string: regex
     * @param string: input string
     *
     * @return bool
     */
    protected static function _isMatch ($regex, $string) {
	return (preg_match($regex, $string) != 0) ? true : false;
    }
}
?>
