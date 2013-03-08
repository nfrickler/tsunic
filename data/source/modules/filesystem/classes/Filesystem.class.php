<!-- | Filesystem class -->
<?php
class $$$Filesystem {

    /* all available Directory objects
     * array
     */
    protected $directories = array();

    /* all available File objects
     * array
     */
    protected $files = array();

    /* all available Image objects
     * array
     */
    protected $images = array();

    /* get all available directories
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

    /* get all available files
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
}
?>
