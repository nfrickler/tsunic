<!-- | CLASS DavFile -->
<?php
/** Mapping TSunic files to webdav files
 *
 * This class maps TSunic files to webdav files
 */
class $$$DavFile extends Sabre_DAV_File implements Sabre_DAV_IFile {

    /** File object
     * @var File $File
     */
    protected $File;

    /** Constructor
     * @param File $File
     *	File object
     */
    public function __construct ($File = NULL) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::__construct('".$File->getInfo('name')."')");

	// save
	$this->File = $File;
    }

    /** Get name of file
     *
     * @return string
     */
    public function getName() {
	return ($this->File) ? $this->File->getInfo('name') : "Unknown";
    }

    /** Update content of file
     * @param string $data
     *	New content
     *
     * @return void
     */
    public function put($data) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::put");

	// is resource?
	if (is_resource($data)) {
	    // limited to 5 MB (TODO: => config)
	    $mydata = fread($data,1024*1024*10);
	    fclose($data);
	    $data = $mydata;
	}

	if ($this->File and $this->File->setContent($data))
	    return;
	throw new Sabre_DAV_Exception_Forbidden('Permission denied to change data');
    }

    /** Get content of file
     *
     * @return mix
     */
    public function get() {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::get");

	if ($this->File) return $this->File->getContent();
	throw new Sabre_DAV_Exception_Forbidden('Permission denied to read this file');
    }

    /** Get size of file
     *
     * @return int
     */
    public function getSize() {
	return ($this->File) ? $this->File->getInfo('bytes') : 0;
    }

    /** Returns the ETag for a file
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

    /** Get mime type (otherwise assumed: application/octet-stream
     *
     * @return string|null
     */
    public function getContentType() {
	return ($this->File) ? $this->File->getMimeType() : NULL;
    }

    /** Delete file
     *
     * @return void
     */
    public function delete () {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::delete");

	if (!$this->File->delete()) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to delete this file');
	}
    }

    /** Rename file
     * @param string $name
     *	New name
     *
     * @return void
     */
    public function setName ($name) {
	global $TSunic;
	$TSunic->Log->log(9, "filesystem::DavFile::setName");

	if (!$this->File->edit($name)) {
	    throw new Sabre_DAV_Exception_Forbidden('Permission denied to rename this file');
	}
    }
}
?>
