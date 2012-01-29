<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			classes/User.class.php
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

class $$$User {

	/* id_homehost
	 * string
	 */
	protected $id_homehost;

	/* id_system_users__user
	 * int
	 */
	protected $id_system_users__user;

	/* id_system_users__account
	 * int
	 */
	protected $id_system_users__account;

	/* id_system_users__profile
	 * int
	 */
	protected $id_system_users__profile;

	/* account-object
	 * object
	 */
	public $Account;

	/* profile-object
	 * object
	 */
	public $Profile;

	/* information about user
	 * array
	 */
	protected $info;

	/* account-data allowed to be accessed
	 * array
	 */
	protected $allowed_data = array('id_acc');

	/* constructor
	 * +@param int $id_system_users_user: user-id
	 * +@param int $id_system_users_account: account-id
	 * +@param int $id_homehost: homehost-id
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_system_users__user = false, $id_system_users__account = false, $id_homehost = false) {
		global $TSunic;

		// set initial-values
		$this->id_homehost = 0;
		$this->id_system_users__user = 0;
		$this->id_system_users__account = 0;
		$this->id_system_users__profile = 0;

		// get input
		if (!empty($id_system_users__user)) {

			// try to get user via id_system_users_user
			if (is_numeric($id_system_users__user)) {
				// identify by id_system_users_user

				// get data from database
				$sql_0 = "SELECT users.fk_system_users__account as id_system_users__account,
								 (SELECT profiles.id_system_users__profile
								 	FROM #__profiles as profiles
									WHERE profiles.fk_system_users__account = users.fk_system_users__account) as id_system_users__profile
						  FROM #__users as users
						  WHERE users.id_system_users__user = '".mysql_real_escape_string($id_system_users__user)."';";
				$result_0 = $TSunic->Db->doSelect($sql_0);

				// get id_system_users_account
				if (!empty($result_0)) {
					// user exists
					$this->id_system_users__user = $id_system_users__user;

					// check, if user is registered
					if (isset($result_0[0]['id_system_users__account'], $result_0[0]['id_system_users__profile'])
							AND !empty($result_0[0]['id_system_users__account'])
							AND !empty($result_0[0]['id_system_users__profile'])) {
						// account and profile exist
						$this->id_system_users__account = $result_0[0]['id_system_users__account'];
						$this->id_system_users__profile = $result_0[0]['id_system_users_profile'];
					}
				}
			}
		} elseif (!empty($id_system_users__account)
					AND is_numeric($id_system_users__account)) {
			// try to get user via id_system_users__account

			// get ids from database
			$sql_1 = "SELECT users.id_system_users__user as id_system_users__user,
							 profiles.id_system_users__profile as id_system_usrers__profile
					  FROM #__users as users,
					  	   #__profiles as profiles
					  WHERE users.fk_system_users__account = '".mysql_real_escape_string($id_system_users__account)."'
					  		AND profiles.fk_system_users__account = users.fk_system_users__account;";
			$result_1 = $TSunic->Db->doSelect($sql_1);

			// check, if user and account exist
			if (!empty($result_1) AND count($result_1) > 0) {
				// user and account exist
				$this->id_system_users__user = $result_1[0]['id_system_users__user'];
				$this->id_system_users__profile = $result_1[0]['id_system_users__profile'];
				$this->id_system_users__account = $id_system_users__account;
			}
		}

		// create account- and profile-object
		$this->Account = $TSunic->get('$$$Account', $this->id_system_users__account);
		$this->Profile = $TSunic->get('$$$Profile', $this->id_system_users__profile);

		return;
	}

	/* get user-data
	 * +@param string/bool $name: name of info (true will return $this->info)
	 *
	 * @return string/int/array
	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if mailbox exists
		if (!$this->id_system_users__user) return false;

		// get data
		if (empty($this->info)) {

			// get user-data
			$sql_0 = "SELECT ip as ip,
							 browser as browser,
							 dateOfFirst as dateOfFirst,
							 dateOfLast as dateOfLast
					  FROM #__users
					  WHERE id_system_users__user = '".mysql_real_escape_string($this->id_system_users__user)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);
			$this->info = ($result_0) ? $result_0 : array();

			// get profile-data (if possible)
			if ($this->Profile->isValid()) {
				$profile_data = $this->Profile->getInfo();
				if (is_array($profile_data)) {
					$this->info = array_merge($this->info, $profile_data);
				}
			}

			// get account-data (if possible)
			if ($this->Account->isValid()) {
				$account_data = $this->Account->getInfo();
				if (is_array($account_data)) {
					$this->info = array_merge($this->info, $account_data);
				}
			}
		}

		// add ids to info-array
		$this->info['id_system_users__user'] = $this->id_system_users__user;
		$this->info['id_system_users__account'] = $this->id_system_users__account;
		$this->info['id_system_users__profile'] = $this->id_system_users__profile;

		// return requested info
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];

		return false;
	}

	/* check, if user is guest
	 *
	 * @return bool
	 */
	public function isGuest () {
		// check, if account-id exist
		if (empty($this->id_system_users__account)) return true;
		return false;
	}
}
?>