<!-- | Static class offering methods to validate values -->
<?php
class $$$Validator {

    /* "normal" letters
     * string
     */
    protected $letters = "a-zA-Z0-9äöüÄÖÜ";

    /* is string (harmless chars only)
     * @param string: input value
     *
     * @return bool
     */
    public function isString ($input) {
	return (self::_isMatch("%[^-_a-z0-9äöü]%i", $input)) ? false : true;
    }

    /* is string (extended, but harmless chars only)
     * @param string: input value
     *
     * @return bool
     */
    public function isExtString ($input) {
	return (self::_isMatch("%[^-_a-z0-9äöü@\.!\?;,]%i", $input)) ? false : true;
    }

    /* is filename
     * @param string: input value
     *
     * @return bool
     */
    public function isFilename ($input) {
	return (self::_isMatch("%[^-_a-z0-9äöü\.\ ]%i", $input)) ? false : true;
    }

    /* is int
     * @param string: input value
     *
     * @return bool
     */
    public function isInt ($input) {
	return (is_numeric($input)) ? true : false;
    }

    /* is uri
     * @param string: input value
     *
     * @return bool
     */
    public function isUri ($input) {
	// TODO: improve!
	return (self::_isMatch("%^([a-z0-9]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}%i", $input)) ? true : false;
    }

    /* is url
     * @param string: input value
     *
     * @return bool
     */
    public function isUrl ($input) {
	return (self::_isMatch("%^([a-z]+://)?(?:[-a-z0-9äöü]+\.)+[a-z]{2,4}/?$%i", $input)) ? true : false;
    }

    /* is e-mail address?
     * @param string: input value
     *
     * @return bool
     */
    public function isEMail ($input) {

	// Might be a better regex-phrase from James Watts and Francisco Jose Martin Moreno:
	// /^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i

	return (self::_isMatch('%^[^\W][a-z0-9_]+(\.[a-z0-9_]+)*\@[-a-z0-9_]+(\.[-a-z0-9_]+)*\.[a-z]{2,4}$%i', $input))
	    ? true : false;
    }

    /* is acceptable password?
     * @param string: input string
     *
     * @return bool
     */
    public function isPassword ($input) {
	return (strlen($input) >= 7) ? true : false;
    }

    /* does regex match string?
     * @param string: regex
     * @param string: input string
     *
     * @return bool
     */
    protected function _isMatch ($regex, $string) {
	return (preg_match($regex, $string) != 0) ? true : false;
    }
}
?>
