<!-- | Class to handle subcodes -->
<?php
class ts_SubcodeHandler {

    /* array containing all subfunctions
     * array
     */
    private $subcodes;

    /* cache-array
     * array
     */
    private $cache;

    /* constructor
     */
    public function __construct () {

	// init
	$this->subcodes = array();

	return;
    }

    /* add subcodes
     * @param string: subcodes to add (xml-content of subcode-file)
     *
     * @return bool
     */
    public function add ($input) {
	global $Parser;
	$this->cache = array();

	// parse infos
	$input = preg_replace_callback('#\[(sub.*)\]#Usi', array($this, '_addCb'), $input);

	// split
	$cache = explode('[sub]', $input);
	for ($i = 1; $i <= count($cache); $i++) {

	    // validate
	    if (!isset($this->cache[($i-1)])) continue;
	    if (empty($cache[$i])) continue;

	    // replace module
	    $cache[$i] = $Parser->replaceModule($cache[$i]);

	    // make replacements in language replacements upper case
	    $regex = '#\{mod([0-9]+[A-Z_ÄÖÜ0-9]+)\}#Us';
	    $cache[$i] = preg_replace($regex, "{MOD$1}", $cache[$i]);

	    // save content
	    if (!isset($this->subcodes[$this->cache[($i-1)]['path']]))
		$this->subcodes[$this->cache[($i-1)]['path']] = array();
	    if (!isset($this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']]))
		$this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']] = array();
	    $this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']][] = $cache[$i];
	}

	return true;
    }

    /* add subcodes (callback)
     * @param array: input from callback-function
     *
     * @return bool
     */
    private function _addCb ($input) {
	global $Parser, $Config;
	$cache = array();
	$input = substr($input[0], 1, (strlen($input[0])-2));

	// split
	$cache = explode(':', $input);
	if ($cache < 3) return false;

	// get full path
	$cache[1] = $Parser->replaceModule($cache[1]);

	// save in cache
	$this->cache[] = array(
	    'path' => $Config->getRoot().'/runtime/'.$cache[1],
	    'line' => $cache[2]
	);

	return '[sub]';
    }

    /* inject all subcodes and complete file-rendering
     * +@param string/bool: path to folder in which all files will be
     * parsed recursively; false will parse all needed folders
     *
     * @return bool
     */
    public function parseAll ($path = false) {
	global $Config, $Parser, $Log;

	// run all?
	if ($path == false) {
	    if ($this->parseAll($Config->getRoot().'/runtime/functions')
		AND $this->parseAll($Config->getRoot().'/runtime/classes')
		AND $this->parseAll($Config->getRoot().'/runtime/templates')
	    ) {
		return true;
	    }
	    return false;
	}

	// validate path
	if (!is_dir($path)) {
	    $Log->doLog(3, "SubcodeHandler: Failed to parse path '$path'");
	    return false;
	}

	// parse all files
	$subfiles = ts_FileHandler::getSubfiles($path);
	foreach ($subfiles as $index => $value) {

	    // get filepath
	    $filepath = $path.'/'.$value;

	    // read file
	    $content = ts_FileHandler::readFile($filepath);
	    if ($content === false) {
		$Log->doLog(3, "SubcodeHandler: Failed to read file '$filepath'");
		return false;
	    }

	    // check, if anything to replace in this file
	    if (isset($this->subcodes[$filepath])) {

		// parse all lines to be add
		foreach ($this->subcodes[$filepath] as $in => $val) {
		    $to_add = '';

		    // sum everything to add to this line
		    foreach ($val as $i => $v) {
			$to_add.= $v;
		    }

		    // replace line by subfunctions
		    $content = str_replace('{line_'.$in.'}', $to_add, $content);
		}
	    }

	    // strip all {line_xx}
	    $content = preg_replace('#\{line_[0-9]*\}#Usi', '', $content);

	    // trim again
	    $content = $Parser->trim($content, true);

	    // write file
	    if (!ts_FileHandler::writeFile($filepath, $content, true)) {
		$Log->doLog(3, "SubcodeHandler: Failed to write file '$filepath'");
		return false;
	    }
	}

	// parse all subfolders
	$subfolders = ts_FileHandler::getSubfolders($path);
	foreach ($subfolders as $index => $value) {
	    if (!$this->parseAll($path.'/'.$value)) return false;
	}

	return true;
    }
}
?>
