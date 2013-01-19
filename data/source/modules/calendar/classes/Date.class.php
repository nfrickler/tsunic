<!-- | CLASS Date -->
<?php
class $$$Date extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'DATE__START',
	'DATE__STOP',
	'DATE__LENGTH',
	'DATE__TITLE',
	'DATE__PERIOD',
	'DATE__PERIODTYPE',
	'DATE__PERIODCOUNT',
	'DATE__PERIODSTOP',
    );

    /* is valid title for date?
     * @param string: title
     *
     * @return bool
     */
    public function isValidTitle ($title) {
	return ($name and $this->_validate($title, 'extString'))
	    ? true : false;
    }

}
?>
