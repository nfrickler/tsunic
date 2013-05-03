<!-- | CLASS Filesystem -->
<?php
/** TSunic filesystem
 *
 * This offers the root of TSunics filesystem
 */
class $$$Filesystem {

    /** All available Directory objects
     * @var array $directories
     */
    protected $directories = array();

    /** All available File objects
     * @var array $files
     */
    protected $files = array();

    /** All available Image objects
     * @var array $images
     */
    protected $images = array();

    /** Get all available directories
     *
     * @return array
     */
    public function getDirectories () {
	global $TSunic;

	// get all directories
	if (empty($this->directories)) {
	    $Helper = $TSunic->get('$bp$Helper');
	    $this->directories = $Helper->getObjects('$$$Directory');
	}

	return $this->directories;
    }

    /** Get all available files
     *
     * @return array
     */
    public function getFiles () {
	global $TSunic;

	// get all files
	if (empty($this->files) and empty($this->images)) {
	    $Helper = $TSunic->get('$bp$Helper');
	    $this->files = $Helper->getObjects('$$$File');
	    $this->images = $Helper->getObjects('$$$Image');
	}

	return array_merge($this->images, $this->files);
    }

    /** Get directory object to certain path (create if not exists)
     * @param string $path
     *	Path to directory
     *
     * @return Directory
     */
    public function path2dir ($path) {
	global $TSunic;

	// get root directory
	$Dir = $TSunic->get('$$$Directory');
	if (empty($path)) return $Dir;

	// normalize and split path
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
		// create new Directory
		$Next = $TSunic->get('$$$Directory', array(), true);
		if (!$Next->create()) return NULL;
		if (!$Next->saveByTag('DIRECTORY__NAME', $current) or
		    !$Next->saveByTag('DIRECTORY__PARENT', $Dir->getInfo('id'))
		) return NULL;
	    }

	    $Dir = $Next;
	}

	return $Dir;
    }
}
?>
