<!-- | CLASS Validator -->
<?php
/**
 * Static class for validation of strings
 *
 */
class $$$Validator {

    /** Chars allowed in normal string
     * @var string $chars1
     */
    private static $chars1 = "-a-zA-ZäöüÄÖÜß0-9_";

    /** Chars additionally allowed in extended string
     * @var string $chars2
     */
    private static $chars2 = "\\\/\s\t@\.!\?;:,|#\$'\"\+\(\)\[\]&=\<\>\{\}";

    /** Chars additionally allowed in text
     * @var string $chars3
     */
    private static $chars3 = "\r\n";

    /** Is input a string (harmless chars only)?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isString ($input) {
	return (self::_isMatch("%[^".self::$chars1."]%i", $input))
	    ? false : true;
    }

    /** Is string (more chars allowed than in isString)?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isExtString ($input) {
	return (self::_isMatch("%[^".self::$chars1.self::$chars2."]%", $input))
	    ? false : true;
    }

    /** Is text (extString including newlines)?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isText ($input) {
	return (self::_isMatch('%[^'.self::$chars1.self::$chars2.self::$chars3.']%s', $input)) ? false : true;
    }

    /** Is HTML text?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isHtml ($input) {
	return (self::_isMatch('%[^\\\/\wäöüß\d-_@\.!\?;,\s\n\r<>]%si', $input)) ? false : true;
    }

    /* Is valid filename?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isFilename ($input) {
	if (empty($input)) return false;
	return (self::_isMatch("%[^-_a-z0-9äöüß\.\ ]%i", $input)) ? false : true;
    }

    /** Is integer?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isInt ($input) {
	return (is_numeric($input) or $input === 0) ? true : false;
    }

    /** Is double?
     * @param string $input
     *	Input string
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


    /** Is URI?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isUri ($input) {
	// TODO: improve!
	return (self::_isMatch("%^([a-z0-9]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}%i", $input)) ? true : false;
    }

    /** Is URL?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isUrl ($input) {
	return (self::_isMatch("%^([a-z]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}/?$%i", $input)) ? true : false;
    }

    /** Is e-mail address?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isEMail ($input) {

	// Might be a better regex-phrase from James Watts and Francisco Jose Martin Moreno:
	// /^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i

	return (self::_isMatch('%^[^\W][a-z0-9_]+(\.[a-z0-9_]+)*\@[-a-z0-9_]+(\.[-a-z0-9_]+)*\.[a-z]{2,10}$%i', $input))
	    ? true : false;
    }

    /** Is acceptable password?
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    public static function isPassword ($input) {
	return (strlen($input) >= 7) ? true : false;
    }

    /** Does regex match string?
     * @param string $regex
     *	Regular expression to be checked against
     * @param string $input
     *	Input string
     *
     * @return bool
     */
    protected static function _isMatch ($regex, $string) {
	return (preg_match($regex, $string) != 0) ? true : false;
    }
}
?>
