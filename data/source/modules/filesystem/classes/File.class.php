<!-- | CLASS File -->
<?php
class $$$File extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'FILE__NAME',
	'FILE__PARENT',
	'FILE__SIZE',
    );

    /* parent directory
     * object
     */
    protected $Directory;

    /* create new file
     * @param file-handler: file handler of uploaded file
     * +@param int: fk of directory
     *
     * @return bool
     */
    public function createByUpload ($FH) {

	// validate
	if (!$this->isValidFile($FH)) return false;

	// get name of file
	$name = $FH['name'];
	$counter = 1;
	while (!$this->isValidName($name)) {
	    $name = 'unknown_file_'.$counter;
	    $counter++;
	}

	// create object
	if (!$this->create()) return false;

	// set name
	if (!$this->addBit($name, 'FILE__NAME')) return false;

	// upload file
	if (!move_uploaded_file($FH['tmp_name'], $this->getPath())) {
	    $this->delete();
	    return false;
	}

	// encrypt content of file
	$this->setContent($this->getContent());

	return true;
    }

    /* is valid filename?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	global $TSunic;
	$Helper = $TSunic->get('$bp$Helper');
	$Tag = $TSunic->get('$bp$Tag', $Helper->tag2id('FILE__NAME'));
	if (!$Tag->getType()->isValidValue($name)) return false;

	// unique in directory?
	$Parent = $this->getParent();
	if ($Parent and $Parent->getSubByName($name)) return false;

	return true;
    }

    /* get name to show
     *
     * @return string
     */
    public function getName () {
	return $this->getAbsPath();
    }

    /* get corresponding file-object
     *
     * @return File object
     */
    public function getFileObject () {
	if (!$this->getInfo('id')) return NULL;
	global $TSunic;
	$File = $TSunic->get('$system$File', '#data#users/file__'.$this->getInfo('id'));
	return ($File) ? $File : NULL;
    }

    /* get parent Directory object
     *
     * @return Directory object
     */
    protected function getParent () {
	global $TSunic;
	$fk_dir = $this->getInfo('parent');
	if (!$fk_dir) return NULL;
	return $TSunic->get('$$$Directory', $fk_dir);
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
	$File = $TSunic->get('$system$File', $this->getPath());
	if (!$File->deleteFile()) {
	    $TSunic->Log->log(3, 'filesystem::File::delete: Could not delete file!');
	    return false;
	}

	return parent::delete();
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
	$Dir = $TSunic->get('$$$Directory');
	return (($Dir->consumedBytes() + $filesize) <=
	    $TSunic->Usr->config('$$$quota')) ? true : false;
    }

    /* get directory, that contains this file
     *
     * @return OBJECT
     */
    public function getDirectory () {
	if (!empty($this->Directory)) return $this->Directory;
	global $TSunic;
	$this->Directory = $TSunic->get('$$$Directory', $this->getInfo('parent'));
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
	$content = $File->readFile(true);
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

	// encrypt content
	$content = $TSunic->Usr->encrypt($content);
	if (!$File->writeFile($content)) return false;

	// update filesize
	$Bit = $this->getBit('FILE__SIZE');
	if (!$this->addeditBit('FILE__SIZE', $Bit->getInfo('id'), $File->getFilesize())) return false;

	return true;
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
	return ($this->getInfo('parent')) ? $this->getDirectory()->getAbsPath()."/$name" : "$name";
    }

    /* get directory object to certain path
     *
     * @return Directory
     */
    public function path2dir ($path) {
	global $TSunic;
	$Dir = $TSunic->get('$$$Directory');

	if (empty($path)) return $Dir;
	if (substr($path,0,1) == "/") $path = substr($path, 1);
	$names = explode("/",$path);

	// follow path
	$Next = false;
	while ($names and $current = array_shift($names)) {
	    $Next = 0;

	    // subdirs
	    $subdirs = $Dir->getSubdirectories();
	    foreach ($subdirs as $index => $Value) {
		if ($Value->getInfo('name') == $current) {
		    $Next = $Value;
		    break;
		}
	    }

	    // not exists?
	    if (!$Next) {
		$Next = $TSunic->get('$$$Directory', array(), true);
		if (!$Next->create($current, $Dir->getInfo('id'))) return NULL;
	    }

	    $Dir = $Next;
	}

	return $Dir;
    }
}
?>
