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
	 * @param file-handler: file handler of uploaded file
	 * +@param int: fk of directory
	 *
	 * @return bool
	 */
	public function create ($FH, $fk_directory = 0) {

		// validate
		if (!$this->isValidDirectory($fk_directory)
			or !$this->isValidFile($FH)) {
			return false;
		}

		// get name of file
		$name = $FH['name'];
		$counter = 1;
		while (!$this->isValidName($name)) {
			$name = 'unknown_file_'.$counter;
			$counter++;
		}

		// update database
		$sql = "INSERT INTO #__fsfiles
			SET _name_ = '$name',
				dateOfCreation = NOW(),
				fk_directory = '$fk_directory';";
		if (!$this->_create($sql)) return false;

		if (move_uploaded_file($FH['tmp_name'], $this->getPath()))
			return true;

		// delete file in database
		$this->delete();
		return false;

	}

	/* edit file
	 * @param string: new name
	 * +@param int: fk of directory
	 *
	 * @return bool
	 */
	public function edit ($name, $fk_directory = 0) {

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

	/* get path of this file
	 *
	 * @return string
	 */
	protected function getPath () {
		if (!$this->getInfo('id')) return '';
		global $TSunic;
		$File = $TSunic->get('$system$File', '#private#file__'.$this->getInfo('id'));
		return $File->getPath();
	}

	/* delete file
	 *
	 * @return bool
	 */
	public function delete () {
		global $TSunic;

		// delete file
		$FH = $TSunic->get('$system$File', $this->getPath());
		if (!$FH->deleteFile()) {
			$TSunic->Log->doLog(3, 'usersystem::FsFile::delete: Could not delete file!');
			return false;
		}

		$sql = "DELETE FROM #__fsfiles
			WHERE id = '$this->id';";
		return $this->_delete($sql);
	}

	/* is valid name for file?
	 * @param string: name
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		// TODO: Only unique in parent directory
		return ($this->_validate($name, 'filename')
			and $this->_isUnique('#__fsfiles', '_name_', $name)
		) ? true : false;
	}

	/* is valid file to upload
	 * @param file-handle: file handle of file to upload
	 *
	 * @return bool
	 */
	public function isValidFile ($FH) {
		global $TSunic;

		// validate size
		return ($FH['size'] <= $TSunic->Usr->config('$$$maxfilesize'))
			? true : false;
	}

	/* is valid fk_directory for this file?
	 * @param int: ID of an directory
	 *
	 * @return bool
	 */
	public function isValidDirectory ($fk_directory) {
		return ($fk_directory == 0
			or ($this->_validate($fk_directory, 'int')
				and $this->_isObject('#__fsdirectories', $fk_directory))
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
