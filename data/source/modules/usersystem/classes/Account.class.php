<!-- | Useraccount class -->
<?php
class $$$Account {

	/* id_system_users_account
	 * int
	 */
	protected $id_system_users__account;

	/* information about user
	 * array
	 */
	protected $info;

	/* constructor
	 * +@param int: account-id
	 */
	public function __construct ($id_system_users__account = 0) {
		global $TSunic;

		// save input
		$this->id_system_users__account = $id_system_users__account;

		return;
	}

	/* get account-data
	 * +@param string/bool: name of info (true will return $this->info)
	 *
	 * @return mix
	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if is account-id
		if (!$this->id_system_users__account) return false;

		// get data
		if (empty($this->info)) {

			// get account-data
			$sql_0 = "SELECT email as email,
					dateOfRegistration as dateOfRegistration,
					dateOfChange as dateOfChange,
					dateOfDeletion as dateOfDeletion
				FROM #__accounts
				WHERE id_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);
			$this->info = ($result_0) ? $result_0[0] : array();
		}

		// add id to info-array
		$this->info['id_system_users__account'] = $this->id_system_users__account;

		// return requested info
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];

		return false;
	}

	/* create new account
	 * @param string: email-address
	 * @param string: password for account
	 *
	 * @return bool
	 */
	public function create ($email, $password) {
		global $TSunic;

		// validate input
		if (!$this->isValidEMail($email) OR !$this->isValidPassword($password)) return false;

		// create new account in database
		$sql_0 = "INSERT INTO #__accounts
				SET email = '".mysql_real_escape_string($email)."',
					password = '".md5($password)."',
					dateOfRegistration = NOW()
		;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// return, if not successful
		if (!$result_0) return false;

		// get account-id and save it in obj-var
		$this->id_system_users__account = mysql_insert_id();

		return true;
	}

	/* edit account-data
	 * +@param string: new email-address
	 * +@param string: new password for account
	 *
	 * @return bool
	 */
	public function edit ($email = false, $password = false) {
		global $TSunic;

		// get and validate input
		$sql_password = '';
		$sql_email = '';
		if (!empty($email)) {
			if (!$this->isValidEMail($email)) return false;
			$sql_email = "email = '".mysql_real_escape_string($email)."'";
		}
		if (!empty($password)) {
			if (!$this->isValidPassword($password)) return false;
			$sql_password = "password = '".md5($password)."'";
		}

		// edit account in database
		if (!empty($sql_email) AND !empty($sql_password)) $sql_email.= ',';
		$sql_0 = "UPDATE #__accounts
				SET ".$sql_email.$sql_password."
				WHERE id_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."'
				  ;";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* delete account
	 *
	 * @return bool
	 */
	public function delete () {
		global $TSunic;

		// delete profile in database
		$return = $TSunic->CurrentUser->Profile->delete();
		if (!$return) return false;

		// delete account in database
		if (!empty($sql_email) AND !empty($sql_password)) $sql_email.= ',';
		$sql_0 = "DELETE FROM #__accounts
				WHERE id_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."'
				  ;";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* check is email is valid
	 * @param string: email-address 
	 *
	 * @return bool
	 */
	public function isValidEMail ($email) {
		global $TSunic;

		// validate e-mail
		if (preg_match('#[a-zA-Z0-9_-öäüÄÖÜ]+@[a-zA-Z0-9_-öäüÄÖÜ]+\.[a-zA-Z]+#', $email) == 0) {
			return false;
		}

		// check, if unique
		$sql_0 = "SELECT id_system_users__account
				FROM #__accounts
				WHERE email = '".mysql_real_escape_string($email)."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);
		if ($result_0 AND is_array($result_0) AND count($result_0) > 0) {
			// check if e-mailaddress belongs to account
			if ($result_0[0]['id_system_users__account'] != $this->id_system_users__account) {
				return false;
			}	
		}

		return true;
	}

	/* check, if password is valid
	 * @param string: password
	 *
	 * @return bool
	 */
	public function isValidPassword ($password) {

		// check length
		if (strlen($password) < 7) return false;
		return true;
	}

	/* check, if account-object is valid object and account exists
	 *
	 * @return bool
	 */
	public function isValid () {

		// try to get email
		$email = $this->getInfo('email');

		// check, if email-address exist
		if (!$email) return false;

		// account seems to exist
		return true;
	}
}
?>
