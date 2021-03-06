<!-- | CLASS ts_Style -->
<?php
/**
 * Class handling Style
 */
class ts_Style extends ts_Packet {

    /** Get/update path to style
     * @param string $name
     *	Name of packet
     * @param bool $save
     *	Save path in obj-var (or return path)?
     *
     * @return string|bool
     */
    protected function _getPath ($name, $save = true) {
	global $Config;

	// is name given?
	if (!empty($this->id)) {
	    $path = $Config->get('dir_data').'/source/styles/_style'.
		$this->id.'__'.$this->getInfo('name');
	} else {
	    if (empty($name)) return false;
	    $path = $Config->get('dir_data').'/source/styles/'.$name;
	}

	// save?
	if ($save) $this->path = $path;

	return $path;
    }

    /** Convert name to id (add Style to database if not exists)
     *
     * @return bool
     */
    protected function _findId () {
	global $Database, $Config;

	// empty name?
	if (!$this->getInfofile('name')) return false;

	// get data from database to compare
	$sql = "SELECT name as name,
		nameid as nameid,
		id__style as id__style
	    FROM #__styles
	    WHERE name = '".mysql_real_escape_string($this->getInfofile('name'))."'
		AND nameid = '".mysql_real_escape_string($this->getInfofile('nameid'))."';";
	$result = $Database->doSelect($sql);
	if ($result === false OR count($result) > 1) return false;

	// is new style?
	if (count($result) == 0) {
	    // add style

	    // add style to database
	    $sql = "INSERT INTO #__styles
		SET name = '".mysql_real_escape_string($this->getInfofile('name'))."',
		    nameid = '".mysql_real_escape_string($this->getInfofile('nameid'))."',
		    dateOfPreParsing = NOW(),
		    version = '".mysql_real_escape_string($this->getInfofile('version'))."',
		    author = '".mysql_real_escape_string($this->getInfofile('author'))."',
		    description = '".mysql_real_escape_string($this->getInfofile('description'))."';";
	    $result = $Database->doInsert($sql);
	    if (!$result) return false;

	    // save id
	    $this->id = mysql_insert_id();

	    // preparse
	    $this->_preparse();

	    return true;
	}

	// set id
	$this->id = $result[0]['id__style'];

	// check version
	if ($this->getInfofile('version') > $this->getInfo('version')) {
	    // update found! -> replace old version

	    // update database
	    $sql = "UPDATE #__styles
		SET version = '".mysql_real_escape_string($this->getInfofile('version'))."',
		    author = '".mysql_real_escape_string($this->getInfofile('author'))."',
		    description = '".mysql_real_escape_string($this->getInfofile('description'))."'
		WHERE id__style = '".$this->id__style."';";
	    $result = $Database->doUpdate($sql);

	    // backup old version
	    ts_BackupHandler::backupStyle($Config->get('dir_data').'/source/styles/_style'.$this->id, $this->getInfofile('name').'_'.$this->getInfofile('nameid').'__version__'.$this->getInfofile('version'));

	    // preparse (and replace old version by that)
	    $this->_preparse();

	} elseif ($this->getInfofile('version') == $this->getInfo('version')) {
	    // version is same as saved in database

	    // get correct path
	    $path_correct = $this->_getPath(false, false);

	    // check, if in correct folder
	    if ($this->path != $path_correct) {
		$this->_preparse();
	    }

	} else {
	    // old version found! -> delete this one
	    ts_BackupHandler::backupStyle($this->path);

	    // delete folder
	    ts_FileHandler::deleteFolder($this->path);

	    // delete id
	    $this->id = false;
	    return false;
	}

	return true;
    }

    /* ######################### handle style ########################### */

    /** Get info about module
     * @param string $name
     *	Name of information to gather
     * @param bool $refresh
     *	Refresh cached infos?
     *
     * @return mix
     */
    public function getInfo ($name, $refresh = false) {
	global $Database;

	// refresh?
	if ($refresh) $this->info = array();

	// is already loaded?
	if (!empty($this->info)) {
	    if (isset($this->info[$name]) AND !empty($this->info[$name])) return $this->info[$name];
	    return $this->getInfofile($name, $refresh);
	}

	// load data from database
	$sql = "SELECT *
	    FROM #__styles
	    WHERE id__style = '".$this->id."';";
	$result = $Database->doSelect($sql);

	// save data
	if (!empty($result)) $this->info = $result[0];
	$this->info['id'] = $this->id;

	// try again to return data
	if (isset($this->info, $this->info[$name]) AND !empty($this->info[$name])) return $this->info[$name];

	// get info from infofile
	return $this->getInfofile($name, $refresh);
    }

    /** Get status of style
     * @param bool $verbal
     *	Get string as output (else: int)
     *
     * @return int|string
     */
    public function getStatus ($verbal = false) {

	// get status
	if (!$this->isValid()) {
	    // error
	    return ($verbal) ? 'STYLE__CLASS__STATUS_ERROR': 5;
	}
	if ($this->getInfo('is_default') > 0) {
	    // parsed
	    return ($verbal) ? 'STYLE__CLASS__STATUS_DEFAULT': 8;
	}
	if ($this->getInfo('is_parsed') > 0) {
	    // parsed
	    return ($verbal) ? 'STYLE__CLASS__STATUS_PARSED': 6;
	}
	if ($this->getInfo('is_activated') > 0) {
	    // parsed
	    return ($verbal) ? 'STYLE__CLASS__STATUS_PARSED': 9;
	}
	if ($this->getInfo('dateOfPreParsing') > 0) {
	    // available
	    return ($verbal) ? 'STYLE__CLASS__STATUS_AVAILABLE': 1;
	}

	// module is not preparsed yet
	return ($verbal) ? 'STYLE__CLASS__STATUS_PREPARSINGERROR': 0;
    }

    /** Activate style for next parsing
     * @param bool $is_activated
     *	Activate (or deactivate)?
     *
     * @return bool
     */
    public function activate ($is_activated = true) {
	global $Database;

	// update database
	$sql_is_activated = ($is_activated) ? 1 : 0;
	if ($this->getInfo('is_activated') == $sql_is_activated) return true;
	$sql_is_default = '';
	if (!$is_activated AND $this->getStatus() == 8) {
	    $sql_is_default = ",is_default = 0";
	}

	// set new status in database
	$sql = "UPDATE #__styles
	    SET is_activated = ".$sql_is_activated."
		".$sql_is_default."
	    WHERE id__style = ".mysql_real_escape_string($this->id).";";
	if (!$Database->doUpdate($sql)) return false;

	// update info-data
	$this->getInfo('', true);
	return true;
    }

    /* ############################# pre-parse ########################## */

    /** Preparse and move all files and subfolders within path
     *
     * @return bool
     */
    protected function _preparse () {

	// preparse
	if (!parent::_preparse()) {
	    $_SESSION['admin_error'] = 'ERROR__CLASSSTYLE__PREPARSE (style: '.$this->getInfo('name').')';
	    return false;
	}

	return true;
    }

    /* ############################# parse ############################## */

    /* parse source-code for frontend
     *
     * @return bool
     */
    public function parse () {
	global $Database;

	// is activated?
	if (!$this->getInfo('is_activated')) {

	    // update database
	    if ($this->getInfo('is_parsed')) {
		$sql = "UPDATE #__styles
		    SET is_parsed = 0
		    WHERE id__style = '".mysql_real_escape_string($this->id)."';";
		if ($Database->doUpdate($sql) === false) return false;
	    }

	    return true;
	}

	// parse all parts
	if ($this->parseImages()
		AND $this->parseTemplates()
		AND $this->parseFormat()
		AND $this->_parseLanguages()
		) {
	    // success

	    // update database
	    $sql = "UPDATE #__styles
		SET is_parsed = 1
		WHERE id__style = '".mysql_real_escape_string($this->id)."';";
	    if ($Database->doUpdate($sql) === false) return false;

	    return true;
	}

	// error during parseing
	return false;
    }

    /** Parse images and other files of this style
     *
     * @return bool
     */
    protected function parseImages () {
	global $Config, $Parser;

	// source-path
	$path_source = $this->path.'/modules';

	// loop modules
	$modules = ts_FileHandler::getSubfolders($path_source);
	foreach ($modules as $index => $value) {

	    // get id__module
	    $id__module = $Parser->replaceModule('$'.$value.'$');
	    if (!$id__module) continue;

	    // get path_new
	    $path_new = $Config->get('dir_runtime').'/files';
	    $prefix = 'style'.$this->id.'__mod'.$id__module.'__';

	    // move all files in folder
	    if (!ts_FileHandler::copyFolder($path_source.'/'.$value.'/images', $path_new, true, $prefix)) {
		return false;
	    }
	}

	return true;
    }

    /** Parse template files of this module
     *
     * @return bool
     */
    protected function parseTemplates () {
	global $Config, $Parser;

	// source-path
	$path_source = $this->path.'/modules';

	// loop modules
	$modules = ts_FileHandler::getSubfolders($path_source);
	foreach ($modules as $index => $value) {

	    // get id__module
	    $id__module = $Parser->replaceModule('$'.$value.'$');
	    if (!$id__module) continue;
	    $id__module = substr($id__module, 3, (strlen($id__module) - 5));

	    // set id__module
	    $Parser->setModule($id__module);

	    // get path_new
	    $path_new = $Config->get('dir_runtime').'/templates';
	    $prefix = 'style'.$this->id.'__mod'.$id__module.'__';

	    // get current path
	    $path_current = $path_source.'/'.$value;

	    // get all files
	    $files = ts_FileHandler::getSubfiles($path_current);

	    // parse all files
	    foreach ($files as $in => $val) {

		// read
		$content = ts_FileHandler::readFile($path_current.'/'.$val);

		// parse
		$content = $Parser->parse($content, true);

		// write
		if (!$content OR !ts_FileHandler::writeFile($path_new.'/'.$prefix.$val, $content, true)) return false;
	    }
	}

	return true;
    }

    /** Parse template files of this module
     *
     * @return bool
     */
    protected function _parseLanguages () {
	global $LanguageHandler;

	// get lang-files
	$path_source = $this->path.'/lang';
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // get language of lang-file
	    $cache = explode('.', $value);

	    // read lang-file
	    if (!$LanguageHandler->add('style', $this->id, $cache[0], $path_source.'/'.$value)) return false;
	}

	return true;
    }

    /** Parse format.css file of this module
     *
     * @return bool
     */
    protected function parseFormat () {
	global $FormatHandler, $Parser;

	// get path
	$path_source = $this->path.'/format.css';

	// get format of module
	$format = ts_FileHandler::readFile($path_source);

	// replace modules
	$format = $Parser->replaceModule($format);
	$format = $Parser->trim($format, false, true);

	// add to format
	if ($FormatHandler->add($format, $this->id)) return true;
	return false;
    }

    /* ###################### delete #################################### */

    /** Delete style
     *
     * @return bool
     */
    public function deleteStyle () {
	global $Database;

	// is source available?
	if (is_dir($this->path)) {
	    // backup
	    if (!ts_BackupHandler::backupStyle($this->path)) return false;
	}
	if (!ts_FileHandler::deleteFolder($this->path)) return false;

	// delete entry in database
	$sql = "DELETE FROM #__styles
	    WHERE id__style = '".$this->id."';";
	if (!$Database->doDelete($sql)) return false;

	return true;
    }

    /** Set style as default style
     *
     * @return bool
     */
    public function setAsDefault () {
	global $Database, $Config;

	// is activated?
	if ($this->getStatus() == 8) return true;
	if (!($this->getStatus() === 6) AND !($this->getStatus() === 9)) {
	    return false;
	}

	// remove all other defaults
	$sql = "UPDATE #__styles
	    SET is_default = 0
	    WHERE NOT id__style = ".mysql_real_escape_string($this->id).";";
	$result = $Database->doUpdate($sql);

	// set as default
	$sql = "UPDATE #__styles
	    SET is_default = 1
	    WHERE id__style = ".mysql_real_escape_string($this->id).";";
	$result = $Database->doUpdate($sql);

	// update config
	$Config->set('default_style', $this->id);

	return true;
    }
}
?>
