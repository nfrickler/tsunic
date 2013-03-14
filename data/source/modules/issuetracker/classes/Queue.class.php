<!-- | CLASS Queue -->
<?php
class $$$Queue extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'QUEUE__NAME',
	'QUEUE__DESCRIPTION',
    );

    /* get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return ($this->id) ? $this->getInfo('name') : '{CLASS__QUEUE__NAMEALL}';
    }

    /* load Key (save for guest user only)
     * +@param int: fk_account of key to return
     *
     * @return Object
     */
    protected function _getKey ($fk_account = 0) {
	global $TSunic;

	// save for guest only!
	return parent::_getKey($TSunic->Usr->getIdGuest());
    }

    /* get new empty Bit object
     *
     * @return object
     */
    protected function _getNewBit () {
	global $TSunic;
	$Bit = $TSunic->get('$bp$Bit', false, true);

	// clone my Key
	$Key = $TSunic->get(
	    '$system$Key',
	    array($this->table, $this->id, $TSunic->Usr->getIdGuest()),
	    true
	);
	$Bit->setKey($Key);
	return $Bit;
    }

    /* get all issues in this queue
     *
     * @return array
     */
    public function getIssues () {
	global $TSunic;
	$Helper = $TSunic->get('$bp$Helper');
	$all_issues = $Helper->getObjects('$$$Issue');

	// return all issues if id=0
	if (!$this->id) return $all_issues;

	$issues = array();
	foreach ($all_issues as $index => $Value) {
	    if ($Value->getInfo('queue') == $this->getInfo('id')) {
		$issues[] = $Value;
	    }
	}

	return $issues;
    }
}
?>
