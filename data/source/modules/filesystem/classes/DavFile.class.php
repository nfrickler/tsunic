<!-- | Mapping webdav files to filesystem -->
<?php

/**
 * File class
 *
 * This is a helper class, that should aid in getting file classes setup.
 * Most of its methods are implemented, and throw permission denied exceptions
 *
 * @package Sabre
 * @subpackage DAV
 * @copyright Copyright (C) 2007-2012 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/)
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
class DavFile extends Sabre_DAV_Node implements Sabre_DAV_IFile {

    /* FsFile object
     * object
     */
    protected $File;

    /* constructor
     * +@param object: FsFile
     */
    public function __construct ($File = NULL) {
	// save
	$this->File = $File;
    }

    /* get name of file
     *
     * @return string
     */
    public function getName() {
	return ($this->File) ? $this->File->getInfo('name') : "Unknown";
    }

    /* update content of file
     * @param string: new content
     *
     * @return void
     */
    public function put($data) {
	if ($this->File and $this->File->setContent($data))
	    return;
        throw new Sabre_DAV_Exception_Forbidden('Permission denied to change data');
    }

    /* get content of file
     *
     * @return mixed
     */
    public function get() {
	if ($this->File) return $this->File->getContent();
        throw new Sabre_DAV_Exception_Forbidden('Permission denied to read this file');

    }

    /* get size of file
     *
     * @return int
     */
    public function getSize() {
	return ($this->File) ? $this->File->getInfo('bytes') : 0;
    }

    /**
     * Returns the ETag for a file
     *
     * An ETag is a unique identifier representing the current version of the file. If the file changes, the ETag MUST change.
     * The ETag is an arbitrary string, but MUST be surrounded by double-quotes.
     *
     * Return null if the ETag can not effectively be determined
     *
     * @return string|null
     */
    public function getETag() {
        return null;
    }

    /* get mime type (otherwise assumed: application/octet-stream
     *
     * @return string|null
     */
    public function getContentType() {
	return ($this->File) ? $this->File->getMimeType() : NULL;
    }
}
