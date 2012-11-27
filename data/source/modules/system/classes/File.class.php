<!-- | CLASS File -->
<?php
class $$$File {

    /* path of file
     * string
     */
    protected $path;

    /* create no log-messages?
     * bool
     */
    protected $silent_mode;

    /* mime_type of file
     * string
     */
    protected $mime_type;

    /* allowed letters in filename
     * regex-string
     */
    protected $allowed_letters = 'A-Za-z0-9_-.';

    /* constructor
     * +@param bool/string: path of file
     */
    public function __construct ($path = false, $silent_mode = false) {

	// save input
	$this->setPath($path);
	$this->silent_mode = $silent_mode;

	return;
    }

    /* set path
     * @param string: path of file
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

    /* check, if valid file
     *
     * @return bool
     */
    public function isValid () {
	return $this->isFile();
    }

    /* get mime-type of file
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

    /* check, if file exist
     *
     * @return bool
     */
    public function isFile () {
	return file_exists($this->getPath());
    }

    /* get path
     * +@param bool: get folder-path only
     *
     * @return string/bool
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

    /* get filename
     *
     * @return string
     */
    public function getFilename () {
	return (empty($this->path)) ? false : basename($this->path);
    }

    /* ##################### delete/move/rename ######################### */

    /* upload file
     * @param string: path, where file is going to be moved to
     *
     * @return bool
     */
    public function uploadFile ($new_path) {
	// TODO
	return true;
    }

    /* delete file
     *
     * @return bool
     */
    public function deleteFile () {
	return (!file_exists($this->getPath())
	    OR unlink($this->getPath())) ? true : false;
    }

    /* rename file
     * @param string: new name of file
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

    /* move file
     * @param string: path, where file is going to be moved to
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

    /* include file
     * @param bool: include once only
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

    /* get content of file as string
     * +@param bool: true - return as string; false - return as array
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

    /* write content in file
     * @param string: content to write in file
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

    /* append $to_add to end of file
     * @param sting: content to add to file
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

    /* create folder, if not exists (recursively)
     * @param string: path to folder
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

    /* get subfolders
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

    /* get files within folder
     * @param string: path to basis-folder
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
