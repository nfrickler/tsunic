<!-- | CLASS Directory -->
<?php
/** Directory in TSunic filesystem
 *
 * This class represents a directory object in TSunics filesystem
 */
class $$$Directory extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
     */
    protected $tags = array(
	'DIRECTORY__NAME',
	'DIRECTORY__PARENT'
    );

    /** Sub directories
     * @var array $subdirectories
     */
    protected $subdirectories;

    /** Delete directory
     *
     * @return bool
     */
    public function delete () {

	// is empty?
	if ($this->getSubdirectories() or
	    $this->getSubfiles()) {
	    return false;
	}

	return parent::delete();
    }

    /** Get name to be shown
     *
     * @return string
     */
    public function getName () {
	return ($this->id) ? $this->getAbsPath() : '{CLASS__DIRECTORY__ROOTDIR}';
    }

    /** Is directory within childrens of this directory?
     * @param int $id
     *	ID of an accessgroup
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

    /** Get parent object
     *
     * @return Directory
     */
    public function getParent () {
	if ($this->id == 0) return NULL;
	if (!empty($this->Parent)) return $this->Parent;
	if ($this->getInfo('id') == 1) return false;
	global $TSunic;
	$this->Parent = $TSunic->get('$$$Directory', $this->getInfo('parent'));
	return $this->Parent;
    }

    /** Get subdir/file by name
     * @param string $name
     *	Name of subdir/file
     *
     * @return File|Directory
     */
    public function getSubByName ($name) {

	// check for subdirectory with that name
	$subdirs = $this->getSubdirectories();
	foreach ($subdirs as $index => $Value) {
	    if ($Value->getInfo('name') == $name) return $Value;
	}

	// check for subfile with that name
	$subfiles = $this->getSubfiles();
	foreach ($subfiles as $index => $Value) {
	    if ($Value->getInfo('name') == $name) return $Value;
	}

	return NULL;
    }

    /** Get array of subdirectories
     *
     * @return array
     */
    public function getSubdirectories () {
	if (!empty($this->subdirectories)) return $this->subdirectories;
	global $TSunic;

	// get all directories
	$Filesystem = $TSunic->get('$$$Filesystem');
	$all = $Filesystem->getDirectories();

	// filter subdirectories
	$this->subdirectories = array();
	foreach ($all as $index => $Value) {
	    if ($Value->getInfo('parent') == $this->id)
		$this->subdirectories[] = $Value;
	}

	return $this->subdirectories;
    }

    /** Get array of files in directory
     *
     * @return array
     */
    public function getSubfiles () {
	if (!empty($this->subfiles)) return $this->subfiles;
	global $TSunic;

	// get all files
	$Filesystem = $TSunic->get('$$$Filesystem');
	$all = $Filesystem->getFiles();

	// filter subfiles
	$this->subfiles = array();
	foreach ($all as $index => $Value) {
	    $parent = $Value->getInfo('parent');
	    if ((empty($parent) and empty($this->id))
		or $parent == $this->id
	    ) $this->subfiles[] = $Value;
	}

	return $this->subfiles;
    }

    /** Get all available directories
     *
     * @return array
     */
    public function allDirectories () {
	global $TSunic;

	// get all directories
	$Filesystem = $TSunic->get('$$$Filesystem');
	return $Filesystem->getDirectories();
    }

    /** Get absolute path to this folder in filesystem
     *
     * @return string
     */
    public function getAbsPath () {
	if (!$this->isValid()) return false;
	$name = $this->getInfo('name');
	return ($this->getParent() and $this->getParent()->getInfo('id')) ? $this->getParent()->getAbsPath()."/$name" : "$name";
    }

    /** Get consumed webspace (bytes)
     *
     * @return int
     */
    public function consumedBytes () {
	global $TSunic;

	// get all files
	$Helper = $TSunic->get('$bp$Helper');
	$all = $Helper->getObjects('$$$File');

	// sum
	$sum = 0;
	foreach ($all as $index => $Value) {
	    $sum+= $Value->getInfo('size');
	}

	return $sum;
    }
}
?>
