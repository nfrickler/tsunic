<!-- | CLASS Note -->
<?php
class $$$Note extends $filesystem$File {

    /* save note
     * @param string: path
     * @param string: content
     *
     * @return bool
     */
    public function saveNote ($path, $content) {

	// create new object
	if (!$this->isValid() and !$this->create()) return false;

	// get filename and Directory
	list($dirname, $filename) = $this->splitPath2names($path);
	$Dir = $this->path2dir($dirname);
	if (!$Dir or (!$filename and !$this->getInfo('name'))) {
	    $this->delete();
	    return false;
	}

	// save filename and Directory
	if (!$this->saveByTag('FILE__NAME', $filename) or
	    !$this->saveByTag('FILE__PARENT', $Dir->getInfo('id'))
	) {
	    $this->delete();
	    return false;
	}

	// save content
	if (!$this->setContent($content)) {
	    $this->delete();
	    return false;
	}

	return true;
    }

    /* get class of this object
     *
     * @return string
     */
    public function getClass () {
	return '$filesystem$File';
    }
}
?>
