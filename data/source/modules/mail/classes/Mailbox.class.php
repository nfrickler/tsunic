<!-- | CLASS Mailbox -->
<?php
/** Mailbox class
 *
 * A mailbox to collect Mails
 */
class $$$Mailbox extends $system$Object {

    /** Tablename in database
     * @var string $table
     */
    protected $table = "#__$mail$mailboxes";

    /** Mail objects of mails in box
     * @var array $mails
     */
    protected $mails;

    /** Get object of mails in box
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

    /** Get number of mails in box
     *
     * @return int
     */
    public function getNumber () {

	// load mails
	$mails = $this->getMails();

	// return number
	return ($mails) ? count($mails) : 0;
    }

    /** Create a new mailbox
     * @param string $name
     *	Name of mailbox
     * @param string $description
     *	Description of box
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

    /** Edit data of box
     * @param string $name
     *	Name of mailbox
     * @param string $description
     *	Description of box
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

    /** Delete mailbox
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

    /** Check, if name of box is valid
     * @param string $name
     *	Name of mailbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($this->_validate($name, 'string')) ? true : false;
    }

    /** Check, if description of box is valid
     * @param string $description
     *	Description of mailbox
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description)
	    or $this->_validate($description, 'string')
	) ? true : false;
    }

    /** Get all serverboxes transfering mails into this box
     *
     * @return array
     */
    public function getServerboxes () {
	if (!$this->isValid()) return false;
	global $TSunic;

	// get serverboxes from database
	$sql = "SELECT serverboxes.id as id
		FROM #__$mail$serverboxes as serverboxes,
		    #__$mail$mailaccounts as accounts
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

    /** Get seconds until checking for new mails for this mailbox
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

    /** Check for new emails for this mailbox and store them in the database
     * @param bool $force
     *	Force check?
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
