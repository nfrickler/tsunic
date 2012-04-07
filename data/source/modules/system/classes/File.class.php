<!-- | class to handle files -->
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
	 *
	 * @return OBJECT
	 */
	public function __construct ($path = false, $silent_mode = false) {

		// save input
		$this->setPath($path);
		$this->silent_mode = $silent_mode;

		return;
	}

	/* set path
	 * @param string $path: path of file
	 *
	 * @return bool
	 */
	public function setPath ($path) {
		global $TSunic;

		// get phrases to replace
		$to_replace = array();
		$to_replace['#runtime#'] = $TSunic->Config->getRoot().'/runtime/';
		$to_replace['#private#'] = $TSunic->Config->getRoot(true).'/files/private/';
		$to_replace['#cache#'] = $TSunic->Config->getRoot(true).'/files/cache/';
		$to_replace['#public#'] = $TSunic->Config->getRoot().'/files/public/';
		$to_replace['#project#'] = $TSunic->Config->getRoot().'/files/project/';

		// replace phrases
		foreach ($to_replace as $index => $value) {
			$path = str_replace($index, $value, $path);
		}

		// save path in obj-var
		$this->path = $path;

		return true;
	}

	/* ######################### get info about file ################### */

	/* check, if valid file
	 *
	 * @return bool
	 */
	public function isValid () {
		// check, if file exists
		if ($this->isFile()) return true;
		return false;
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
		if (file_exists($this->getPath())) return true;
		return false;
	}

	/* get path
	 * +@param bool $folder_only: get folder-path only
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
		if (empty($this->path)) return false;
		return basename($this->path);
	}

	/* ##################### delete/move/rename ######################### */

	/* upload file
	 * @param string $new_path: path, where file is going to be moved to
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
		if (!file_exists($this->getPath()) OR unlink($this->getPath())) return true;
		return false;
	}

	/* rename file
	 * @param string $new_name: new name of file
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
		// dirname();
		$new_path.= $new_name;

		// rename file
		if (rename($this->getPath(), $new_path)) {
		    $this->path = $new_path;
			return true;
		}

		return false;
	}
	/* move file
	 * @param string $new_path: path, where file is going to be moved to
	 *
	 * @return bool
	 */
	public function moveFile ($new_path) {

		// check dir
		// TODO

		// create dir, if neccessary
		// TODO

		// move file
		if (rename($this->getPath(), $new_path)) {
		    $this->path = $new_path;
			return true;
		}

		return true;
	}

	/* include file
	 * @param bool $once: include once only
	 *
	 * @return bool
	 */
	public function includeFile ($once = false) {
		global $TSunic;

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

	/* ######################### read from file ############################# */

	/* get content of file as string
	 * +@param bool $as_string: true - return as string; false - return as array
	 *
	 * @return string
	 */
	public function readFile ($as_string = false) {
		global $TSunic;

		// try to read content
		if (!$this->isFile()
			OR !($content = file_get_contents($this->getPath()))
			OR $content === false
		) {
			if (!$this->silent_mode) $TSunic->Log->add('warning', 'Couldn\'t read from "'.$this->path.'"!', 1);		
			return ($as_string) ? '' : array();
		}

		// return content
		return ($as_string AND is_array($content)) ? implode(chr(10), $content) : $content;
	}

	/* ######################### write to file ############################## */

	/* write content in file
	 * @param string $content: content to write in file
	 *
	 * @return bool
	 */
	public function writeFile ($content) {
		global $TSunic;

		// make sure, path exists
		if (!$this->mkFolder($this->getPath(true))) die('make folder!!'); //return false;

		// open file
		$file = @fopen($this->getPath(), "w");
		if ($file) {

			// try to write file
			$return = @fwrite($file, $content);

			// close file
			@fclose($file);

			// success?
			if (is_numeric($return)) return true;
		}

		if (!$this->silent_mode) $TSunic->Log->add('error', 'Couldn\'t write to "'.$this->path.'"!', 1);		
		return false;
	}

	/* append $to_add to end of file
	 * @param sting $to_add: content to add to file
	 *
	 * @return bool
	 */
	public function writeAdd ($to_add) {

		// get content
		$content = $this->readFile();

		// append to the end
		$content.= "\n".$to_add;

		// write file
		if (!$this->writeFile($content)) return false;
		return true;
	}

	/* ######################### folder operations ########################## */

	/* create folder, if not exists
	 * @param string $path: path to folder
	 *
	 * @return bool
	 */
	public function mkFolder ($path) {
		global $TSunic;

		// is folder?
		if (is_dir($path)) return true;
		if (file_exists($path) AND !is_dir($path)) return false;

		// check all single folders
		$cache = explode('/', $path);
		$current = '';
		foreach ($cache as $index => $value) {
			$current.= (empty($current)) ? $value : '/'.$value;

			if (!is_dir($current) AND !mkdir($current)) {
				if (!$this->silent_mode) $TSunic->Log->add('warning', 'Couldn\'t create folder "'.$current.'"!', 1);
				return false;
			}
		}

		return true;
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
	 * @param string $path: path to basis-folder
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
