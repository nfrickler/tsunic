<!-- | Mapping own filesystem to webdav -->
<?php

/**
 * Collection class
 *
 * This is a helper class, that should aid in getting collections classes setup.
 * Most of its methods are implemented, and throw permission denied exceptions
 *
 * @package Sabre
 * @subpackage DAV
 * @copyright Copyright (C) 2007-2012 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/)
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
class DavCollection extends Sabre_DAV_Node implements Sabre_DAV_ICollection {

    /* Directory object
     * object
     */
    protected $Dir;

    /* constructor
     * +@param object: FsDirectory
     */
    public function __construct ($Dir = NULL) {
	global $TSunic;

	// init
	if (!$Dir) $Dir = $TSunic->get('$$$FsDirectory');

	// save
	$this->Dir = $Dir;
    }

    /* get subdir/file by name
     * @param string: name of dir/file
     * @throws Sabre_DAV_Exception_NotFound
     * @return Sabre_DAV_INode
     */
    public function getChild($name) {
	foreach($this->getChildren() as $child) {
	    if ($child->getName()==$name) return $child;
	}
	throw new Sabre_DAV_Exception_NotFound('File not found: ' . $name);
    }

    /* check, if child-node exists
     * @param string: name
     * @return bool
     */
    public function childExists($name) {
	try {
	    $this->getChild($name);
	    return true;
	} catch(Sabre_DAV_Exception_NotFound $e) {
	    return false;
	}
    }

    /* create new file
     *
     * @param string: Name of the file
     * @param resource|string: Initial payload
     * @return null|string
     */
    public function createFile($name, $data = null) {
	global $TSunic;
	$NewFile = $TSunic->get('$$$FsFile');
	if (!$NewFile->create($this->Dir->getInfo('id'), $name, $data)) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to create file (filename ' . $name . ')');
	}
    }

    /* Create new subdirectory
     *
     * @param string: $name
     * @throws Sabre_DAV_Exception_Forbidden
     * @return void
     */
    public function createDirectory($name) {
	global $TSunic;
	$NewDir = $TSunic->get('$$$FsDirectory');
	if (!$NewDir->create($name, $this->Dir->getInfo('id'))) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to create directory');
	}
    }

    /* get name of directory
     *
     * @return string
     */
    public function getName() {
	return ($this->Dir) ? $this->Dir->getInfo('name') : "Unknown";
    }

    /* get all childs
     *
     * @return array
     */
    public function getChildren () {
	if (!$this->Dir) return array();
	$out = array();

	// get all subdirectories
	$dirs = $this->Dir->getSubdirectories();
	foreach ($dirs as $index => $Value) {
	    $out[] = new DavCollection($Value);
	}

	// get all subfiles
	$files = $this->Dir->getSubfiles();
	foreach ($files as $index => $Value) {
	    $out[] = new DavFile($Value);
	}

	return $out;
    }
}
