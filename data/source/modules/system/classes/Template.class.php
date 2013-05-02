<!-- | CLASS Template -->
<?php
/** Template class for one template file
 *
 * This class handles one template file
 */
class $$$Template {

    /** Name of template
     * @var string $template
     */
    protected $template;

    /** Data of template
     * @var array $data
     */
    protected $data;

    /** Constructor
     * @param string $template
     *	Name of template
     */
    public function __construct ($template = false) {

	// save input
	$this->template = $template;

	return;
    }

    /** Get current style
     *
     * @return string
     */
    public function getStyle () {
	global $TSunic;
	return $TSunic->Tmpl->getInfo('style');
    }

    /** Get data of this template
     *
     * @return mix
     */
    public function getVar ($name) { return $this->getData($name); }
    public function getData ($name) {

	// init data?
	if (!isset($this->data) OR empty($this->data)) {
	    global $TSunic;
	    $this->data = $TSunic->Tmpl->getData($this->template, true, true);
	}

	// return data
	if (isset($this->data[$name])) return $this->data[$name];
	return NULL;
    }

    /** Set data for this template
     * @param string|array $name
     *	String: name of value; array: data array
     * @param mix $value
     *	Value for data with name $name
     *
     * @return bool
     */
    public function setData ($name, $value = NULL) {

	// validate data
	if (empty($name)) return false;
	if (!isset($this->data) OR empty($this->data)) {
	    global $TSunic;
	    $this->data = $TSunic->Tmpl->getData($this->template, true, true);
	}

	// set data
	if (is_array($name)) {
	    $this->data = array_merge($this->data, $name);
	} else {
	    $this->data[$name] = $value;
	}

	return true;
    }

    /* ****************** display and include ******************** */

    /** Display template
     * @param bool|string $template
     *	False: display this template; string: display template $template
     * @param bool|array $data
     *	False: no data; array: data for new template
     *
     * @return bool
     */
    public function display ($template = false, $data = false) {
	global $TSunic;

	// another template?
	if (!empty($template)) {

	    // activate template
	    $TSunic->Tmpl->activate($template, $this->template, $data);

	    // get new template-object
	    $template = $TSunic->get('$$$Template', $template);

	    // display template
	    $template->display();
	    return true;
	}

	// get paths (priority-order)
	$paths = array(
	    '#runtime#templates/style'.$this->getStyle().'__'.$this->template.'.tpl.php',
	    '#runtime#templates/'.$this->template.'.tpl.php',
	    '#runtime#templates/style'.$this->getStyle().'__$$$noTemplateFound.tpl.php',
	    '#runtime#templates/$$$noTemplateFound.tpl.php'
	);

	// try to include template
	foreach ($paths as $index => $value) {

	    if ($index > 1) {
		// create error
		$TSunic->Log->log(2, 'Template "'.$this->template.'" not found!');
		$TSunic->Log->alert('error', '{CLASS__TEMPLATE__NOTEMPLATEFOUND}');
	    }

	    $File = $TSunic->get('$$$File', $value);
	    if ($File->isValid()) {
		$this->_include($File);

		// clear data
		$this->data = array();

		return true;
	    }
	}

	// fatale error! No template found!
	$TSunic->throwError('No template found!');
	exit;
    }

    /** Include template
     * @param object $File
     *	File object of template file
     *
     * @return bool
     */
    protected function _include ($File) {
	global $TSunic;

	// read output in buffer (start)
	if (ob_get_level() > 0) ob_end_flush();
	ob_start();

	// include file
	include $File->getPath();

	// get and clean output-buffer
	$content = ob_get_clean();

	// extract javascript from content
	if ($this->template != '$$$includeJavascript')
	    $content = preg_replace_callback('#\<script type="text\/javascript"\>(.*)\<\/script\>#Usi', array($this, 'extractJS'), $content);

	// print content (without JS) and return
	echo $content;
	return true;
    }

    /** Save JavaScript in session
     * @param array $code
     *	jsvascript-code from callback function
     *
     * @return ''
     */
    protected function extractJS ($code) {
	global $TSunic;
	$code = $code[0];

	// skip javascript-tags
	$code = str_replace('<script>', '', $code);
	$code = str_replace('<script type="text/javascript">', '', $code);
	$code = str_replace('</script>', '', $code);
	$code = trim($code);

	// save JS in session and return empty
	$TSunic->Tmpl->addJavascriptCode($this->template, $code);
	return '';
    }

    /** Include and display sub-templates
     * @param string $position
     *	Position in template
     *
     * @return bool
     */
    public function displaySub ($position = '#standard#') {
	global $TSunic;

	// get sub-templates
	$sub_templates = array();
	$allTemplates = $TSunic->Tmpl->activatedTemplates;
	if (!isset($allTemplates[$this->template], $allTemplates[$this->template][$position])) return true;
	foreach ($allTemplates[$this->template][$position] as $index => $values) {
	    $sub_templates[] = $values;
	}
	if (count($sub_templates) == 0) return true;

	// include sub-templates
	foreach ($sub_templates as $index => $value) {
	    $template = $TSunic->get('$$$Template', $value);
	    $template->display();
	}

	return true;
    }

    /* *************************** set **************************** */

    /** Parse for output
     * @param string $text
     *	Text to parse
     * @param array $data
     *	Variables to replace in lang-string
     * @param bool $doEcho
     *	echo?
     *
     * @return string
     */
    public function set ($text, $data = NULL, $doEcho = true) {
	global $TSunic;

	// replace language
	$text = $TSunic->Tmpl->replaceLang($text);

	// add data
	if (empty($data)) $data = array();
	if (!is_array($data)) $data = array($data);
	$this->setData($data);

	// replace variables (#...#)
	$text = preg_replace_callback('$#([0-9a-zA-zöäüÖÄÜ_]+)#$Us', array($this, '_replaceVar'), $text);

	// trim
	$text = trim($text);

	// echo?
	if ($doEcho == true) {

	    // replace special htmlchars
	    $text = htmlspecialchars($text);

	    echo $text;
	    return '';
	}

	return $text;
    }

    /** Replace vars (callback)
     * @param string $input
     *	Variable replacement
     *
     * @return string
     */
    public function _replaceVar ($input) {
	$input = substr($input[0], 1, (strlen($input[0]) - 2));

	// try to replace
	$temp = $this->getData($input);
	if ($temp or is_numeric($temp)) return $this->set($temp, NULL, false);
	return '#'.$input.'#';
    }

    /** Parse Link for output
     * @param string $event
     *	Name of event
     * @param bool|array $data
     *	False: no GET parameter; array: GET-parameters
     * @param bool $is_html
     *	Is link placed in html-code (set false for javascript etc.)
     * @param bool $doEcho
     *	Print link (false returns link)
     * @param bool $add_qstmrk
     *	Add questionmark in the beginning?
     *
     * @return bool
     */
    public function setUrl ($event, $data = false, $is_html = true, $doEcho = true, $add_qstmrk = true) {
	global $TSunic;

	// TODO: improvement + external links

	// get 'back'-link
	if ($event == 'back') {

	    // get back-time
	    $time = ($data === false OR !is_numeric($data)) ? 1 : $data;

	    // create link
	    $link = '?back='.$time;
	} else {

	    // return, if no module or event
	    if (!$event) return false;

	    // add current history-id
	    if (!is_array($data)) $data = array();
	    $data['hid'] = $TSunic->Temp->getCurrentHistoryId();

	    // create GET-parameters
	    $gets = '';
	    foreach ($data as $index => $value) {
		$gets.= '&'.$index.'='.$value;
	    }

	    // create link
	    $link = '?event='.$event.$gets;
	}

	// parse link for html-output
	if (!empty($is_html)) $link = str_replace('&', '&amp;', $link);

	// question-mark?
	if (!$add_qstmrk) $link = substr($link, 1);

	// print or return
	if ($doEcho == true) {
	    echo $link;
	} else {
	    return $link;
	}
    }

    /** Return/set old post variable
     * @param string $name
     *	Name of post
     * @param string $default
     *	Default value to use instead, if no old post variable found
     * @param bool $default
     *	Print it? (or return it)
     *
     * @return bool
     */
    public function setPreset ($name, $default = false, $doEcho = true) {
	global $TSunic;

	// get output
	$output = $TSunic->Temp->getPost($name, 1, true);

	// check, if is output or default should be set
	if (empty($output)) $output = $default;

	// trim finally
	if ($output) $output = trim($output);

	// return output
	if (!$doEcho) return $output;

	// print and return
	return $this->set($output);
    }

    /** Get link to image
     * @param string $type
     *	Type of file
     * @param string $image_name
     *	Name of image
     * @param bool $doEcho
     *	Print link? (return otherwise)
     * @param bool $isDownload
     *	Is download link?
     *
     * @return bool|string
     */
    public function setImg (
	$type, $image_name, $doEcho = true, $isDownload = false
    ) {
	global $TSunic;

	// validate input
	if (empty($type) OR empty($image_name)) return false;
	if (strstr($image_name, '/') OR strstr($image_name, '/') OR strstr($image_name, '/')) return false;
	if (strstr($image_name, '\\') OR strstr($image_name, '\\') OR strstr($image_name, '\\')) return false;

	// get by type
	switch ($type) {
	    case 'project':
		$link = 'files/style'.$this->getStyle().'__'.$image_name;
		if (!file_exists($link)) $link = 'files/'.$image_name;
		break;
	    case 'public':
		break;
	    case 'private':
		$link = 'file.php?id='.$image_name;
		break;
	    default:
		// invalid type
		return '';
	}

	// is download-link?
	if ($isDownload) $link.= '&download=true';

	// parse url for html-output
	if (!empty($is_html)) $url = str_replace('&', '&amp;', $link);

	// print?
	if ($doEcho == true) {
	    // print and return
	    echo $link;
	    return true;
	}

	// return url
	return $link;
    }

    # ############################ set (js) ############################## #

    /** Parse for JavaScript output (language- and bbcode-replacements)
     * @param string $text
     *	Text to parse
     * @param 0/array $vars
     *	Variables to replace in lang-string
     * @param bool $doEchoe
     *	Print text? (return otherwise)
     * @param bool $doEscape
     *	Escape single and double quotes?
     *
     * @return bool
     */
    public function setjs ($text, $vars = 0, $doEcho = true, $doEscape = false) {
	return $this->jsSet($text, $vars, $doEcho, $doEscape); }
    public function jsSet ($text, $vars = 0, $doEcho = true, $doEscape = false) {
	global $TSunic;

	// replace normal
	$text = $this->set($text, $vars, false, true);

	// escape certain characters
	$text = str_replace("'", "\'", $text);

	// echo or return
	if ($doEcho == true) {
	    // echo and return
	    echo $text;
	    return '';
	} else {
	    // return
	    return $text;
	}
    }

    /** Activate JavaScript function
     *
     * @return bool
     */
    public function addJSfunction ($name) { return $this->jsAddFunction($name); }
    public function jsAddFunction ($name) {
	global $TSunic;
	return $TSunic->Tmpl->addJSfunction($name);
    }
}
?>
