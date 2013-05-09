<!-- | CLASS File -->
<?php
/**
 * This class handles files (read/write/move/delete)
 */
class $$$File {

    /** Path of file
     * @var string $path
     */
    protected $path;

    /** MIME type of file
     * @var string $mime_type
     */
    protected $mime_type;

    /** Regex to validate filenames
     * @var string $allowed_letters
     */
    protected $allowed_letters = 'A-Za-z0-9_-.';

    /** Constructor
     * @param bool|string $path
     *	Path of file
     */
    public function __construct ($path = false) {

	// save input
	$this->setPath($path);

	return;
    }

    /** Set path
     * @param string $path
     *	Path of file
     *
     * @return bool
     */
    public function setPath ($path) {
	global $TSunic;

	// get phrases to replace
	$to_replace = array();
	$to_replace['#data#'] = $TSunic->Config->get('dir_data').'/';
	$to_replace['#runtime#'] = $TSunic->Config->get('dir_runtime').'/';
	$to_replace['#admin#'] = $TSunic->Config->get('dir_admin').'/';

	// replace phrases
	foreach ($to_replace as $index => $value) {
	    $path = str_replace($index, $value, $path);
	}

	// save path in obj-var
	$this->path = $path;

	return true;
    }

    /* ######################### get info about file #################### */

    /** Get filesize
     *
     * @return int
     */
    public function getFilesize () {
	return ($this->isFile()) ? filesize($this->getPath()) : 0;
    }

    /** Check, if valid file
     *
     * @return bool
     */
    public function isValid () {
	return $this->isFile();
    }

    /** Get MIME type of file
     *
     * @return string
     */
    public function getMimeType () {
	$type = false;

	// check, if file exist
	if (!$this->isFile()) return false;

	// heck, if mime_type already checked
	if (!empty($this->mime_type)) return $this->mime_type;

	// try to get mime-type
	if (function_exists('finfo_file')) {

	    // PHP >= 5.3.0, PECL fileinfo >= 0.1.0
	    $finfo = finfo_open(FILEINFO_MIME_TYPE);

	    // get absolute path
	    $path = $this->getPath();

	    // get info
	    $type = finfo_file($finfo, $path);
	    finfo_close($finfo);
	} else {
	    // PHP < 5.3.0
	    // require_once 'upgradephp/ext/mime.php';
	    $type = mime_content_type($this->getPath());
	}

	// try OS file-command
	if (!$type OR $type == 'application/octet-stream') {
	    $secondOpinion = exec(
		'file -b --mime-type '.escapeshellarg($this->getPath()),
		$foo,
		$returnCode
	    );
	    if ($returnCode == '0' && $secondOpinion) {
		$type = $secondOpinion;
	    }
	}

	// try exif_imagetype
	if (!$type OR $type == 'application/octet-stream') {
	    // require_once 'upgradephp/ext/mime.php';
	    $exifImageType = exif_imagetype($this->getPath());
	    if ($exifImageType !== false) {
		$type = image_type_to_mime_type($exifImageType);
	    }
	}

	// save type in obj-vars
	$this->mime_type = $type;
	return $type;
    }

    /** Check, if file exist
     *
     * @return bool
     */
    public function isFile () {
	return file_exists($this->getPath());
    }

    /** Get path of file
     * @param bool $folder_only
     *	Get path of folder only
     *
     * @return string|bool
     */
    public function getPath ($folder_only = false) {

	// is path?
	if (empty($this->path)) return false;

	// folder-path only?
	if ($folder_only) {
	    $cache = explode('/', $this->path);

	    // is already a folder?
	    if (!strstr(end($cache), '.')) return $this->path;

	    // get folder
	    unset($cache[(count($cache)-1)]);
	    return implode('/', $cache);
	}

	// return full path
	return $this->path;
    }

    /** Get filename
     *
     * @return string
     */
    public function getFilename () {
	return (empty($this->path)) ? false : basename($this->path);
    }

    /* ##################### delete/move/rename ######################### */

    /** Upload file
     * @param array $FH
     *	Content of $__FILES
     * @param string $new_path
     *	Path, where file is going to be moved to
     *
     * @return bool
     */
    public function uploadFile ($FH, $new_path) {

	// make sure, directory exists
	$this->mkFolder(dirname($new_path));

	// upload file
	return (move_uploaded_file($FH['tmp_name'], $new_path))
	    ? true : false;
    }

    /** Delete file
     *
     * @return bool
     */
    public function deleteFile () {
	return (!file_exists($this->getPath())
	    OR unlink($this->getPath())) ? true : false;
    }

    /** Rename file
     * @param string $new_name
     *	New name of file
     *
     * @return bool
     */
    public function renameFile ($new_name) {

	// check $new_name
	if (preg_match('°[^'.$this->allowed_letters.']°', $new_name) != 0) {
	    // invalid filename
	    return false;
	}

	// get new path
	$new_path = strrev(strrchr(strrev($this->getPath()), '/'));
	$new_path.= $new_name;

	// rename file
	if (rename($this->getPath(), $new_path)) {
	    $this->path = $new_path;
	    return true;
	}

	return false;
    }

    /** Move file
     * @param string $new_path
     *	Path, where file shall to be moved to
     *
     * @return bool
     */
    public function moveFile ($new_path) {

	// check dir
	// TODO

	// create dir, if neccessary
	// TODOMimeType

	// move file
	if (rename($this->getPath(), $new_path)) {
	    $this->path = $new_path;
	    return true;
	}

	return true;
    }

    /** Include file
     * @param bool $once
     *	Include once only
     *
     * @return bool
     */
    public function includeFile ($once = false) {

	if ($this->isFile()) {
	    // file exists
	    if ($once) {
		include_once $this->getPath();
	    } else {
		include $this->getPath();
	    }
	} else {
	    // file not found
	    return false;
	}
	return true;
    }

    /* ######################### read from file ######################### */

    /** Get content of file as string
     * @param bool $as_string
     *	Return content as string (as array otherwise)
     *
     * @return string
     */
    public function readFile ($as_string = false) {
	global $TSunic;

	// try to read content
	if (!$this->isFile()) {
	    $TSunic->Log->log(3, 'Couldn\'t read from "'.$this->path.'"!');
	    return ($as_string) ? '' : array();
	}

	// read
	$content = file_get_contents($this->getPath());

	if ($content === false) {
	    $TSunic->Log->log(3, 'Couldn\'t read from "'.$this->path.'"!');
	    return ($as_string) ? '' : array();
	}

	// return content
	return ($as_string AND is_array($content)) ? implode(chr(10), $content) : $content;
    }

    /* ######################### write to file ########################## */

    /** Write content in file
     * @param string $content
     *	Content to write in file
     *
     * @return bool
     */
    public function writeFile ($content) {
	global $TSunic;

	// make sure, path exists
	if (!$this->mkFolder(dirname($this->getPath(true)))) return false;

	// open file
	$file = @fopen($this->getPath(), "w");
	if ($file) {

	    // try to write file
	    $return = @fwrite($file, $content);

	    // close file
	    @fclose($file);

	    // success?
	    if (is_numeric($return)) return $return;
	}

	$TSunic->Log->log(3, 'Couldn\'t write to "'.$this->path.'"!');
	return false;
    }

    /** Append to end of file
     * @param sting $to_add
     *	Content to add to file
     *
     * @return bool
     */
    public function writeAdd ($to_add) {

	// get content
	$content = $this->readFile(true);

	// append to the end
	$content.= "\n".$to_add;

	// write file
	if (!$this->writeFile($content)) return false;
	return true;
    }

    /* ######################### folder operations ###################### */

    /** Create folder, if not exists (recursively)
     * @param string $path
     *	Path of folder
     *
     * @return bool
     */
    public function mkFolder ($path) {
	global $TSunic;

	// is folder?
	if (is_dir($path)) return true;
	if (file_exists($path) AND !is_dir($path)) return false;

	// check towards root directory!
	$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
	$return = self::mkFolder($prev_path);
	return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    /** Get subfolders
     *
     * @return array
     */
    public function getSubfolders () {
	$subfolders = array();

	// validate input
	if (!$this->getPath(true) OR !is_dir($this->getPath(true))) return array();

	// get subfolders
	$openfolder = opendir($this->getPath(true));
	while ($thefile = readdir($openfolder)) {
	    if ($thefile == '.' OR $thefile == '..' OR !is_dir($this->getPath(true).'/'.$thefile)) continue;
	    $subfolders[] = $thefile;
	}
	closedir($openfolder);

	return $subfolders;
    }

    /** Get files within folder
     *
     * @return array
     */
    public function getSubfiles () {
	$subfiles = array();

	// validate input
	if (!$this->getPath(true) OR !is_dir($this->getPath(true))) return array();

	// get subfiles
	$openfolder = opendir($this->getPath(true));
	while ($thefile = readdir($openfolder)) {
	    if ($thefile == '.' OR $thefile == '..' OR is_dir($this->getPath(true).'/'.$thefile)) continue;
	    $subfiles[] = $thefile;
	}
	closedir($openfolder);

	return $subfiles;
    }
}
?>
