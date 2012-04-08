<!-- | Packet module -->
<?php
class ts_Packet {

	/* id
	 * int
	 */
	protected $id;

	/* path to packet
	 * string
	 */
	protected $path;

	/* is valid packet-object?
	 * bool
	 */
	protected $is_valid = false;

	/* array holding information about this packet
	 * array
	 */
	protected $info = array();

	/* array holding information about this packet from version.xml
	 * array
	 */
	protected $infofile = array();

	/* constructor
	 * +@param int: id of packet
	 * +@param string: name of packet
	 */
	public function __construct ($id = false, $name = false) {
		global $Config;

		// make sure that classes are loaded
		include_once 'classes/ts_BackupHandler.class.php';

		// is id?
		$this->id = (!empty($id) AND is_numeric($id)) ? $id : false;

		// validate path
		if (!$this->_getPath($name, true)) return;

		// is id given?
		if (empty($id) OR !is_numeric($id)) {
			// try to get id from name
			if (!$this->_findId($name)) return;
		}

		// everything fine -> valid module
		$this->is_valid = true;
		return;
	}

	/* get/update path to packet
	 * @param string: name of packet
	 * +@param bool: true - save path in obj-var; false - return path only
	 *
	 * @return string/bool
	 */
	protected function _getPath ($name, $save = true) {
		return false;
	}

	/* convert name to id
	 * @param string: name of packet
	 *
	 * @return bool
	 */
	protected function _findId ($name) {
		return false;
	}

	/* ######################### handle packet ########################## */

	/* get info about packet
	 * @param string: name of information to gather
	 * +@param bool: true - delete all current infos 
	 *
	 * @return mix
	 */
	public function getInfo ($name, $refresh = false) {
		return NULL;
	}

	/* get info from version.xml
	 * @param string: name of information to gather
	 * +@param bool: true - delete all current infos 
	 *
	 * @return OBJECT
	 */
	public function getInfofile ($name, $refresh = false) {

		// refresh?
		if ($refresh) $this->infofile = array();

		// check, if requested info is already in $this->info
		if (
			isset($this->infofile, $this->infofile[$name]) AND
			!empty($this->infofile[$name])
		) return $this->infofile[$name];

		// load from version-file
		if (!$this->path OR !file_exists($this->path.'/version.xml')) return NULL;
		include_once 'classes/ts_XmlHandler.class.php';
		$this->infofile = ts_XmlHandler::readAll($this->path.'/version.xml');

		// try again to return requested info
		if (isset($this->infofile, $this->infofile[$name]))
			return $this->infofile[$name];
		return NULL;
	}

	/* is valid packet-object?
	 *
	 * @return bool
	 */
	public function isValid () {
		if (is_dir($this->path) AND $this->is_valid) return true;
		return false;
	}

	/* ############################# pre-parse ########################## */

	/* preparse and move all files and subfolders within path
	 *
	 * @return bool
	 */
	protected function _preparse () {
		global $Config;

		// get new path
		$path_new = $this->_getPath(false, false);

		// free path
		if ($this->path == $path_new) {
			// move
			$path_old = $this->path.'__moved_by_preparser_'.rand(1,1000);
			ts_FileHandler::copyFolder($this->path, $path_old);
			$this->path = $path_old;
		} elseif (is_dir($path_new)) {
			ts_BackupHandler::backupModule($path_new, 'invalid_name');
		}
		ts_FileHandler::deleteFolder($path_new);

		// load PreParser-object
		include_once 'classes/ts_PreParser.class.php';
		$PreParser = new ts_PreParser($this);

		// parse
		if ($PreParser->parse($this->path, $path_new)) {
			// success

			// delete old source
			ts_FileHandler::deleteFolder($this->path);
			$this->path = $path_new;

			return true;
		}

		// failure
		ts_FileHandler::deleteFolder($path_new);
		return false;
	}
}
?>
