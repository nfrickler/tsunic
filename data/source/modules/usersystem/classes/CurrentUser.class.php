<!-- | -->
<?php

include_once '$$$User.class.php';
class $$$CurrentUser extends $$$User {

	/* account-data allowed to be accessed
	 * array
	 */
	protected $allowed_data = array('id_acc',
								  'email');

	/* constructor
	 * -@param int $id_system_users_user: user-id (will be ignored!)
	 * -@param int $id_system_users_account: account-id (will be ignored!)
	 * -@param int $id_homehost: homehost-id (will be ignored!)
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_system_users__user = false, $id_system_users__account = false, $id_homehost = false) {
		global $TSunic;

		// get input from SESSION
		$this->id_homehost = (isset($_SESSION['id_homehost'])) ? $_SESSION['id_homehost'] : 0;
		$this->id_system_users__user = (isset($_SESSION['id_system_users__user'])) ? $_SESSION['id_system_users__user'] : 0;
		$this->id_system_users__account = (isset($_SESSION['id_system_users__account'])) ? $_SESSION['id_system_users__account'] : 0;
		$this->id_system_users__profile = (isset($_SESSION['id_system_users__profile'])) ? $_SESSION['id_system_users__profile'] : 0;
		if (!empty($this->id_system_users__user)) {
			// check authenticity

			// get user-data from database
			$sql_0 = "SELECT ip as ip,
							 browser as browser
					  FROM #__users
					  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."'
					  		AND fk_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// check userdata
			if (empty($result_0)) {
				// invalid input!
				$TSunic->throwError('Invalid user!');
				return;
			}
		}

		// create account- and profile-object
		$this->Account = $TSunic->get('$$$Account', $this->id_system_users__account);
		$this->Profile = $TSunic->get('$$$Profile', $this->id_system_users__profile);

		// update user
		$this->updateUser();

		return;
	}

	/* get user-data
	 * +@param string/bool $name: name of info (true will return $this->info)
	 *
	 * @return string/int/array
	 */
	public function getInfo ($name = true) {
		return parent::getInfo($name);
	}

	/* login
	 * @param string $email: email of account
	 * @param string $password: password of account
	 *
	 * @return bool
	 */
	public function doLogin ($email_name, $password, $seccode = 0) {
		global $TSunic;

		// get email OR username
		$sql_email_name = '';
		if (preg_match('#@#', $email_name) != 0) {
			$sql_email_name = "accounts.email = '".mysql_real_escape_string($email_name)."'";
		} else {
			$sql_email_name = "profiles.name = '".mysql_real_escape_string($email_name)."'";
		}

		// get real password
		$sql_password = md5($password);

		// check login
		$sql_0 = "SELECT accounts.id_system_users__account as id_system_users__account,
						 profiles.id_system_users__profile as id_system_users__profile,
						 (SELECT users.id_system_users__user
						 	FROM #__users as users
							WHERE users.fk_system_users__account = accounts.id_system_users__account) as id_system_users__user
				  FROM #__accounts as accounts,
				  	   #__profiles as profiles
				  WHERE profiles.fk_system_users__account = accounts.id_system_users__account
				  		AND ".$sql_email_name."
				  		AND accounts.password = '".$sql_password."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// validate login
		if (!empty($result_0) AND count($result_0) === 1) {
			// login correct

			// set login
			$_SESSION['id_system_users__user'] = (isset($result_0[0]['id_system_users__user'])) ? $result_0[0]['id_system_users__user'] : 0;
			$_SESSION['id_system_users__account'] = $result_0[0]['id_system_users__account'];
			$_SESSION['id_system_users__profile'] = $result_0[0]['id_system_users__profile'];
			$TSunic->Encryption->setPassword($password);
       		return true;
		}

		// login incorrect
		return false;
	}

	/* logout
	 *
	 * @return bool
	 */
	public function doLogout () {
		global $TSunic;

		// delete SESSION
		$_SESSION['id_system_users__user'] = 0;
		$_SESSION['id_system_users__account'] = 0;
		$_SESSION['id_system_users__profile'] = 0;
		unset($_SESSION['id_system_users__user']);
		unset($_SESSION['id_system_users__account']);
		unset($_SESSION['id_system_users__profile']);

		return true;
	}

	/* validate login
	 *
	 * @return bool
	 */
	public function doValidate () {
		global $TSunic;
		// compare browser
		// TODO
		// compare IP
		// TODO
		return true;
	}

	/* register a new account
	 * @param string $email: email-address
	 * @param string $password: password of account
	 * @param string $name: name of profile	 	 
	 *
	 * @return bool
	 */
	public function doRegister ($email, $password, $name) {
		global $TSunic;

		// create account- and profile-object
		$Account = $TSunic->get('$$$Account');
		$Profile = $TSunic->get('$$$Profile');

		// validate username
		if (!$Profile->isValidName($name)) return false;

		// try to create account
		$Account->create($email, $password);
		if (!$Account->isValid()) return false;

		// try to create profile
		$Profile->create($Account->getInfo('id_system_users__account'), $name);
		if (!$Profile->isValid()) {
			// delete account
			$Account->delete();
			return false;
		}

		// update user
		$this->id_system_users__account = $Account->getInfo('id_system_users__account');
		$this->id_system_users__profile = $Profile->getInfo('id_system_users__profile');
		$this->Account = $Account;
		$this->Profile = $Profile;
		$this->updateUser();

		return true;
	}

	/* delete user
	 *
	 * @return bool
	 */
	public function deleteUser () {
		global $TSunic;

		// delete user in database
		$sql_0 = "DELETE FROM #__users
				  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."'
				  ;";
		$return_0 = $TSunic->Db->doDelete($sql_0);
		return true;
	}

	/* get browser of user
	 *
	 * @return bool
	 */
	public function getBrowser () {
		global $TSunic;

		// skip, if debug_mode
		$debug_mode = $TSunic->Config->getConfig('debug_mode');
		if ($debug_mode == 'true') return array();

		// get cache-dir
		$cache_path = $TSunic->Config->getConfig('folder_cache');

		// get browscap-object
		$Browscap = $TSunic->get('$$$Browscap', $cache_path);

		// get browser-infos
		$browser = $Browscap->getBrowser(null, true);

		return $browser;
	}

	/* update user in database
	 *
	 * @return bool
	 */
	public function updateUser () {
		global $TSunic;

		// get data
		$ip = $_SERVER['REMOTE_ADDR'];
		$browser = $this->getBrowser();
		$browser = implode('|', $browser);
		$browser = md5($browser);

		// user-id?
		if (!empty($this->id_system_users_user)) {
			// user-id exists

			// get linked account from database
			$sql_0 = "SELECT fk_system_users__account as id_system_users__account
					  FROM #__users
					  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."'
					 ;";
			$result_0 = $TSunic->Db->doSelect($sql_0);
			if (!$result_0 OR count($result_0) == 0) {
				// invalid user-id -> get new one
				$this->id_system_users__user = 0;
				return $this->updateUser();
			}
			$db_account_id = $result_0[0]['id_system_users__account'];

			// is account-id linked?
			if (isset($this->id_system_users__account) AND !empty($this->id_system_users__account)) {
				// account linked to user

				// compare account-ids
				if ($this->id_system_users__account == $db_account_id) {
					// all clear :-)
				} else {
					// account-ids are not the same

					// check, if recent login
					if (empty($db_account_id)) {
						// recent login

						// check, if account already linked to an other user
						$sql_1 = "SELECT id_system_users__user as id_system_users__user
								  FROM #__users
								  WHERE fk_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."';";
						$result_1 = $TSunic->Db->doSelect($sql_1);
						if (!$result_1 OR count($result_1) == 0) {
							// account not linked to user yet

							// update user; add account id
							$sql_2 = "UPDATE #__users
									  SET ip = '".mysql_real_escape_string($ip)."',
									  	  browser = '".mysql_real_escape_string($browser)."',
									  	  fk_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."'
									  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."'
									  ;";
							$return_2 = $TSunic->Db->doDelete($sql_2);
						} else {
							// account already linked

							// delete current-user in database
							$this->deleteUser();
							// switch to this user linked to the account
							$this->id_system_users_user = $result_1[0]['id_system_users__user'];
						}
					}
				}
			} else {
				// no account linked to user

				// just update user-data
				$sql_2 = "UPDATE #__users
						  SET ip = '".mysql_real_escape_string($ip)."',
						  	  browser = '".mysql_real_escape_string($browser)."'
						  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."'
						  ;";
				$return_2 = $TSunic->Db->doDelete($sql_2);
			}
		} else {
			// no user-id exists yet

			// check, if suiting user exists
			$sql_3 = "SELECT id_system_users__user
					  FROM #__users
					  WHERE ip = '".mysql_real_escape_string($ip)."'
					  		AND browser = '".mysql_real_escape_string($browser)."'
							AND fk_system_users__account = 0;";
			$result_3 = $TSunic->Db->doSelect($sql_3);
			if (!$result_3 OR count($result_3) == 0) {
				// no fitting user exists

				// create new user in database
				$sql_4 = "INSERT INTO #__users
						  SET ip = '".mysql_real_escape_string($ip)."',
						  	  browser = '".mysql_real_escape_string($browser)."',
						  	  dateOfFirst = NOW()
						  ;";
				$return_4 = $TSunic->Db->doInsert($sql_4);
				$this->id_system_users__user = mysql_insert_id();
			} else {
				// user exists

				// register user-id for this user
				$this->id_system_users__user = $result_3[0]['id_system_users__user'];
			}
		}

		return true;
	}

	/* check, if password is correct
	 * @param string $password: password of account
	 *
	 * @return bool
	 */
	public function isPassword ($password) {
		global $TSunic;

		// check login
		$sql_0 = "SELECT accounts.id_system_users__account as id_system_users__account
				  FROM #__accounts as accounts
				  WHERE accounts.id_system_users__account = '".mysql_real_escape_string($this->id_system_users__account)."'
				  		AND accounts.password = '".md5($password)."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// validate password
		if (!empty($result_0) AND count($result_0) === 1) {
			// password correct
       		return true;
		}

		// password incorrect
		return false;
	}
}
?>
