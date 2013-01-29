<!-- | CLASS Profile -->
<?php
class $$$Profile extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'PROFILE__FIRSTNAME',
	'PROFILE__LASTNAME',
	'PROFILE__GENDER',
	'PROFILE__DATEOFBIRTH',
    );

    /* save dateofbirth
     * @param int: timestamp of date of birth
     * +@param string: title of date
     *
     * @return bool
     */
    public function saveDateofbirth ($start, $title = false) {
	global $TSunic;

	// is title?
	if (empty($title)) $title = '{$$$PROFILE__DATEOFBIRTH__TITLE}';

	// is dateofbirth already?
	$dateofbirth = $this->getInfo('dateofbirth');
	$Date = $TSunic->get('$calendar$Date', $dateofbirth, true);
	if (!$Date->isValid() and !$Date->create()) return false;

	// save bits
	if ($Date->addBit($start, 'DATE__START') and
	    $Date->addBit($start + 24 * 60 * 59 + 59 * 60 + 59, 'DATE__STOP') and
	    $Date->addBit(1, 'DATE__REPEAT') and
	    $Date->addBit('y', 'DATE__REPEATTYPE') and
	    $Date->addBit(1000, 'DATE__REPEATCOUNT') and
	    $Date->addBit($title, 'DATE__TITLE')
	    and
	    $this->addBit($Date->getInfo('id'), 'PROFILE__DATEOFBIRTH')
	) {
	    return true;
	}

	return false;
    }
}
?>
