<!-- | -->
<?php
class $$$TemplateEngine {

	/* path to template-file
	 * string
	 */
	private $lang = array();

	/* session key-name
	 * string
	 */
	private $session_key = '$$$templateEngine';

	/* array with all javascript-code (post)
	 * array
	 */
	private $javascript_post;

	/* chosen style
	 * string
	 */
	private $style;

	/* activated templates
	 * array
	 */
	public $activatedTemplates = array();

	/* activated templates
	 * array
	 */
	public $activatedJavascript = array();

	/* constructor
	 * +@param string: name of design
	 */
	public function __construct ($style = 0) {
		global $TSunic;

		// get activated templates and javascript
		if (isset($_SESSION['activatedTemplates'])) {
			$this->activatedTemplates = $_SESSION['activatedTemplates'];
		}
		if (isset($_SESSION['activatedJavascript'])) {
			$this->activatedJavascript = $_SESSION['activatedJavascript'];
		}

		// get style
		$this->style = ($style) ? $style : $TSunic->Config->getConfig('default_style');

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

	/* get data from this object
	 * @param string: name of data to get
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

	/* activate template for output
	 * @param string: name of template
	 * @param string/bool: if supTemplate exists -> name ELSE 0 or false
	 * @param bool/array: data for template
	 * @param bool/string: position to include template within sup-template 
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
			$_SESSION['activatedTemplates'] = $this->activatedTemplates;
		}

		// add data
		$this->setData($template, $data);

		return true;
	}

	/* save data for template
	 * @param string/bool: template, data are for
	 * 	false - reset all data
	 * 	true - get all data from session
	 * +@param string/array: string - name of value
	 * 	array - data-array
	 * +@param mix: value for data with name $name
	 *
	 * @return bool
	 */
	public function setData ($template, $data = NULL, $value = NULL) {

		// load data from session?
		if ($template === true) {
			$this->data = (isset($_SESSION[$this->session_key]))
				? $_SESSION[$this->session_key]
				: array();
			return true;

		// reset data?
		} elseif ($template === false) {
			$this->data = array();
			$_SESSION[$this->session_key] = array();
			$_SESSION['javascript_code'] = array();
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

		// save data in session
		$_SESSION[$this->session_key] = $this->data;

		return true;
	}

	/* save data
	 * @param string: template to fetch data for
	 * +@param string/bool: name of data (true - return all data of template)
	 * +@param bool: unset data afterwards
	 *
	 * @return mix
	 */
	public function getData ($template, $name = true, $unset = false) {

		// load data (once)
		if (empty($this->data)) {
			if (isset($_SESSION[$this->session_key])
				AND !empty($_SESSION[$this->session_key])
			) {
				$this->data = $_SESSION[$this->session_key];
			} else {
				$this->data = array();
			}
		}

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
		$regex = '#\{([A-Z_ÄÖÜ][A-Z_ÄÖÜ0-9]+)\}#Us';

		// save $doEcho in cache
		$TSunic->Temp->setCache('ts_TemplateEngine_class_replaceLang_doEscape', $doEscape);

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
		$matches_post_count = preg_match_all(
			$regex,
			$text,
			$matches_post,
			PREG_SET_ORDER
		);
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
		global $TSunic;
		$index = substr($index[0], 1 ,(strlen($index[0])-2));

		// get doEscape from cache
		$doEscape = $TSunic->Temp->getCache('ts_TemplateEngine_class_replaceLang_doEscape');

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

	/* get language-replacements
	 * @param string: language-placeholder or module
	 * +@param bool/string: set language to include
	 * +@param bool: return, if include fails
	 *
	 * @return bool
	 */
	public function loadLanguage ($input, $lang = false, $returnOnFail = false) {
		global $TSunic;

		// get languages
		$chosen_lang = $TSunic->Config->getRuntime('language');
		$default_lang = $TSunic->Config->getConfig('default_language');

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
			$current = $TSunic->Config->getRoot().'/runtime/lang/'.$value;

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

	/* display output
	 * @param bool/string: name of first template
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
		if (!file_exists($path)) $path = 'runtime/css/format.css';
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

	/* return ajax-response (xml)
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

	/* add javascript-class or -function for output
	 * @param string: name
	 *
	 * @return bool
	 */
	public function addJSfunction ($name) {

		// save in array
	    $this->activatedJavascript[$name] = $name;

		// save in SESSION
		$_SESSION['activatedJavascript'] = $this->activatedJavascript;

		return true;
	}

	/* returns all javascript-code from all templates
	 *
	 * @return bool
	 */
	public function addJavascriptCode ($template, $input) {

		// validate input
		if (empty($template) OR empty($input)) return false;

		// validate session
		if (!isset($_SESSION['$$$TemplateEngine__extractedJS'])) $_SESSION['$$$TemplateEngine__extractedJS'] = array();

		// save in SESSION
		$_SESSION['$$$TemplateEngine__extractedJS'][$template] = base64_encode($input);

		return true;
	}

	/* returns all javascript-code from all templates
	 * +@param bool: delete code afterwards
	 *
	 * @return bool
	 */
	public function getAllJavascript ($delete = false) {

		// try to get from SESSION
		if (isset($_SESSION['$$$TemplateEngine__extractedJS'])
			AND is_array($_SESSION['$$$TemplateEngine__extractedJS'])
			AND !empty($_SESSION['$$$TemplateEngine__extractedJS'])) {

			// get code
			$code = $_SESSION['$$$TemplateEngine__extractedJS'];

			// delete?
			if ($delete) $_SESSION['$$$TemplateEngine__extractedJS'] = array();

			return $code;
		}

		return array();
	}

	/* get javascript-code (pre)
	 *
	 * @return array
	 */
	public function getActivatedJavascript () {
		return $this->activatedJavascript;
	}

	/* get activated templates
	 *
	 * @return array
	 */
	public function getActivatedTemplates () {
		return $this->activatedTemplates;
	}

	/* clear all activated templates and javascript-classes und -functions
	 *
	 * @return bool
	 */
	public function clearActivatedTemplates () {

		// clear templates
		$_SESSION['activatedTemplates'] = array();
		$this->activatedTemplates = array();

		// clear javascript
		$_SESSION['activatedJavascript'] = array();
		$this->activatedJavascript = array();

		return true;
	}
}
?>
