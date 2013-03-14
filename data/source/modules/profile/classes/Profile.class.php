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
	'PROFILE__MAINIMAGE',
	'PROFILE__ACCOUNT',
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
	    $Date->addBit($start + (24 * 60 * 60) - 1, 'DATE__STOP') and
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

    /* get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	$out = $this->getInfo('firstname').' '.$this->getInfo('lastname');
	$out = trim($out);
	if (empty($out)) {
	    global $TSunic;
	    $User = $TSunic->get('$usersystem$User', $this->getInfo('account'));
	    $out = $User->getInfo('name');
	}
	if (empty($out)) $out = '???';
	return $out;
    }

    /* get account object connected with this profile
     *
     * @return object
     */
    public function getAccount () {
	global $TSunic;
	return ($this->getInfo('account'))
	    ? $TSunic->get('$usersystem$User', $this->getInfo('account'))
	    : NULL;
    }

    /* delete
     *
     * @return bool
     */
    public function delete () {

	// delete date of birth
	$Bit = $this->getBit('PROFILE__DATEOFBIRTH');
	$Date = $Bit->getFkObject();
	if ($Date and !$Date->delete()) return false;

	return parent::delete();
    }
}
?>
