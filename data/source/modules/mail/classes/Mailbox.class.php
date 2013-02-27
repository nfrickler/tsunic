<!-- | CLASS Mailbox -->
<?php
class $$$Mailbox extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = "#__mailboxes";

    /* Mail objects of mails in box
     * array
     */
    protected $mails;

    /* get object of mails in box
     *
     * @return array
     */
    public function getMails () {
	if (!$this->isValid()) return false;
	if (!empty($this->mails)) return $this->mails;
	global $TSunic;

	// get all mails
	$BpHelper = $TSunic->get('$bp$Helper');
	$mails = $BpHelper->getObjects('$$$Mail');

	// find those mails which are in this mailbox
	$this->mails = array();
	foreach ($mails as $index => $Value) {
	    if ($Value->getInfo('box') == $this->id)
		$this->mails[] = $Value;
	}

	return $this->mails;
    }

    /* get number of mails in box
     *
     * @return int
     */
    public function getNumber () {

	// load mails
	$mails = $this->getMails();

	// return number
	return ($mails) ? count($mails) : 0;
    }

    /* create a new mailbox
     * @param string: name of mailbox
     * +@param string: description of box
     *
     * @return bool
     */
    public function create ($name, $description = '') {
	global $TSunic;

	// validate input
	if (!$this->isValidName($name)
	    OR !$this->isValidDescription($description)
	) return false;

	// update database
	$data = array(
	    "name" => $name,
	    "description" => $description,
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "dateOfCreation" => "NOW()"
	);
	return $this->_create($data);
    }

    /* edit data of box
     * @param string: name of mailbox
     * +@param string: description of box
     *
     * @return bool
     */
    public function edit ($name, $description = '') {

	// validate input
	if (!$this->isValidName($name)
	    OR !$this->isValidDescription($description)
	) return false;

	// update database
	$data = array(
	    "name" => $name,
	    "description" => $description
	);
	return $this->_edit($data);
    }

    /* delete mailbox
     *
     * @return bool
     */
    public function delete () {

	// transfere all mails in inbox
	$mails = $this->getMails();
	foreach ($mails as $index => $Value) {
	    if (!$Value->move(0)) return false;
	}

	// delete mailbox in database
	return $this->_delete();
    }

    /* check, if name of box is valid
     * @param string: name of mailbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($this->_validate($name, 'string')) ? true : false;
    }

    /* check, if description of box is valid
     * @param string: description of mailbox
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description)
	    or $this->_validate($description, 'string')
	) ? true : false;
    }

    /* get all serverboxes transfering mails into this box
     *
     * @return array
     */
    public function getServerboxes () {
	if (!$this->isValid()) return false;
	global $TSunic;

	// get serverboxes from database
	$sql = "SELECT serverboxes.id as id
		FROM #__serverboxes as serverboxes,
		    #__mailaccounts as accounts
		WHERE serverboxes.fk_mailbox = '".$this->id."'
		    AND isActive = 1
		    AND serverboxes.fk_mailaccount = accounts.id
		    AND accounts.fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get server-objects
	$all_objects = array();
	foreach ($result as $index => $values) {
	    $all_objects[] = $TSunic->get('$$$Serverbox', $values['id']);
	}

	return $all_objects;
    }

    /* get seconds until checking for new mails for this mailbox
     *
     * @return int
     */
    public function timeToCheck () {

	// get all serverboxes
	$serverboxes = $this->getServerboxes();

	$next = 1000;
	foreach ($serverboxes as $index => $Value) {
	    $n = $Value->timeToCheck();
	    if ($n < $next) $next = $n;
	}

	return $next;
    }

    /* check for new emails for this mailbox and store them in the database
     * +@param bool $force: force check?
     *
     * @return array
     */
    public function checkMails ($force = false) {

	// get serverboxes transfering mails in this mailbox
	$serverboxes = $this->getServerboxes();

	// check for new mails on each mailbox
	$all_new_mails = array();
	foreach ($serverboxes as $index => $value) {

	    // check for new mails
	    $return = $value->checkMails($force);

	    // add new mails to output
	    if (is_array($return))
		$all_new_mails = array_merge($all_new_mails, $return);
	}

	return $all_new_mails;
    }
}
?>
