<!-- | Filesystem class -->
<?php
class $$$Filesystem {

    /* all available FsDirectory objects
     * array
     */
    protected $directories = array();

    /* all available FsFile objects
     * array
     */
    protected $files = array();

    /* get all available directories
     *
     * @return array
     */
    public function getDirectories () {
	global $TSunic;

	// get all directories
	if (empty($this->directories)) {
	    $Helper = $TSunic->get('$bp$Helper');
	    $this->directories = $Helper->getObjects('$$$FsDirectory');
	}

	return $this->directories;
    }

    /* get all available files
     *
     * @return array
     */
    public function getFiles () {
	global $TSunic;

	// get all files
	if (empty($this->files)) {
	    $Helper = $TSunic->get('$bp$Helper');
	    $this->files = $Helper->getObjects('$$$FsFile');
	}

	return $this->files;
    }
}
?>
