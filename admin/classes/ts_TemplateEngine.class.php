<!-- | Template engine class -->
<?php
class ts_TemplateEngine {

    /* path to template-file
     * string
     */
    private $lang = array();

    /* activated templates
     * array
     */
    public $activatedTemplates = array();

    /* default object for special operations
     * object
     */
    private $dTemplate;

    /* constructor
     * +@param string $design: name of design
     */
    public function __construct ($design = 0) {
	global $Config;

	// get default template-object
	$this->dTemplate = new ts_Template();

	// get language
	if (!isset($_SESSION['lang'])) {
	    $_SESSION['lang'] = $Config->get('default_language');
	    if (empty($_SESSION['lang'])) $_SESSION['lang']  = 'en';
	}

	return;
    }

    /* activate template for output
     * @param string: name of template
     * @param string/bool: if supTemplate exists -> name ELSE 0 or false
     * @param bool/array: data for template
     *
     * @return bool
     */
    public function activate ($template, $data = false) {

	// set template
	$this->activatedTemplates['html'] = array($template);

	// add data
	$this->setData($template, $data);

	// check, if template really exist
	$path = 'templates/'.$template.'.tpl.php';
	if (!file_exists($path)) {
	    return false;
	}

	return true;
    }

    /* save data
     * @param string/bool: template, data are for (false: reset all data; true: get all data from session)
     * +@param string: data to save
     *
     * @return string
     */
    public function setData ($template, $data = false) {

	// handle true and false
	if ($template === false) {

	    // reset data
	    $this->data = array();

	    return true;
	} else {

	    // return, if empty template
	    if (empty($template)) return false;

	    // in array
	    if (!is_array($data)) $data = array($data);

	    // check, if data for this template already exist
	    if (isset($this->data[$template])) {
		// merge data
		$this->data[$template] = array_merge($this->data[$template], $data);
	    } else {
		// add data
		$this->data[$template] = $data;
	    }
	}

	return true;
    }

    /* save data
     * @param string: template to fetch data for
     * +@param string: name of data
     *
     * @return string
     */
    public function getData ($template, $name = false) {

	// check, if data for template exists
	if (!isset($this->data[$template])) return false;

	// check, if to return all
	if ($name === true) return $this->data[$template];

	// check, if data with name $name exists and return them
	if (is_array($this->data[$template])
		AND isset($this->data[$template][$name])) return $this->data[$template][$name];

	return false;
    }

    /* parse output-text
     * @param string: text to be parsed
     * +@param bool: true - escape singe and double quotes
     *
     * @return string
     */
    public function parse ($text, $doEscape = false) {

	// replace language
	$text = $this->replaceLang($text, $doEscape);

	return $text;
    }

    /* skip language-placeholders
     * @param string: text to be parsed
     * +@param bool: true - escape singe and double quotes
     * +@param int: if this value is > 5, the function will not check recursively
     *
     * @return string
     */
    public function replaceLang ($text, $doEscape = false, $nested = 0) {
	global $TSunic;

	// set regex
	$regex = '#\b([A-Z_ÄÖÜ][A-Z_ÄÖÜ0-9]+)\b#Us';

	// skip, if no matches
	$matches_pre_count = preg_match_all($regex, $text, $matches_pre, PREG_SET_ORDER);
	if (empty($matches_pre_count)) {
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
	$matches_post_count = preg_match_all($regex, $text, $matches_post, PREG_SET_ORDER);
	if (empty($matches_post_count)) {
	    // no matches
	    return $text;
	}

	// replace (recursive)
	return $this->replaceLang($text, $doEscape, $nested);
    }

    /* get language-replacements
     * @param string: language-placeholder
     *
     * @return string
     */
    public function getLang ($index) {
	$index = $index[0];

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

	    return $out;
	}

	return $text;
    }

    /* get language-replacements
     * @param string: language-placeholder or module
     * +@param bool/string: set language to include
     * +@param bool: return, if include fails
     *
     * @return bool
     */
    public function loadLanguage ($input, $lang = false, $returnOnFail = false) {
	global $Config;

	// get languages
	$chosen_lang = $_SESSION['lang'];
	$default_lang = $Config->get('default_language');

	// try to include lang-file
	$path = 'templates/lang/'.$chosen_lang.'.lang.php';
	if (file_exists($path)) {
	    include $path;
	} else {
	    $path = 'templates/lang/'.$default_lang.'.lang.php';
	    if (file_exists($path)) {
		include $path;
	    } else {
		// lang-file not available
		return false;
	    }
	}

	// add language-vars
	if (isset($lang) AND is_array($lang))
	    $this->lang = array_merge($this->lang, $lang);
	$lang = false;

	return false;
    }

    /* display output
     * @param bool/string: name of first template
     *
     * @return bool
     */
    public function display ($template = false) {

	// get template
	if ($template === false) $template = 'html';

	// get template object of first template to display
	$firstTemplate = new ts_Template($template);

	// load templates
	$firstTemplate->includeTemplate();

	return true;
    }

    /* get activated templates
     *
     * @return array
     */
    public function getActivatedTemplates () {

	// return (array)
	return $this->activatedTemplates;
    }

    /* clear all activated templates
     *
     * @return bool
     */
    public function clearActivatedTemplates () {

	// clear templates
	$this->activatedTemplates = array();

	return true;
    }
}
?>
