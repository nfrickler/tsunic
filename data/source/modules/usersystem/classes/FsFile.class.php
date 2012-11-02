<!-- | CLASS File (filesystem) -->
<?php
include_once '$system$Object.class.php';
class $$$FsFile extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = "#__fsfiles";

    /* directory containing this file
     * object
     */
    protected $Directory;

    /* create new file
     * @param file-handler: file handler of uploaded file
     * +@param int: fk of directory
     *
     * @return bool
     */
    public function createByUpload ($FH, $fk_directory = 0) {

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
	global $TSunic;
	$data = array(
	    "name" => $name,
	    "bytes" => $FH['size'],
	    "dateOfCreation" => "NOW()",
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "fk_directory" => $fk_directory
	);
	if (!$this->_create($data)) return false;

	// upload file
	if (move_uploaded_file($FH['tmp_name'], $this->getPath())) {

	    // encrypt content of file
	    $this->setContent($this->getContent());

	    return true;
	}

	// delete file in database
	$this->delete();
	return false;
    }

    /* create new file
     * @param int: id of directory
     * @param string: filename
     * @param string: content
     *
     * @return bool
     */
    public function create ($fk_directory, $name, $content) {

	// validate
	if (!$this->isValidDirectory($fk_directory)
	    or !$this->isValidName($name)
	) return false;

	// update database
	global $TSunic;
	$data = array(
	    "name" => $name,
	    "dateOfCreation" => "NOW()",
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "fk_directory" => $fk_directory
	);
	if (!$this->_create($data)) return false;

	// create new file
	$File = $this->getFileObject();
	$bytes = ($File) ? $File->writeFile($content) : false;
	if (!$bytes) {
	    $this->delete();
	    return false;
	}

	// update filesize
	$data = array(
	    "bytes" => $bytes
	);
	return $this->_edit($data);
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

	// update database
	$data = array(
	    "name" => $name,
	    "fk_directory" => $fk_directory
	);
	return $this->_edit($data);
    }

    /* get corresponding file-object
     *
     * @return File object
     */
    protected function getFileObject () {
	if (!$this->getInfo('id')) return NULL;
	global $TSunic;
	$File = $TSunic->get('$system$File', '#private#file__'.$this->getInfo('id'));
	return ($File) ? $File : NULL;
    }

    /* get path of this file
     *
     * @return string
     */
    protected function getPath () {
	$File = $this->getFileObject();
	return ($File) ? $File->getPath() : '';
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
	    $TSunic->Log->log(3, 'usersystem::FsFile::delete: Could not delete file!');
	    return false;
	}

	return $this->_delete();
    }

    /* is valid name for file?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	// TODO: Unique in parent directory
	return ($this->_validate($name, 'filename')) ? true : false;
    }

    /* is valid file to upload
     * @param file-handle: file handle of file to upload
     *
     * @return bool
     */
    public function isValidFile ($FH) {
	return ($this->isValidFilesize($FH['size']) and
	    $this->isValidQuota($FH['size'])) ? true : false;
    }

    /* is within allowed filesize
     * @param int: bytes of new file
     *
     * @return bool
     */
    public function isValidFilesize ($filesize) {
	global $TSunic;
	return ($filesize <= $TSunic->Usr->config('$$$maxfilesize')) ? true : false;
    }

    /* is within allowed filesystem size
     * @param int: bytes of new file
     *
     * @return bool
     */
    public function isValidQuota ($filesize) {
	global $TSunic;
	$Dir = $TSunic->get('$$$FsDirectory');
	return (($Dir->consumedBytes() + $filesize) <=
	    $TSunic->Usr->config('$$$filesystem_quota')) ? true : false;
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

    /* get mime-type of file
     *
     * @return string
     */
    public function getMimeType () {
	$File = $this->getFileObject();
	return ($File) ? $File->getMimeType() : '';
    }

    /* get content of file
     *
     * @return string
     */
    public function getContent () {
	$File = $this->getFileObject();
	if (!$File or !$File->isValid()) return false;

	global $TSunic;
	$content = $File->readFile();
	return $TSunic->Usr->decrypt($content);
    }

    /* set content of file
     * @param string: new content of file
     *
     * @return string
     */
    public function setContent ($content) {
	$File = $this->getFileObject();
	if (!$File) return false;

	global $TSunic;
	$content = $TSunic->Usr->encrypt($content);
	return ($File->writeFile($content)) ? true : false;
    }

    /* is valid object?
     *
     * @return string
     */
    public function isValid () {
	if (!parent::isValid()) return false;

	// only valid with existing file
	$File = $this->getFileObject();
	return $File->isValid();
    }

    /* get absolute path to this file in filesystem
     *
     * @return string
     */
    public function getAbsPath () {
	if (!$this->isValid()) return false;
	$name = $this->getInfo('name');
	return ($this->getInfo('fk_directory')) ? $this->getDirectory()->getAbsPath()."/$name" : "$name";
    }

    /* get directory object to certain path
     *
     * @return FsDirectory
     */
    public function path2dir ($path) {
	global $TSunic;
	$Dir = $TSunic->get('$$$FsDirectory');

	if (empty($path)) return $Dir;
	if (substr($path,0,1) == "/") $path = substr($path, 1);
	$names = explode("/",$path);

	// follow path
	$Next = false;
	while ($current = array_shift($names)) {

	    // subdirs
	    $subdirs = $Dir->getSubdirectories();
	    foreach ($subdirs as $index => $Value) {
		if ($Value->getInfo('name') == $name) {
		    $Next = $Value;
		    break;
		}
	    }

	    // not exists?
	    if (!$Next) {
		$Next = $TSunic->get('$$$FsDirectory');
		if (!$Next->create($current, $Dir->getInfo('id'))) return NULL;
	    }

	    $Dir = $Next;
	}

	return $Dir;
    }
}
?>
