<!-- | File (filesystem) class -->
<?php
include_once '$system$Object.class.php';
class $$$FsFile extends $system$Object {

	/* directory containing this file
	 * object
	 */
	protected $Directory;

	/* load infos from database
	 *
	 * @return sql query
	 */
	protected function loadInfoSql () {
		return "SELECT _name_ as name,
				fk_directory,
				dateOfCreation,
				dateOfUpdate
			FROM #__fsfiles
			WHERE id = '$this->id';";
	}

	/* create new file
	 * @param string: name
	 * +@param int: fk of directory
	 *
	 * @return bool
	 */
	public function create ($name, $fk_directory = 0) {

		// validate
		if (!$this->isValidName($name)
			or !$this->isValidDirectory($fk_directory)) {
			return false;
		}

		// update database
		$sql = "INSERT INTO #__fsfiles
			SET _name_ = '$name',
				fk_directory = '$fk_directory';";
		return $this->_create($sql);
	}

	/* edit file
	 * @param string: new name
	 * +@param int: fk of directory
	 *
	 * @return bool
	 */
	public function edit ($name, $fk_directory) {

		// validate
		if (!$this->isValidName($name)
			or !$this->isValidDirectory($fk_directory)) {
			return false;
		}

		// anything changed?
		$sql_set = array();
		if ($name != $this->getInfo('name')) {
			$sql_set[] = "_name_ = '$name'";
		}
		if ($fk_directory != $this->getInfo('fk_directory')) {
			$sql_set[] = "fk_directory = '$fk_directory'";
		}
		if (empty($sql_set)) return true;

		// update database
		$sql = "UPDATE #__fsfiles SET ".
			implode(",", $sql_set).
			" WHERE id = '$this->id';";
		return $this->_edit($sql);
	}

	/* delete file
	 *
	 * @return bool
	 */
	public function delete () {
		$sql = "DELETE FROM #__fsfiles
			WHERE id = '$this->id';";
		return $this->_delete($sql);
	}

	/* is valid name for directory?
	 * @param string: name
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		// TODO: Only unique in parent directory
		return ($this->_validate($name, 'string')
			and $this->_isUnique('#__fsfiles', '_name_', $name)
		) ? true : false;
	}

	/* is valid fk_directory for this file?
	 * @param int: ID of an directory
	 *
	 * @return bool
	 */
	public function isValidDirectory ($fk_directory) {
		return ($this->_validate($fk_directory, 'int')
			and ($fk_directory == 0
				or $this->_isObject('#__fsdirs', $fk_directory))
		) ? true : false;
	}

	/* get directory, that contains this file
	 *
	 * @return OBJECT
	 */
	public function getDirectory () {
		if (!empty($this->Directory)) return $this->Directory;
		global $TSunic;
		$this->Directory = $TSunic->get('$$$FsDirectory', $this->getInfo('fk_directory'));
		return $this->Directory;
	}
}
?>
