<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			classes/Userfile.class.php
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

class $$$Userfile {

	/* id
	 * int
	 */
	protected $id__userfile;	 

	/* information about userfile
	 * array
	 */
	protected $info;

	/* File-object
	 * object
	 */
	protected $File;

	/* content of file
	 * string
	 */
	protected $content;

	/* constructor
	 * +@param string $id__userfile: id
	 *
	 * @return OBJECT
	 */
	public function __construct ($id__userfile = 0) {
		global $TSunic;

	    // save input
	    $this->id__userfile = $id__userfile;

		// check authorization
		$fk__usersystem__account = $this->getInfo('fk_system_users__account');
		if ($fk__usersystem__account
			AND $fk__usersystem__account != $TSunic->CurrentUser->getInfo('id_system_users__account')
		) {
			// file belongs to another user!!
			$this->id__userfile = 0;
		}

		return;
	}

	/* get all data of userfile
	 * +@param bool/string $name: name of data (true will return all data)
	 *
	 * @return array
	 * 		   (OR @return bool: false - error)
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if info already in cache
		if (!empty($this->id__userfile) AND empty($this->info)) {

			// get data from database
			$sql_0 = "SELECT _name_ as name,
							 fk_system_users__account as fk_system_users__account,
							 dateOfCreation as dateOfCreation,
							 dateOfUpdate as dateOfUpdate,
							 dateOfDeletion as dateOfDeletion,
							 mimetype as mimetype
					  FROM #__userfiles
					  WHERE id__userfile = '".mysql_real_escape_string($this->id__userfile)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// return, if no server matched
			if (empty($result_0)) return false;

			// store data
			$this->info = $result_0[0];
			$this->info['id__userfile'] = $this->id__userfile;
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* save file
	 * @param string $content: content of file
	 *
	 * @return string/bool
	 */
	public function saveFile ($content) {
		global $TSunic;

		// is valid object?
		if (!$this->isValid() OR !$this->_getFile()) return false;

		// encrypt file
		$content = $TSunic->Encryption->encrypt($content);

		// write file
		if (!$this->File->writeFile($content)) {
			// an error occurred!
			$TSunic->Log->add('error', 'Userfile could not be saved!', 1);
			return false;
		}

		return true;
	}

	/* get content of userfile
	 *
	 * @return string/bool
	 */
	public function readFile () {
		global $TSunic;

		// is valid object?
		if (!$this->isValid() OR !$this->_getFile()) return false;

		// is already in obj-var?
		if (isset($this->content) AND !empty($this->content)) return $this->content;

		// read
		$this->content = $this->File->readFile(true);
		$this->content = $TSunic->Encryption->decrypt($this->content);

		return $this->content;
	}

	/* get content of userfile
	 *
	 * @return string/bool
	 */
	protected function _getFile () {
		global $TSunic;

		// is valid?
		if (!$this->isValid()) return false;

		// is already in cache
		if (isset($this->File) AND !empty($this->File)) return $this->File;

		// try to load File-object
		$path = '#private#userfile__'.$this->id__userfile.'.data';
		$this->File = $TSunic->get('$system$File', $path);

		return $this->File;
	}

	/* create new userfile
	 *
	 * @return bool/int
	 */
	public function createUserfile ($name, $content) {
		global $TSunic;

		// get account-id
		$fk__useraccount = $TSunic->CurrentUser->getInfo('id_system_users__account');

		// insert in database
		$sql_0 = "INSERT INTO #__userfiles
				  SET fk_system_users__account = '".mysql_real_escape_string($fk__useraccount)."',
					  _name_ = '".mysql_real_escape_string($name)."',
					  dateOfCreation = NOW()
				  ";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// get id__userfile
		$this->id__userfile = mysql_insert_id();

		// save userfile
		$result = $this->saveFile($content);

		if (!$this->saveFile($content)) {
			// couldn't save file!
			$this->deleteUserfile();
			return false;
		}

		return true;
	}

	/* delete userfile
	 *
	 * @return string
	 */
	public function deleteUserfile () {
		global $TSunic;

		// is valid object?
		if (!$this->isValid() OR !$this->_getFile()) return false;

		// delete file
		if (!$this->File->deleteFile()) {
			// couldn't delete file
			$TSunic->Log->add('error', 'Couldn\'t delete userfile!', 1);
		}

		// delete file in database
		$sql_0 = "DELETE FROM #__userfiles
				  WHERE id__userfile = '".mysql_real_escape_string($this->id__userfile)."'
				  ";
		$result_0 = $TSunic->Db->doDelete($sql_0);
		if ($result_0 === false) return false;

		return true;
	}

	/* include file
	 *
	 * @return bool
 	 */
	public function includeFile () {

		// read file
		$content = $this->readFile();

		// echo
		echo $content;

		return true;
	}

	/* get mime-type of file
	 *
	 * @return string
	 */
	public function getMimeType () {
		return ($this->_getFile()) ? $this->_getFile()->getMimeType() : false;
	}

	/* check, if valid smtp-object
	 *
	 * @return bool
 	 */
	public function isValid () {

		// check, if id exists
		if (!isset($this->id__userfile) OR empty($this->id__userfile))
			return false;

		// check, if userfile in database
		$dateOfCreation = $this->getInfo('dateOfCreation');
		if (empty($dateOfCreation)) return false;

		return true;
	}
}
?>