<!-- | CLASS ts_Packet -->
<?php
/**
 * Abstract packet module
 */
class ts_Packet {

    /** id of packet
     * @var int $id
     */
    protected $id;

    /** Path to packet
     * @var string $path
     */
    protected $path;

    /** Is valid packet-object?
     * @var bool $is_valid
     */
    protected $is_valid = false;

    /** Array holding information about this packet
     * @var array $info
     */
    protected $info = array();

    /** Array holding information about this packet from version.xml
     * @var array $infofile
     */
    protected $infofile = array();

    /** Constructor
     * @var int $id
     *	Id of packet
     * @var string $name
     *	Name of packet
     */
    public function __construct ($id = false, $name = false) {

	// is id?
	$this->id = (!empty($id) AND is_numeric($id)) ? $id : false;

	// validate path
	if (!$this->_getPath($name, true)) return;

	// is id given?
	if (empty($id) OR !is_numeric($id)) {
	    // try to get id from name
	    if (!$this->_findId()) return;
	}

	// everything fine -> valid module
	$this->is_valid = true;
	return;
    }

    /** Get/update path to packet
     * @var string $name
     *	Name of packet
     * @var bool $save
     *	Save path in obj-var (or return path)?
     *
     * @return string|bool
     */
    abstract protected function _getPath ($name, $save);

    /** Convert name to id (add Style to database if not exists)
     *
     * @return bool
     */
    abstract protected function _findId ();

    /* ######################### handle packet ########################## */

    /** Get info about packet
     * @var string $name
     *	Name of information to gather
     * @var bool $refresh
     *	Refresh cached infos?
     *
     * @return mix
     */
    abstract public function getInfo ($name, $refresh);

    /** Get info from version.xml
     * @var string $name
     *	Name of information to gather
     * @var bool $refresh
     *	Refresh cached infos?
     *
     * @return mix
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
	$xmldata = ts_XmlHandler::readAll($this->path.'/version.xml');

	// read data in infofile
	foreach ($xmldata as $index => $values) {
	    $this->infofile[$values['tag']] = $values['value'];
	}

	// try again to return requested info
	if (isset($this->infofile, $this->infofile[$name]))
	    return $this->infofile[$name];
	return NULL;
    }

    /** Is valid packet object?
     *
     * @return bool
     */
    public function isValid () {
	if (is_dir($this->path) AND $this->is_valid) return true;
	return false;
    }

    /* ############################# pre-parse ########################## */

    /** Preparse and move all files and subfolders within path
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
	$PreParser = new ts_PreParser($this);

	// parse
	if ($PreParser->parse($this->path, $path_new, $Config->get('dir_data'))) {
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
