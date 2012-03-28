<!-- | -->
<?php

class $$$Attachment {

	/* id
	 * int
	 */
	protected $id__attachment;

	/* array with infos about attachment
	 * array
	 */
	protected $info;

	/* constructor
	 * +@param string $id__userfile: id
	 *
	 * @return OBJECT
	 */
	public function __construct ($id__attachment = 0) {

	    // save input
	    $this->id__attachment = $id__attachment;

		return;
	}

	/* get all data of attachment
	 * +@param bool/string $name: name of data (true will return all data)
	 * +@param bool $rqst_usrfile: request userfile, if info not available for attachment itself	 
	 *
	 * @return array
	 * 		   (OR @return bool: false - error)
 	 */
	public function getInfo ($name = true, $rqst_usrfile = true) {
		global $TSunic;

		// check, if info already in cache
		if (!empty($this->id__attachment) AND empty($this->info)) {

			// get data from database
			$sql_0 = "SELECT *
					  FROM #__attachments
					  WHERE id__attachment = '".mysql_real_escape_string($this->id__attachment)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// return, if no server matched
			if (empty($result_0)) return false;

			// store data
			$this->info = $result_0[0];
			$this->info['id__attachment'] = $this->id__attachment;
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];

		// request Userfile-object
		if ($name == 'name' AND $rqst_usrfile) {
			$this->info['name'] = $this->getUserfile()->getInfo('name');
			return $this->info['name'];
		}

		return false;
	}

	/* get userfile-object of attachment
	 *
	 * @return bool/object
	 */
	public function getUserfile () {
		global $TSunic;

		// is in obj-var?
		if (isset($this->Userfile) AND !empty($this->Userfile)) return $this->Userfile;

		// is fk__userfile?
		$fk__usersystem__userfile = $this->getInfo('fk__usersystem__userfile', false);
		if (empty($fk__usersystem__userfile)) return false;

		// get and return userfile-object
		$this->Userfile = $TSunic->get('$usersystem$Userfile', $fk__usersystem__userfile);
		return $this->Userfile;
	}

	/* create attachment
	 * @param int $fk__mail: fk__mail
	 * @param string $name: name of file
	 * @param string $content: content of file	 	 
	 *
	 * @return bool
	 */
	public function createAttachment ($fk__mail, $name, $content) {
		global $TSunic;
		$fk__mail = (int) $fk__mail;

		// create userfile
		$Userfile = $TSunic->get('$usersystem$Userfile', array(), true);
		if (!$Userfile->createUserfile($name, $content)) {
			return false;
		}

		// create attachment in database
		$sql_0 = "INSERT INTO #__attachments
					SET fk_mail__mail = ".$fk__mail.",
						fk__usersystem__userfile = ".mysql_real_escape_string($Userfile->getInfo('id__userfile'))."
				  ";
		$result_0 = $TSunic->Db->doInsert($sql_0);
		if ($result_0 === false) {
			// delete userfile
			$Userfile->deleteUserfile();
			return false;
		}

		// set id
		$this->id__attachment = mysql_insert_id();

		return true;
	}

	/* delete attachment
	 *
	 * @return bool
	 */
	public function deleteAttachment () {
		global $TSunic;

		// delete userfile
		if (!$this->getUserfile()->deleteUserfile()) {
			return false;
		}

		// delete attachment in database
		$sql_0 = "DELETE FROM #__attachments
				  WHERE id__attachment = '".mysql_real_escape_string($this->id__attachment)."'
				  ";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		return true;
	}
}
?>
