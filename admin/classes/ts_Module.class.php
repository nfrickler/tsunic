<!-- | Module class -->
<?php
class ts_Module extends ts_Packet {

    /* get/update path to module
     * @param string: name of packet
     * +@param bool: true - save path in obj-var; false - return path only
     *
     * @return string/bool
     */
    protected function _getPath ($name, $save = true) {
	global $Config;

	// is name given?
	if (!empty($this->id)) {
	    $path = $Config->get('dir_data').'/source/modules/_mod'.$this->id.'__'.$this->getInfo('name');
	} else {
	    if (empty($name)) return false;
	    $path = $Config->get('dir_data').'/source/modules/'.$name;
	}

	// save?
	if ($save) $this->path = $path;

	return $path;
    }

    /* find id of module and preparse it
     *
     * @return bool
     */
    protected function _findId () {
	global $Database, $Config, $Log;

	// get data from database to compare
	$sql_0 = "SELECT name as name,
		    nameid as nameid,
		    id__module as id__module
		FROM #__modules
		WHERE name = '".mysql_real_escape_string($this->getInfofile('name'))."'
		    AND nameid = '".mysql_real_escape_string($this->getInfofile('nameid'))."';";
	$result_0 = $Database->doSelect($sql_0);
	if ($result_0 === false OR count($result_0) > 1) return false;

	// new module?
	if (count($result_0) == 0) {
	    $Log->doLog(3, "Module: Found new module '".
		$this->getInfofile('name')."'");

	    // add module to database
	    $sql_0 = "INSERT INTO #__modules
		    SET name = '".mysql_real_escape_string($this->getInfofile('name'))."',
			nameid = '".mysql_real_escape_string($this->getInfofile('nameid'))."',
			version = '".mysql_real_escape_string($this->getInfofile('version'))."',
			author = '".mysql_real_escape_string($this->getInfofile('author'))."',
			link = '".mysql_real_escape_string($this->getInfofile('link'))."',
			description = '".mysql_real_escape_string($this->getInfofile('description'))."'
	    ;";
	    $result_0 = $Database->doInsert($sql_0);
	    if (!$result_0) return false;

	    // save id
	    $this->id = mysql_insert_id();

	    // preparse
	    $this->_preparse();

	    return true;
	}

	// save id
	$this->id = $result_0[0]['id__module'];

	// update found! -> replace old version
	if ($this->getInfofile('version') > $this->getInfo('version')) {
	    $Log->doLog(3, "Module: Update of module '".
		$this->getInfofile('name')."' found.");

	    // update database
	    $sql_1 = "UPDATE #__modules
		    SET version = '".mysql_real_escape_string($this->getInfofile('version'))."',
			author = '".mysql_real_escape_string($this->getInfofile('author'))."',
			link = '".mysql_real_escape_string($this->getInfofile('link'))."',
			description = '".mysql_real_escape_string($this->getInfofile('description'))."',
			nameid = '".mysql_real_escape_string($this->getInfofile('nameid'))."'
		    WHERE id__module = '".$this->id."'
	    ;";
	    $result_1 = $Database->doUpdate($sql_1);
	    if (!$result_1) return false;

	    // backup old version
	    ts_BackupHandler::backupModule(
		$Config->get('dir_data').'/source/modules/_mod'.$this->id,
		$this->getInfofile('name').'_'.$this->getInfofile('nameid').
		'__version__'.$this->getInfofile('version')
	    );

	    // preparse (and replace old version by that)
	    $this->_preparse();

	// version is same as saved in database
	} elseif ($this->getInfofile('version') == $this->getInfo('version')) {

	    // get correct path
	    $path_correct = $this->_getPath(false, false);

	    // check, if in correct folder
	    if ($this->path != $path_correct) {
		$Log->doLog(3, "Module: Move module '".
		    $this->getInfofile('name')."' to correct path.");
		$this->_preparse();
	    }

	// old version found! -> delete this one
	} else {
	    $Log->doLog(3, "Module: Remove old version of module '".
		$this->getInfofile('name')."'.");

	    // backup and delete folder
	    ts_BackupHandler::backupModule($this->path);
	    ts_FileHandler::deleteFolder($this->path);

	    // delete id
	    $this->id = 0;
	    return false;
	}

	return true;
    }

    /* ######################### handle module ########################## */

    /* get info about module
     * @param string: name of information to gather
     * +@param bool: reload all data?
     *
     * @return mix
     */
    public function getInfo ($name, $refresh = false) {
	global $Database;

	// refresh?
	if ($refresh) $this->info = array();

	// is already loaded?
	if (!empty($this->info)) {
	    if (isset($this->info[$name])) return $this->info[$name];
	    return $this->getInfofile($name, $refresh);
	}

	// load data from database
	$sql = "SELECT *
		FROM #__modules
		WHERE id__module = '".$this->id."';";
	$result = $Database->doSelect($sql);

	// save data
	if (!empty($result)) $this->info = $result[0];

	// try again to return data
	if (
	    isset($this->info, $this->info[$name]) AND
	    !empty($this->info[$name])
	) return $this->info[$name];

	// get info from infofile
	return $this->getInfofile($name, $refresh);
    }

    /* get status of module
     * +@param bool: get string as output (else: int)
     *
     * @return int/string
     */
    public function getStatus ($verbal = false) {

	// get status
	if (!$this->isValid()) {
	    // error
	    return ($verbal) ? 'MODULE__CLASS__STATUS_ERROR': 5;
	}
	if ($this->getInfo('dateOfUninstall') > 0 ) {
	    // uninstalled
	    return ($verbal) ? 'MODULE__CLASS__STATUS_UNINSTALLED': 4;
	}
	$version_installed = $this->getInfo('version_installed');
	if (!empty($version_installed) AND $this->getInfo('version') != $this->getInfo('version_installed')) {
	    // update available

	    if ($verbal) {
		return 'MODULE__CLASS__STATUS_UPDATEWAITING';
	    } else {
		return ($this->getInfo('is_parsed') > 0) ? 3 : 7;
	    }
	}
	if ($this->getInfo('is_parsed') > 0) {
	    // parsed
	    return ($verbal) ? 'MODULE__CLASS__STATUS_PARSED': 6;
	}
	if ($this->getInfo('dateOfInstall') > 0) {
	    // installed
	    return ($verbal) ? 'MODULE__CLASS__STATUS_INSTALLED': 2;
	}
	if ($this->getInfo('dateOfPreParsing') > 0) {
	    // available
	    return ($verbal) ? 'MODULE__CLASS__STATUS_AVAILABLE': 1;
	}

	// module is not preparsed yet
	return ($verbal) ? 'MODULE__CLASS__STATUS_PREPARSINGERROR': 0;
    }

    /* activate module for next parsing
     * +@param bool: true - activate; false: deactivate
     *
     * @return bool
     */
    public function activate ($is_activated = true) {
	global $Database;

	// update database
	$sql_is_activated = ($is_activated) ? 1 : 0;
	if ($this->getInfo('is_activated') == $sql_is_activated) return true;

	// set new status in database
	$sql_0 = "UPDATE #__modules
		    SET is_activated = ".$sql_is_activated."
		    WHERE id__module = '".mysql_real_escape_string($this->id)."';";
	if (!$Database->doUpdate($sql_0)) return false;

	// update info-data
	$this->getInfo('', true);
	return true;
    }

    /* ############################# preparse ########################### */

    /* preparse and move all files and subfolders within path
     *
     * @return bool
     */
    protected function _preparse () {
	global $Database;

	// preparse
	if (!parent::_preparse()) {
	    $_SESSION['admin_error'] =
		'ERROR__CLASSMODULE__PREPARSE (module: '.
		$this->getInfo('name').' error=PreParse)';
	    return false;
	}

	// update database
	$sql = "UPDATE #__modules
	    SET dateOfPreParsing = NOW()
	    WHERE id__module = '".$this->id."'
	;";
	if (!$Database->doUpdate($sql)) {
	    $_SESSION['admin_error'] =
		'ERROR__CLASSMODULE__PREPARSE (module: '.
		$this->getInfo('name').' error=Update database)';
	}

	return true;
    }

    /* ############################# parse ############################## */

    /* parse source-code for frontend
     *
     * @return bool
     */
    public function parse () {
	global $Database, $Parser, $Log;

	// is activated?
	if (!$this->getInfo('is_activated')) {

	    // update database
	    if ($this->getInfo('is_parsed')) {
		$sql_0 = "UPDATE #__modules
			SET is_parsed = 0
			WHERE id__module = '".mysql_real_escape_string($this->id)."';";
		if ($Database->doUpdate($sql_0) === false) return false;
	    }

	    return true;
	}

	// new installation?
	$sql_additional = "";
	if ($this->getStatus() == 1 OR $this->getStatus() == 4) {
	    $this->installModule();
	    $sql_additional = "dateOfInstall = NOW(),";
	} elseif ($this->getStatus() == 3 OR $this->getStatus() == 7) {
	    $this->updateModule();
	    $sql_additional = "dateOfUpdate = NOW(),";
	}

	// set current module
	$Parser->setModule($this->id);

	// parse all parts
	if ($this->parseImages()
	    AND $this->parseJavascript()
	    AND $this->parseXmlResponses()
	    AND $this->parseFunctions()
	    AND $this->parseClasses()
	    AND $this->parseTemplates()
	    AND $this->parseFormat()
	    AND $this->parseSubcodes()
	    AND $this->parseAccess()
	    AND $this->parseConfig()
	    AND $this->parseHelp()
	    AND $this->parseStatic()
	    AND $this->_parseLanguages()
	) {
	    // success
	    $Log->doLog(4, "Module: Parsed module '".$this->getInfo('name')."'");

	    // get id of usersystem
	    if ($this->getInfo('name') == "usersystem") {
		global $USERSYSTEM;
		$USERSYSTEM = $this->id;
	    }

	    // update database
	    $sql_0 = "UPDATE #__modules
		    SET ".$sql_additional."
			is_parsed = 1,
			version_installed = '".mysql_real_escape_string($this->getInfofile('version'))."'
		    WHERE id__module = '".mysql_real_escape_string($this->id)."';";
	    if ($Database->doUpdate($sql_0) === false) return false;

	    return true;
	}

	// error during parseing
	$Log->doLog(3, "Module: Failed to parse module '".$this->getInfo('name')."'");
	return false;
    }

    /* parse images and other files of this module
     *
     * @return bool
     */
    protected function parseImages () {
	global $Config;

	// get preffix
	$preffix = 'mod'.$this->id.'__';

	// copy all images
	if (ts_FileHandler::copyFolder(
	    $this->path.'/templates/images',
	    $Config->get('dir_runtime').'/files',
	    true,
	    $preffix)
	) return true;

	return false;
    }

    /* parse static
     *
     * @return bool
     */
    protected function parseStatic() {
	global $Parser, $Config;

	// copy all dirs and files
	if (!ts_FileHandler::copyFolder(
	    $this->path.'/static',
	    $Config->get('dir_runtime').'/static')
	) return false;

	// overwrite all files directly in /static and do module replacement

	// get paths
	$path_source = $this->path.'/static';
	$path_destination = $Config->get('dir_runtime').'/static';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read
	    $content = ts_FileHandler::readFile($path_source.'/'.$value);

	    // parse
	    $content = $Parser->replaceModule($content, $this->id);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$value,
		$content,
		1
	    )) return false;
	}

	return true;
    }

    /* parse javascript-files of this module
     *
     * @return bool
     */
    protected function parseJavascript () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/javascript';
	$path_destination = $Config->get('dir_runtime').'/javascript';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read
	    $content = ts_FileHandler::readFile($path_source.'/'.$value);

	    // parse
	    $content = $Parser->parse($content, true, true);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse xmlResponses-files of this module
     *
     * @return bool
     */
    protected function parseXmlResponses () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/templates/xmlResponses';
	$path_destination = $Config->get('dir_runtime').'/xmlResponses';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read and parse
	    $content = ts_FileHandler::readFile($path_source.'/'.$value);
	    $content = $Parser->parse($content);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse function-files of this module
     *
     * @return bool
     */
    protected function parseFunctions () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/functions';
	$path_destination = $Config->get('dir_runtime').'/functions';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read
	    $content = ts_FileHandler::readFile($path_source.'/'.$value, true);

	    // append marker to the end of each line
	    $content = $Parser->setLineMarkers($content, true);

	    // parse
	    $content = $Parser->parse($content, false);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse class-files of this module
     *
     * @return bool
     */
    protected function parseClasses () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/classes';
	$path_destination = $Config->get('dir_runtime').'/classes';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read
	    $content = ts_FileHandler::readFile($path_source.'/'.$value, true);

	    // append marker to the end of each line
	    $content = $Parser->setLineMarkers($content, true);

	    // parse
	    $content = $Parser->parse($content, false);

	    // check, if special "TSunic"-class
	    if ($value == 'TSunic.class.php' AND $this->getInfo('name') == 'system') {
		if (!$content OR !ts_FileHandler::writeFile(
		    $path_destination.'/'.$value,
		    $content,
		    true
		)) return false;
		continue;
	    }

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse template-files of this module
     *
     * @return bool
     */
    protected function parseTemplates () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/templates';
	$path_destination = $Config->get('dir_runtime').'/templates';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read
	    $content = ts_FileHandler::readFile($path_source.'/'.$value, true);

	    // append marker to the end of each line
	    $content = $Parser->setLineMarkers($content, true);

	    // parse
	    $content = $Parser->parse($content, false);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse help pages of this module
     *
     * @return bool
     */
    protected function parseHelp () {
	global $Parser, $Config;

	// get preffix and paths
	$preffix = 'mod'.$this->id.'__';
	$path_source = $this->path.'/templates/help';
	$path_destination = $Config->get('dir_runtime').'/help';

	// get all files
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // read and parse
	    $content = ts_FileHandler::readFile($path_source.'/'.$value);
	    $content = $Parser->parse($content);

	    // write
	    if (!$content OR !ts_FileHandler::writeFile(
		$path_destination.'/'.$preffix.$value,
		$content,
		true
	    )) return false;
	}

	return true;
    }

    /* parse language-files of this module
     *
     * @return bool
     */
    protected function _parseLanguages () {
	global $LanguageHandler;

	// get lang-files
	$path_source = $this->path.'/templates/lang';
	$files = ts_FileHandler::getSubfiles($path_source);

	// parse all files
	foreach ($files as $index => $value) {

	    // get language of lang-file
	    $cache = explode('.', $value);

	    // read lang-file
	    if (!$LanguageHandler->add(
		'module',
		$this->id,
		$cache[0],
		"$path_source/$value"
	    )) return false;
	}

	return true;
    }

    /* parse format.css-file of this module
     *
     * @return bool
     */
    protected function parseFormat () {
	global $FormatHandler, $Parser;

	// get path
	$path_source = $this->path.'/format.css';

	// get format of module
	$format = ts_FileHandler::readFile($path_source);
	if (empty($format)) return true;

	// replace modules
	$format = $Parser->replaceModule($format);
	$format = $Parser->trim($format, false, true);

	// add to format
	if ($FormatHandler->add($format)) return true;
	return false;
    }

    /* parse subcodes-file of this module
     *
     * @return bool
     */
    protected function parseSubcodes () {
	global $SubcodeHandler, $Parser, $Log;

	// get path
	$path_source = $this->path.'/subcodes.php';

	// get subcodes
	$subcodes = ts_FileHandler::readFile($path_source);
	if ($subcodes === false) {
	    $Log->doLog(3, "Module: Failed to read subcode file ".
		"('$path_source') of module '".$this->getInfo('module')."'");
	    return false;
	}
	if (empty($subcodes)) return true;

	// add subfunctions
	if ($SubcodeHandler->add($subcodes)) return true;
	return false;
    }

    /* parse access-file of this module
     *
     * @return bool
     */
    protected function parseAccess () {
	global $AccessParser, $Log;

	// parse file
	$path = $this->path.'/access.xml';
	$preffix = 'mod'.$this->id.'__';
	if (!$AccessParser->add($path, $preffix)) {
	    $Log->doLog(3, "Module: Failed to parse access-File of module".
		"'".$this->getInfo('module')."'");
	    return false;
	}

	return true;
    }

    /* parse config-file of this module
     *
     * @return bool
     */
    protected function parseConfig () {
	global $ConfigParser, $Log;

	// add file
	$path = $this->path.'/config.xml';
	$preffix = 'mod'.$this->id.'__';
	if (!$ConfigParser->add($path, $preffix)) {
	    $Log->doLog(3, "Module: Failed to parse config-File of module".
		"'".$this->getInfo('module')."'");
	    return false;
	}

	return true;
    }

    /* ###################### install/update/uninstall ################## */

    /* install module
     *
     * @return bool
     */
    public function installModule () {
	global $Database, $Parser;

	// search for install-scripts in 'setup'-dir
	if (file_exists($this->path.'/setup/install.sql')) {

	    // read sql-file
	    $content = ts_FileHandler::readFile($this->path.'/setup/install.sql');

	    // parse module replacements
	    $content = $Parser->replaceModule($content, $this->id, $Database->getPreffix());

	    // run sql statements
	    if (($Database->runString($content)) === false) return false;
	}
	if (file_exists($this->path.'/setup/install.php')) {
	    // run php-file
	    $break = false;
	    include $this->path.'/setup/install.php';
	    if ($break) return false;
	}

	// successful installation (set install-time in database)
	$sql = "UPDATE #__modules
		SET dateOfInstall = NOW(),
		    dateOfUninstall = NULL
		WHERE id__module = '".$this->id."';";
	if (!$Database->doUpdate($sql)) return false;

	return true;
    }

    /* update module
     *
     * @return bool
     */
    public function updateModule () {
	global $Database, $Parser;

	// get versions
	$sql_0 = "SELECT version_installed,
		     version
		FROM #__modules
		WHERE id__module = '".mysql_real_escape_string($this->id)."';";
	$result_0 = $Database->doSelect($sql_0);
	if (empty($result_0)) return false;
	$result_0 = $result_0[0];

	// skip update, if version is older
	if ($result_0['version'] <= $result_0['installed_version']) return false;

	// get all available updaters
	$files = ts_FileHandler::getSubfiles($this->path.'/setup');
	$files_update = array();
	foreach ($files as $index => $value) {
	    $cache = explode('.', $value);
	    $filename = substr($value, 0, (strlen($value) - strlen(end($cache)) - 1));
	    $cache = explode('_to_', substr($filename, strlen('update_')));
	    if (substr($value, 0, strlen('update_')) != 'update_' OR
		count($cache) != 2) continue;

	    // save
	    $files_update[$cache[0]] = $cache[1];
	}

	// try to find best way to update to new version
	$best_way = $this->_findWay(
	    $files_update,
	    $result_0['version_installed'],
	    $result_0['version']
	);
	if (empty($best_way)) return false;

	// follow best way and update
	$version_installed = $result_0['version_installed'];
	foreach ($best_way as $index => $value) {

	    // search for update-files and run them
	    if (file_exists($this->path.'/setup/update_'.$index.'_to_'.$value.'.sql')) {
		// run sql-file

		// read sql-file
		$content = ts_FileHandler::readFile($this->path.'/setup/uninstall.sql');

		// parse module replacements
		$content = $Parser->replaceModule($content, $this->id, $Database->getPreffix());

		// run sql statements
		if (($Database->runString($content)) === false) break;
	    }
	    if (file_exists($this->path.'/setup/update_'.$index.'_to_'.$value.'.php')) {
		// run php-file
		$break = false;
		include $this->path.'/setup/update_'.$index.'_to_'.$value.'.php';
		if ($break) break;
	    }

	    $version_installed = $value;
	}

	// successful update (set update-time and version_installed in database)
	$sql_0 = "UPDATE #__modules
		SET dateOfUpdate = NOW(),
		    version_installed = '".mysql_real_escape_string($version_installed)."'
		WHERE id__module = '".mysql_real_escape_string($this->id)."';";
	if (!$Database->doUpdate($sql_0)) return false;

	if ($version_installed != $result_0['version']) return false;
	return true;
    }

    /* find best (shortest) way from $from to $to
     * @param array: all paths
     * @param string: starting point
     * @param string: goal
     *
     * @return array/bool
     */
    protected function _findWay ($all, $from, $to) {
	$best_way = false;

	// skip, if $from == $to
	if ($from == $to) return true;

	// find starting points
	foreach ($all as $index => $value) {
	    if ($index == $from) {
		// start found

		// compare value and to
		if ($value > $to) continue;

		// new possible way found
		$new_way = array();
		$new_way[$index] = $value;

		// skip further search, if it reaches it goal
		if ($value != $goal) {

		    // try to find way from this next point to the goal
		    $new_way2 = $this->_findWay($all, $value, $to);
		    if (!$new_way2) continue;
		    if (is_array($new_way2)) $new_way = array_merge($new_way, $new_way2);
		}

		// is better way?
		if (empty($best_way) OR count($new_way) < count($best_way)) $best_way = $new_way;
	    }
	}

	return $best_way;
    }

    /* uninstall module
     *
     * @return bool
     */
    public function uninstallModule () {
	global $Database, $Parser;

	// search for uninstall-scripts in 'setup'-dir
	if (file_exists($this->path.'/setup/uninstall.sql')) {

	    // read sql-file
	    $content = ts_FileHandler::readFile($this->path.'/setup/uninstall.sql');

	    // parse module replacements
	    $content = $Parser->replaceModule($content, $this->id, $Database->getPreffix());

	    // run sql statements
	    if (($Database->runString($content)) === false) return false;
	}
	if (file_exists($this->path.'/setup/uninstall.php')) {
	    // run php-file
	    include $this->path.'/setup/uninstall.php';
	}

	// successful deinstallation (set uninstall-time in database)
	$sql_0 = "UPDATE #__modules
		SET dateOfUninstall = NOW()
		WHERE id__module = '".$this->id."';";
	if (!$Database->doUpdate($sql_0)) return false;

	return true;
    }

    /* delete module
     *
     * @return bool
     */
    public function deleteModule () {
	global $Database;

	// is source available?
	if (is_dir($this->path)) {
	    // backup
	    if (!ts_BackupHandler::backupModule($this->path)) return false;
	}
	if (!ts_FileHandler::deleteFolder($this->path)) return false;

	// delete entry in database
	$sql_0 = "DELETE FROM #__modules
		WHERE id__module = '".$this->id."';";
	if (!$Database->doDelete($sql_0)) return false;

	return true;
    }
}
?>
