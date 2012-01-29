<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			classes/Profile.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$Profile {

	/* id_system_users_profile
	 * int
	 */
	protected $id_system_users__profile;

	/* information about user
	 * array
	 */
	protected $info;

	/* constructor
	 * +@param int $id_system_users__profile: profile-id
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_system_users__profile = 0) {
		global $TSunic;

		// save input
		$this->id_system_users__profile = $id_system_users__profile;

		return;
	}

	/* get profile-data
	 * +@param string/bool $name: name of info (true will return $this->info)
	 *
	 * @return string/int/array
	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if is profile-id
		if (!$this->id_system_users__profile) return false;

		// get data
		if (empty($this->info)) {
			// get profile-data
			$sql_0 = "SELECT name as name,
							 dateOfCreation as dateOfCreation,
							 dateOfChange as dateOfChange,
							 dateOfDeletion as dateOfDeletion,
							 fk_system_users__account as fk_system_users__account
					  FROM #__profiles
					  WHERE id_system_users__profile = '".mysql_real_escape_string($this->id_system_users__profile)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);
			$this->info = ($result_0) ? $result_0[0] : array();
		}

		// add id to info-array
		$this->info['id_system_users__profile'] = $this->id_system_users__profile;

		// return requested info
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* create new profile
	 * @param int $fk_system_users__account: account-id
	 * @param string $name: name of profile	 
	 *
	 * @return bool
	 */
	public function create ($fk_system_users__account, $name) {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name) OR !$this->isValidAccountId($fk_system_users__account)) return false;

		// create new account in database
		$sql_0 = "INSERT INTO #__profiles
				  SET name = '".mysql_real_escape_string($name)."',
				  	  fk_system_users__account = '".mysql_real_escape_string($fk_system_users__account)."',
				  	  dateOfCreation = NOW()
				  ;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// return, if not successful
		if (!$result_0) return false;

		// get account-id and save it in obj-var
		$this->id_system_users__profile = mysql_insert_id();

		return true;
	}

	/* edit profile-data
	 * +@param string $name: new name	 
	 *
	 * @return bool
	 */
	public function edit ($name) {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name)) return false;

		// edit profile in database
		$sql_0 = "UPDATE #__profiles
				  SET name = '".mysql_real_escape_string($name)."'
				  WHERE id_system_users__profile = '".mysql_real_escape_string($this->id_system_users__profile)."'
				  ;";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// return, if not successful
		if (!$result_0) return false;

		return true;
	}

	/* delete profile
	 *
	 * @return bool
	 */
	public function delete () {
		global $TSunic;

		// delete account in database
		$sql_0 = "DELETE FROM #__profiles
				  WHERE id_system_users__profile = '".mysql_real_escape_string($this->id_system_users__profile)."'
				  ;";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* check is name is valid
	 * @param string $name: name of profile
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		global $TSunic;

		// validate name
		if (preg_match('#[^a-zA-Z0-9_-äöüÄÖÜß]#', $name) != 0) {
			return false;
		}

		// check, if unique
		$sql_0 = "SELECT id_system_users__profile
				  FROM #__profiles
				  WHERE name = '".mysql_real_escape_string($name)."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);
		if ($result_0 AND is_array($result_0) AND count($result_0) > 0) {

			// check if e-mailaddress belongs to account
			if ($result_0[0]['id_system_users__profile'] != $this->id_system_users__profile) {
				return false;
			}
		}

		return true;
	}

	/* check, if account-id is valid
	 * @param string $fk_system_users__account: fk_system_users__account
	 *
	 * @return bool
	 */
	public function isValidAccountId ($fk_system_users__account) {
		global $TSunic;

		// try to get account-object and check, if valid account-object
		$Account = $TSunic->get('$$$Account', $fk_system_users__account);
		if (!$Account->isValid()) return false;

		return true;
	}

	/* check, if profile-object is valid object and profile exists
	 *
	 * @return bool
	 */
	public function isValid () {

		// try to get name
		$name = $this->getInfo('name');

		// check, if name exist
		if (!$name) return false;

		// profile seems to exist
		return true;
	}
}
?>