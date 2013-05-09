<!-- | CLASS TemplateEngine -->
<?php
/**
 * A class offering the core of TSunic's template engine. This class manages
 * language replacement, template combination and template data.
 */
class $$$TemplateEngine {

    /** Cache for language replacements
     * @var string $lang
     */
    private $lang = array();

    /** Session key name
     * @var string $session_key
     */
    private $session_key = '$$$templateEngine';

    /** Chosen style
     * @var string $style
     */
    private $style;

    /** Activated templates
     * @var array $activatedTemplates
     */
    public $activatedTemplates = array();

    /** Activated JavaScript
     * @var array $activatedJavascript
     */
    public $activatedJavascript = array();

    /** Extracted JavaScript
     * @var array $extractedJavascript
     */
    public $extractedJavascript = array();

    /** Cache
     * @var array $cache
     */
    protected $cache = array();

    /** Constructor
     * @param string $style
     *	Name of style
     */
    public function __construct ($style = 0) {
	global $TSunic;

	// get style
	$this->style = ($style) ? $style : $TSunic->Config->get('default_style');

	// init data
	if ($TSunic->isIndex() AND $this->getData('meta', 'printed') == true) {
	    // reset data and delete javascript-codes
	    $this->setData(false);
	    $this->getAllJavascript(true);
	} else {
	    // load data
	    $this->setData(true);
	}

	return;
    }

    /** Get data from this object
     * @param string $name
     *	Name of data to get
     *
     * @return mix
     */
    public function getInfo ($name) {

	switch ($name) {
	    case 'style':
		return $this->style;
	}

	return NULL;
    }

    /** Activate template for output
     * @param string $template
     *	Name of template
     * @param string|bool $supTemplate
     *	If supTemplate exists -> name ELSE 0 or false
     * @param bool|array $data
     *	Data for template
     * @param bool|string $position
     *	Position to include template within sup-template
     *
     * @return bool
     */
    public function activate ($template, $supTemplate = false, $data = false, $position = false) {
	global $TSunic;

	// add template to class-var
	if ($supTemplate === 0 OR $supTemplate === false) $supTemplate = 'html';
	if (empty($position)) $position = '#standard#';

	// check, if sup-array exist
	if (!isset($this->activatedTemplates[$supTemplate])) $this->activatedTemplates[$supTemplate] = array();

	// check, if position already exists
	if (!isset($this->activatedTemplates[$supTemplate][$position])) $this->activatedTemplates[$supTemplate][$position] = array();

	// check, if template already activated
	if ($template != 'html') {
	    $template_activated = false;
	    foreach ($this->activatedTemplates[$supTemplate][$position] as $index => $value) {
		if ($value == $template) $template_activated = true;
	    }
	} else {
	    $template_activated = true;
	}

	// add template and data
	if (!$template_activated) {
	    // activate template
	    $this->activatedTemplates[$supTemplate][$position][] = $template;
	}

	// add data
	$this->setData($template, $data);

	return true;
    }

    /** Save data for template
     * @param string|bool $template
     *	Template, data are for; false: reset all data; true: get all data
     * @param string|array $data
     *	String: name of value; array: data array
     * @param mix $value
     *	Value for data with name $name
     *
     * @return bool
     */
    public function setData ($template, $data = NULL, $value = NULL) {

	// load data from session?
	if ($template === true) {
	    return true;

	// reset data?
	} elseif ($template === false) {
	    $this->data = array();
	    return true;
	}

	// is data?
	if (empty($data)) return true;

	// create data-array
	$data = (is_array($data)) ? $data : array($data => $value);

	// merge with already existing data?
	if (isset($this->data[$template])) {
	    $this->data[$template] = array_merge($this->data[$template], $data);
	} else {
	    $this->data[$template] = $data;
	}

	return true;
    }

    /** Save data
     * @param string $template
     *	Template to fetch data for
     * @param string|bool $name
     *	Name of data (true - return all data of template)
     * @param bool $unset
     *	Unset data afterwards
     *
     * @return mix
     */
    public function getData ($template, $name = true, $unset = false) {

	// load data (once)
	if (empty($this->data)) $this->data = array();

	// data for template?
	if (!isset($this->data[$template])
	    OR !is_array($this->data[$template])) return ($name === true) ? array() : NULL;

	// delete data afterwards?
	if ($unset) {
	    $data = NULL;
	    if ($name === true) {
		$data = $this->data[$template];
		unset($this->data[$template]);
	    } elseif (isset($this->data[$template][$name])) {
		$data = $this->data[$template][$name];
		unset($this->data[$template][$name]);
	    }
	    return $data;
	}

	// return all?
	if ($name === true) return $this->data[$template];

	// data exists?
	if (isset($this->data[$template][$name])) return $this->data[$template][$name];

	return NULL;
    }

    /** Skip language placeholders
     * @param string $text
     *	Text to be parsed
     * @param bool $doEscape
     *	True - escape singe and double quotes
     * @param int $nested
     *	If this value is > 5, the function will not check recursively
     *
     * @return string
     */
    public function replaceLang ($text, $doEscape = false, $nested = 0) {
	global $TSunic;

	// set regex
	$regex = '#\{([A-Z_ÄÖÜ][A-Z_ÄÖÜ0-9]+)\}#Us';

	// save $doEcho in cache
	$this->cache['doEscape'] = $doEscape;

	// skip, if no matches
	if (!strstr($text, '{')) {
	    // no matches
	    return $text;
	}

	// extract language
	$text = preg_replace_callback(
	    $regex,
	    array($this, 'getLang'),
	    $text
	);

	// return text, if nested >= 5 (prevent infinite loop)
	$nested++;
	if ($nested >= 5) return $text;

	// check, if all replacements done
	if (!strstr($text, '{')) {
	    // no matches
	    return $text;
	}

	// replace (recursive)
	return $this->replaceLang($text, $doEscape, $nested);
    }

    /** Get language replacement
     * @param string $index
     *	Language placeholder
     *
     * @return string
     */
    public function getLang ($index) {
	global $TSunic;
	$index = substr($index[0], 1 ,(strlen($index[0])-2));

	// get doEscape from cache
	$doEscape = $this->cache['doEscape'];

	// check, if replacement already loaded
	if (!isset($this->lang, $this->lang[$index])) {
	    // load language-replacements from file
	    $this->loadLanguage($index);
	}

	// check, if replacement is available
	if (!isset($this->lang[$index])) {
	    // no replacement
	    return $index;
	} else {

	    // replace placeholder
	    $out =  $this->lang[$index];

	    // escape, if wanted
	    if ($doEscape) $out = str_replace("'", "\'", $out);
	    if ($doEscape) $out = str_replace('"', '\"', $out);
	    return $out;
	}

	return $text;
    }

    /** Load language replacements
     * @param string $input
     *	Language placeholder or module
     * @param bool|string $lang
     *	Set language to include
     * @param bool $returnOnFail
     *	Return, if include fails
     *
     * @return bool
     */
    public function loadLanguage ($input, $lang = false, $returnOnFail = false) {
	global $TSunic;

	// get languages
	$chosen_lang = $TSunic->Usr->config('$$$language');
	$default_lang = $TSunic->Config->get('default_language');

	// get module of input
	$cache = explode('__', $input);
	if (count($cache) < 2 OR empty($cache[0])) return false;
	$module = strtolower($cache[0]);

	// get paths in priority-order
	$paths = array(
	    'style'.$this->style.'__'.$module.'__'.$chosen_lang.'.lang.php',
	    'style'.$this->style.'__'.$module.'__'.$default_lang.'.lang.php',
	    $module.'__'.$chosen_lang.'.lang.php',
	    $module.'__'.$default_lang.'.lang.php'
	);

	// include lang-file
	foreach ($paths as $index => $value) {
	    $current = $TSunic->Config->get('dir_runtime').'/lang/'.$value;

	    // is file?
	    if (!file_exists($current)) continue;

	    // include file
	    include $current;

	    // is $lang?
	    if (!isset($lang) OR empty($lang)) continue;

	    // merge with existing ones
	    $this->lang = array_merge($this->lang, $lang);

	    return true;
	}

	// return on fail? (prevents loops)
	if ($returnOnFail) return false;

	// if no lang-file found yet, get first available language
	$File = $TSunic->get('$$$File', '#runtime#lang');
	$files = $File->getSubfiles();
	foreach ($files as $index => $value) {
	    $cache = explode('__', $value);
	    if (($cache[0] == $module) OR (count($cache) > 2 AND $cache[1] == $module)) {
		// matching lang-file
		$lang_new = explode('.', end($cache));
		$this->loadLanguage($input, $lang_new[0], true);
		break;
	    }
	}

	return false;
    }

    /** Display output
     * @param bool|string $template
     *	Name of root template
     *
     * @return bool
     */
    public function display ($template = false) {
	global $TSunic;

	// set data as printed
	$this->setData('meta', array('printed' => true));

	// activate Log
	$templatedata = array('Log' => $TSunic->Log);
	$TSunic->Tmpl->activate('$$$showLog', false, $templatedata);

	// load format-path
	$path = 'runtime/css/style'.$this->style.'__format.css';
	if (!file_exists($path)) $path = 'css/format.css';
	$this->activate('$$$html', false, array('path_format' => $path));

	// SUBCODE adding templates

	// get template
	if ($template === false) $template = '$$$html';

	// get template object of first template to display
	$firstTemplate = $TSunic->get('$$$Template', $template);

	// load templates
	$firstTemplate->display();

	return true;
    }

    /** Return ajax response (XML template)
     *
     * @return bool
     */
    public function responseAjax () {
	global $TSunic;

	// get TemplateXml-object
	$TemplateXml = $TSunic->get('$$$Template_Xml', $TSunic->Temp->getEvent());

	// load xml
	$TemplateXml->display();

	return true;
    }

    /** Add JavaScript class or function for output
     * @param string $name
     *	Name of class or function
     *
     * @return bool
     */
    public function addJSfunction ($name) {

	// save in array
	$this->activatedJavascript[$name] = $name;

	return true;
    }

    /** Add JavaScript code to cache
     * @param string $template
     *	Name of template the code belongs to
     * @param string $input
     *	JavaScript code
     *
     * @return bool
     */
    public function addJavascriptCode ($template, $input) {

	// validate input
	if (empty($template) OR empty($input)) return false;

	// save in SESSION
	if (!$this->extractedJavascript) $this->extractedJavascript = array();
	$this->extractedJavascript[$template] = base64_encode($input);

	return true;
    }

    /** Returns all JavaScript code from cache
     * @param bool $delete
     *	Return and flush?
     *
     * @return bool
     */
    public function getAllJavascript ($delete = false) {

	# get code
	if (!$this->extractedJavascript) $this->extractedJavascript = array();
	$code = $this->extractedJavascript;

	# delete?
	if ($delete) unset($this->extractedJavascript);

	return $code;
    }

    /** Get activated JavaScript
     *
     * @return array
     */
    public function getActivatedJavascript () {
	return $this->activatedJavascript;
    }

    /** Get activated templates
     *
     * @return array
     */
    public function getActivatedTemplates () {
	return $this->activatedTemplates;
    }

    /** Clear all activated templates and JavaScript classes and functions
     *
     * @return bool
     */
    public function clearActivatedTemplates () {

	// clear templates
	$this->activatedTemplates = array();

	// clear javascript
	$this->activatedJavascript = array();
	$this->extractedJavascript = array();

	return true;
    }
}
?>
