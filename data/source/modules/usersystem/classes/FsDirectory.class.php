<!-- | CLASS Directory (filesystem) -->
<?php
include_once '$system$Object.class.php';
class $$$FsDirectory extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = "#__fsdirectories";

    /* sub directories
     * array
     */
    protected $subdirectories;

    /* sub files
     * array
     */
    protected $subfiles;

    /* get information about object
     * +@param string/bool: name of info (true will return $this->info)
     * +@param bool: force update of object infos?
     *
     * @return mix
     */
    public function getInfo ($name = true, $update = false) {
	global $TSunic;

	// is root directory?
	if ($this->id == 0) {
	    switch ($name) {
		case 'name':
		    return '{CLASS__FSDIRECTORY__ROOTDIR}';
		case 'fk_account':
		    return $TSunic->Usr->getInfo('id');
	    }
	    return NULL;
	}

	return parent::getInfo($name, $update);
    }

    /* create new directory
     * @param string: name
     * +@param int: fk of parent
     *
     * @return bool
     */
    public function create ($name, $fk_parent = 0) {

	// validate
	if (!$this->isValidName($name)
	    or !$this->isValidParent($fk_parent)) {
	    return false;
	}

	// update database
	$data = array(
	    "name" => $name,
	    "dateOfCreation" => "NOW()",
	    "fk_account" => $this->getInfo('fk_account'),
	    "fk_parent" => $fk_parent
	);
	return $this->_create($data);
    }

    /* edit directory
     * @param string: new name
     * +@param int: fk of parent
     *
     * @return bool
     */
    public function edit ($name, $fk_parent) {
	if ($this->id == 0) return false;

	// validate
	if (!$this->isValidName($name)
	    or !$this->isValidParent($fk_parent)) {
	    return false;
	}

	// update database
	$data = array(
	    "name" => $name,
	    "fk_parent" => $fk_parent
	);
	return $this->_edit($data);
    }

    /* delete directory
     *
     * @return bool
     */
    public function delete () {

	// is empty?
	if ($this->getSubdirectories() or
	    $this->getSubfiles()) {
	    return false;
	}
	return $this->_delete();
    }

    /* is valid name for directory?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	// TODO: Only unique in parent directory
	return ($name and $this->_validate($name, 'string')
	    and $this->_isUnique('#__fsdirectories', '_name_', $name)
	) ? true : false;
    }

    /* is valid fk_parent for directory?
     * @param int: ID of an directory
     *
     * @return bool
     */
    public function isValidParent ($fk_parent) {
	return ($this->id == 0 or $fk_parent == 0 or
	    ($this->_validate($fk_parent, 'int')
		and $this->_isObject('#__fsdirectories', $fk_parent)
		and !$this->isInChildren($fk_parent))
	) ? true : false;
    }

    /* is directory within childrens of this directory?
     * @param int: ID of an accessgroup
     *
     * @return bool
     */
    public function isInChildren ($id) {

	// own child?
	$children = $this->getSubdirectories();
	foreach ($children as $index => $Child) {
	    if ($Child->getInfo('id') == $id) return true;
	}

	// check for each child
	foreach ($children as $index => $Child) {
	    if ($Child->isInChildren($id)) return true;
	}

	return false;
    }

    /* get parent object
     *
     * @return OBJECT
     */
    public function getParent () {
	if ($this->id == 0) return NULL;
	if (!empty($this->Parent)) return $this->Parent;
	if ($this->getInfo('id') == 1) return false;
	global $TSunic;
	$this->Parent = $TSunic->get('$$$FsDirectory', $this->getInfo('fk_parent'));
	return $this->Parent;
    }

    /* get array of subdirectories
     *
     * @return array
     */
    public function getSubdirectories () {
	if (!empty($this->subdirectories)) return $this->subdirectories;
	global $TSunic;

	// get subdirectories from database
	$sql = "SELECT id
		FROM #__fsdirectories
		WHERE fk_parent = '$this->id'
		    AND fk_account = '".$this->getInfo('fk_account')."';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return $result;

	// create objects
	$this->subdirectories = array();
	foreach ($result as $index => $values) {
	    $this->subdirectories[] = $TSunic->get('$$$FsDirectory', $values['id']);
	}
	return $this->subdirectories;
    }

    /* get array of files in directory
     *
     * @return array
     */
    public function getSubfiles () {
	if (!empty($this->subfiles)) return $this->subfiles;
	global $TSunic;

	// get subdirectories from database
	$sql = "SELECT id
		FROM #__fsfiles
		WHERE fk_directory = '$this->id'
		    AND fk_account = '".$this->getInfo('fk_account')."';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return $result;

	// create objects
	$this->subfiles = array();
	foreach ($result as $index => $values) {
	    $this->subfiles[] = $TSunic->get('$$$FsFile', $values['id']);
	}
	return $this->subfiles;
    }

    /* get all available directories
     *
     * @return array/false
     */
    public function allDirectories () {
	global $TSunic;
	$sql = "SELECT id
		FROM #__fsdirectories
		WHERE fk_account = '".$this->getInfo('fk_account')."';";
	$result = $TSunic->Db->doSelect($sql);

	// create output array
	$output = array();
	foreach ($result as $index => $values) {
	    $output[$values['id']] =
		$TSunic->get('$$$FsDirectory', $values['id']);
	}

	return $output;
    }

    /* get absolute path to this folder in filesystem
     *
     * @return string
     */
    public function getAbsPath () {
	if (!$this->isValid()) return false;
	$name = $this->getInfo('name');
	return ($this->getInfo('fk_directory')) ? $this->getParent()->getAbsPath()."/$name" : "$name";
    }

    /* get consumed webspace (bytes)
     *
     * @return int
     */
    public function consumedBytes () {
	global $TSunic;
	// TODO: optimize query (SUM)
	$sql = "SELECT bytes as bytes
		FROM #__fsfiles
		WHERE fk_account = '".$this->getInfo('fk_account')."'";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return 0;
	$sum = 0;
	foreach ($result as $index => $values) {
	    $sum+= $values['bytes'];
	}
	return $sum;
    }
}
?>
