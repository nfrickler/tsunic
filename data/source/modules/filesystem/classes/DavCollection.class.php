<!-- | CLASS DavCollection -->
<?php
/** Mapping TSunic folder to webdav folder
 *
 * This class maps a TSunic folder to a webdav folder
 */
class $$$DavCollection extends Sabre_DAV_Collection implements Sabre_DAV_ICollection {

    /** Directory object
     * @var Directory $Dir
     */
    protected $Dir;

    /** Constructor
     * @param Directory $Dir
     */
    public function __construct ($Dir = NULL) {
	global $TSunic;

	// save dir
	if (!$Dir) $Dir = $TSunic->get('$$$FsDirectory');
	$this->Dir = $Dir;

	$TSunic->Log->log(9, "filesystem::DavCollection::__construct('".$Dir->getInfo('name')."')");
    }

    /** Get subdir/file by name
     * @param string $name
     *	Name of dir/file
     * @throws Sabre_DAV_Exception_NotFound
     * @return Sabre_DAV_INode
     */
    public function getChild($name) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::getChild('$name') in '".$this->Dir->getInfo('name')."'");

	foreach($this->getChildren() as $child) {
	    if ($child->getName()==$name) return $child;
	}
	throw new Sabre_DAV_Exception_NotFound('File not found: ' . $name);
    }

    /** Check, if child-node exists
     * @param string $name
     *	Name
     * @return bool
     */
    public function childExists($name) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::childExists('$name') in '".$this->Dir->getInfo('name')."'");

	try {
	    $this->getChild($name);
	    return true;
	} catch(Sabre_DAV_Exception_NotFound $e) {
	    return false;
	}
    }

    /** Create new file
     * @param string $name
     *	Name of the file
     * @param resource|string $data
     *	Initial payload
     * @return null|string
     */
    public function createFile($name, $data = null) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::createFile('$name')");

	// is resource?
	if (is_resource($data)) {
	    // limited to 5 MB (TODO: => config)
	    $mydata = fread($data,1024*1024*10);
	    fclose($data);
	    $data = $mydata;
	}

	$NewFile = $TSunic->get('$$$FsFile');
	if (!$NewFile->create($this->Dir->getInfo('id'), $name, $data)) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to create file (filename ' . $name . ')');
	}
    }

    /** Create new subdirectory
     * @param string $name
     *	Name of new directory
     * @throws Sabre_DAV_Exception_Forbidden
     * @return void
     */
    public function createDirectory($name) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::createDirectory('$name')");

	$NewDir = $TSunic->get('$$$FsDirectory');
	if (!$NewDir->create($name, $this->Dir->getInfo('id'))) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to create directory');
	}
    }

    /** Get name of directory
     *
     * @return string
     */
    public function getName() {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::getName() in '".$this->Dir->getInfo('name')."'");

	return $this->Dir->getInfo('name');
    }

    /** Get all childs
     *
     * @return array
     */
    public function getChildren () {
	$out = array();
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::getChildren() in '".$this->Dir->getInfo('name')."'");

	// get all subdirectories
	$dirs = $this->Dir->getSubdirectories();
	foreach ($dirs as $index => $Value) {
	    $out[] = new $$$DavCollection($Value);
	}

	// get all subfiles
	$files = $this->Dir->getSubfiles();
	foreach ($files as $index => $Value) {
	    $out[] = new $$$DavFile($Value);
	}

	return $out;
    }

    /** Delete directory
     *
     * @return void
     */
    public function delete () {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::delete");

	if (!$this->Dir->delete()) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to delete this directory');
	}
    }

    /** Rename directory
     * @param string $name
     *	New name
     *
     * @return void
     */
    public function setName ($name) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavCollection::setName");

	if (!$this->Dir->edit($name)) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to rename this directory');
	}
    }
}
?>
