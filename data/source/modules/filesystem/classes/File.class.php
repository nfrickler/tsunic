<!-- | CLASS File -->
<?php
/** File object in TSunic filesystem
 *
 * This object represents a file in TSunics filesystem
 */
class $$$File extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
     */
    protected $tags = array(
	'FILE__NAME',
	'FILE__PARENT',
	'FILE__SIZE',
    );

    /** Parent directory
     * @var Directory $Directory
     */
    protected $Directory;

    /** Create new file
     * @param file-handler $FH
     *	File handler of uploaded file
     *
     * @return bool
     */
    public function createByUpload ($FH) {

	// validate
	if (!$this->isValidFile($FH)) return false;

	// create object
	if (!$this->create()) return false;

	// set name
	$name = $this->getValidName($FH['name']);
	if (!$this->addBit($name, 'FILE__NAME')) return false;

	// upload file
	$File = $this->getFileObject();
	if (!$File->uploadFile($FH, $this->getPath())) {
	    $this->delete();
	    return false;
	}

	// encrypt content of file
	$this->setContent($this->getContent());

	return true;
    }

    /** Create new file with certain values
     * @param Directory $parent
     *	Parent directory
     * @param string $name
     *	Name of file
     * @param string $content
     *	Content of file
     *
     * @return bool
     */
    public function createByValues ($parent, $name, $content) {
	global $TSunic;

	// create object
	if (!$this->create()) return false;

	// get valid name
	$name = $this->getValidName($name);

	// set name
	if (!$this->addBit($name, 'FILE__NAME')) return false;
	if (!$this->addBit($parent, 'FILE__PARENT')) return false;

	// create file
	if (!$this->setContent($content)) return false;

	return true;
    }

    /** Is valid filename?
     * @param string $name
     *	Name
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

    /** Get valid name
     * @param string $name
     *	Original name
     *
     * @return string
     */
    public function getValidName ($name) {
	if (!$this->isValidName($name)) {
	    $counter = 0;
	    while (!$this->isValidName($name.'_'.$counter)) {
		$counter++;
	    }
	    $name.= '_'.$counter;
	}
	return $name;
    }

    /** Get name to show
     *
     * @return string
     */
    public function getName () {
	return $this->getAbsPath();
    }

    /** Get corresponding File object
     *
     * @return File
     */
    public function getFileObject () {
	if (!$this->getInfo('id')) return NULL;
	global $TSunic;
	$File = $TSunic->get('$system$File', '#data#users/file__'.$this->getInfo('id'));
	return ($File) ? $File : NULL;
    }

    /** Get parent Directory object
     *
     * @return Directory
     */
    protected function getParent () {
	global $TSunic;
	$fk_dir = $this->getInfo('parent');
	return $TSunic->get('$$$Directory', $fk_dir);
    }

    /** Get path of this file
     *
     * @return string
     */
    protected function getPath () {
	$File = $this->getFileObject();
	return ($File) ? $File->getPath() : '';
    }

    /** Delete file
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

    /** Is valid file to upload
     * @param file-handle $FH
     *	File handle of file to upload
     *
     * @return bool
     */
    public function isValidFile ($FH) {
	return ($this->isValidFilesize($FH['size']) and
	    $this->isValidQuota($FH['size'])) ? true : false;
    }

    /** Is within allowed filesize
     * @param int $filesize
     *	Bytes of new file
     *
     * @return bool
     */
    public function isValidFilesize ($filesize) {
	global $TSunic;
	return ($filesize <= $TSunic->Usr->config('$$$maxfilesize')) ? true : false;
    }

    /** Is within allowed filesystem size
     * @param int $filesize
     *	Bytes of new file
     *
     * @return bool
     */
    public function isValidQuota ($filesize) {
	global $TSunic;
	$Dir = $TSunic->get('$$$Directory');
	return (($Dir->consumedBytes() + $filesize) <=
	    $TSunic->Usr->config('$$$quota')) ? true : false;
    }

    /** Get directory, that contains this file
     *
     * @return Directory
     */
    public function getDirectory () {
	if (!empty($this->Directory)) return $this->Directory;
	global $TSunic;
	$this->Directory = $TSunic->get('$$$Directory', $this->getInfo('parent'));
	return $this->Directory;
    }

    /** Get mime-type of file
     *
     * @return string
     */
    public function getMimeType () {
	$File = $this->getFileObject();
	return ($File) ? $File->getMimeType() : '';
    }

    /** Get content of file
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

    /** Set content of file
     * @param string $content
     *	New content of file
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

    /** Is valid object?
     *
     * @return string
     */
    public function isValid () {
	if (!parent::isValid()) return false;

	// only valid with existing file
	$File = $this->getFileObject();
	return $File->isValid();
    }

    /** Get absolute path to this file in filesystem
     *
     * @return string
     */
    public function getAbsPath () {
	$name = $this->getInfo('name');
	return ($this->getInfo('parent')) ? $this->getDirectory()->getAbsPath()."/$name" : "$name";
    }

    /** Get directory object to certain path
     * @param string $path
     *	Path to directory
     *
     * @return Directory
     */
    public function path2dir ($path) {
	global $TSunic;
	$Filesystem = $TSunic->get('$$$Filesystem');
	return $Filesystem->path2dir($path);
    }

    /** Split path of file to dir and file path
     *
     * @return Directory
     */
    public function splitPath2names ($path) {
	if (!strstr($path, '/')) return array('', $path);

	// normalize path
	if (substr($path,0,1) == "/") $path = substr($path, 1);

	// split
	$file = substr(strrchr($path, "/"), 1);
	$dir = substr($path, 0, (strlen($path) - strlen($file) - 1));

	return array($dir, $file);
    }
}
?>
