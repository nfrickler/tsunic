<!-- | CLASS TSunic -->
<?php
/** TSunic is the base class of this project
 *
 * Instantiate an object of this class to get access to all functions of TSunic
 */
class TSunic {

    /** Reference of Factory object
     * @var Factory $Factory
     */
    protected $Factory;

    /** Reference of Database object
     * @var Database $Db
     */
    public $Db;

    /** Reference of TemplateEngine object
     * @var TemplateEngine $Tmpl
     */
    public $Tmpl = NULL;

    /** Reference of Input object
     * @var Input $Input
     */
    public $Input;

    /** Reference of Temp object
     * @var Temp $Temp
     */
    public $Temp;

    /** Reference of Stats object
     * @var Stats $Stats
     */
    public $Stats;

    /** Reference of User object
     * @var User $Usr
     */
    public $Usr;

    /** Reference of Config object
     * @var Config $Config
     */
    public $Config;

    /** Reference of Log object
     * @var Log $Log
     */
    public $Log = NULL;

    /** Is current run called internally?
     *
     * @var bool $internal_run
     */
    protected $internal_run;

    /** Constructor
     *
     * This method will create the environment for TSunic
     */
    public function __construct () {

	// set global reference to this object
	global $TSunic;
	$TSunic = $this;

	// create factory object
	$this->Factory = new $$$Factory();

	// create stats object
	$this->Stats = $this->get('$$$Stats');

	// create setting object
	$this->Config = $this->get('$$$Config');

	// create database object
	$this->Db = $this->get('$$$Database');

	// create session object (this starts session)
	$readonlysession = ($this->getRunningMode() == 'index') ? false : true;
	$this->Session = $this->get('$$$Session', array($this->Db, $readonlysession));

	// create Temp object
	$this->Temp = $this->get('$$$Temp');

	// create Input object
	$this->Input = $this->get('$$$Input');

	// create Log object
	$this->Log = $this->get('$$$Log', $this->Config->get('loglevel'));

	// start template engine
	$this->Tmpl = $this->get('$$$TemplateEngine');

	// create user object
	$this->verifyUser();

	return;
    }

    /** Handle some event
     *
     * Call this function to make TSunic do some job. This method will search
     * for the requested module and function and run it providing the given
     * parameters
     *
     * @param string $event
     *	If running internally, enter the event here
     * @param array|string $parameters
     *	Parameters for event function (internal-run only!)
     *
     * @return bool|mix
     */
    public function run ($event = NULL, $parameters = NULL) {
	$this->internal_run = false;

	// is internal run?
	if (!empty($event)) {
	    // internal
	    $this->internal_run = true;

	    // get parameter-string
	    $parameter_string = '';
	    if (!($parameters === false)) {

		// put values in array
		if (!is_array($parameters)) $parameters = array($parameters);

		// create parameter-string for function
		foreach ($parameters as $index => $value) {
		    // use nowdoc to define string (TRICKY!)
		    $parameters[$index] = '<<<\'EOD\''.chr(10).$value.chr(10).'EOD'.chr(10);
		}
		$parameter_string = implode(',', $parameters);
	    }

	} else {
	    // external

	    // delete old activated templates
	    $this->Tmpl->clearActivatedTemplates();

	    // redirect, if back-link
	    if ($this->isIndex() AND isset($_GET['back'])) $this->redirect('this');

	    // get event
	    $event = $this->Temp->getEvent();
	    if (empty($event)) {
		if ($this->isAjax()) return false;
		$this->redirect('default');
		exit;
	    }

	}
	$this->Log->log(6, "Run: $event");

	// get path and file-object
	$path = '#runtime#functions/'.$event.'.func.php';
	$File = $this->get('$$$File', array($path));

	// does file exists?
	if (!$File->isFile()) {
	    // function doesn't exist
	    if ($this->internal_run OR $this->isAjax()) return false;

	    // page not found!
	    $this->Log->alert('error', '{CLASS__TSUNIC__PAGE_NOT_FOUND}');
	    $this->redirect('back');
	}

	// include function
	$File->includeFile();

	// run function
	if (!$this->internal_run OR empty($parameter_string)) {
	    $return = $event();
	} else {
	    $to_eval = '$return = '.$event.'('.$parameter_string.');';
	    try {
		@eval($to_eval);
	    } catch (Exception $e) {
		// invalid function
		$this->throwError(
		    'Fatale error: Requested function is invalid! ('.
		    $this->Temp->getEvent().')'
		);
	    }
	}

	if (!$this->internal_run OR $return === NULL) return true;
	return $return;
    }

    /** Get instance of some class.
     *
     * This method is will call the Factory object to get a new object of
     * some class. You can specify, if you want to force the creation of a new
     * object or if it is ok for you, to reuse an existing one (default)
     *
     * @param string $class
     *	Class of requested object
     * @param array $values
     *	Parameters to hand to the objects constructor
     * @param bool $forceNew
     *	Force object to be a new one
     *
     * @return object
     */
    public function get ($class, $values = array(), $forceNew = false) {
	return $this->Factory->get($class, $values, $forceNew);
    }

    /** Display output of TSunic
     *
     * Call this function to display the output of TSunic.
     * If you call this function from an ajax request, it will return xml output
     *
     * @param string $template
     *	Request output of certain template only
     *
     * @return bool
     */
    public function display ($template = false) {

	// validate template
	if (empty($template)) {
	    $template = $this->Temp->getGet('tmpl');

	    // is tmpl?
	    if (empty($template)) $template = '$$$html';
	}

	// display templates
	if (!$this->isAjax()) {
	    $this->Tmpl->display($template);
	} else {
	    $this->Tmpl->responseAjax();
	}

	return true;
    }

    /** Verify login of user
     *
     * This function verifies that the user is logged in. If this check fails
     * and the user requests an event that is not permitted it redirects to the
     * login page
     *
     * @return bool
     */
    private function verifyUser () {

	// get pages, a guest has access to
	// NO GOOD CODING - will be replaced, when Access-System is included...
	$allowed_pages = array('$$$showIndex',
	    '$usersystem$showIndex',
	    '$usersystem$doLogin',
	    '$usersystem$doRegister',
	    '$usersystem$showLogin',
	    '$usersystem$showRegistration',
	    '$$$resetAllCookies',
	    '$$$disableJavascript',
	    '$$$enableJavascript',
	    '$$$autoenableJavascript',
	    '$$$showSysteminfo',
	    '',
	    '$$$setLanguage',
	    '$help$showHelp',
	    '$help$showMain');

	// get user
	$this->Usr = $this->get('$usersystem$User');

	// is allowed to access current page?
	if (
	    $this->isIndex() and
	    !$this->Usr->isLoggedIn() and
	    !in_array($this->Temp->getEvent(), $allowed_pages)
	) {
	    $this->Log->alert('error', '{CLASS__TSUNIC__LOGINFIRST}');
	    $this->redirect('$usersystem$showLogin');
	    exit;
	}

	return true;
    }

    /** Check, if JavaScript is enabled
     *
     * Is JavaScript enabled for this user? This method will give you the
     * answer.
     *
     * @param bool $getDistinguishable
     *	Return true, only if JavaScript has been disabled by the user
     *	explicitely (false, if this has been detected automatically)
     *
     * @return bool
     */
    public function isJavascript ($getDistinguishable = false) {

	// get javascript-setting
	$value = $this->Usr->config('$$$javascript');

	// get return
	if ($getDistinguishable) {
	    return $value;
	} else {
	    if ($value == 'off' OR $value === false) return false;
	    return true;
	}
    }

    /** Get name of file, who started TSunic request
     *
     * Possible values: index|ajax|javascript|file
     *
     * @return string
     */
    public function getRunningMode () {

	// get mode
	switch (basename($_SERVER['PHP_SELF'])) {
	    case 'ajax.php':
		$output = 'ajax';
		break;
	    case 'functions.js.php':
		$output = 'javascript';
		break;
	    case 'file.php':
		$output = 'file';
		break;
	    default:
		$output = 'index';
	}

	// change, if isset $_GET['tmpl']
	if (isset($_GET['tmpl'])) $output = 'template';

	return $output;
    }

    /** Is TSunic accessed via ajax?
     *
     * @return bool
     */
    public function isAjax () {
	return ($this->getRunningMode() == 'ajax') ? true : false;
    }

    /** Is TSunic accessed via index?
     *
     * @return bool
     */
    public function isIndex () {
	return ($this->getRunningMode() == 'index') ? true : false;
    }

    /** Is TSunic accessed via template?
     *
     * @return bool
     */
    public function isTemplate () {
	return ($this->getRunningMode() == 'template') ? true : false;
    }

    /** Get all installed modules
     *
     * Get a list of all installed modules
     *
     * @return array|bool
     */
    public function getModules () {
	if (!$this->Db) return array();

	// get all modules from database
	$sql = "SELECT id__module as id,
	    name,
	    author,
	    description,
	    version_installed,
	    link
	    FROM ".$this->Config->get('prefix')."modules
	    WHERE is_activated = 1
	    AND is_parsed = 1
	    ORDER BY name ASC;";
	return $this->Db->doSelect($sql);
    }

    /** Display fatal error message and exit
     *
     * Use this function to throw an fatale exception and exit the the script
     *
     * @param string $message
     *  The error message to be thrown
     */
    public function throwError ($message = 0) {

	// parse $message
	if ($message === 0) $message = 'Unknown error.';
	$message = str_replace('<', '&lt;', $message); // replace <
	$message = str_replace('>', '&gt;', $message); // replace >

	// log error
	$this->Log->log(1, "Fatal error: $message");

	// display error
	$output = '<h1>TSunic '.$this->Config->get('version').' - Fatal error!</h1>';
	$output.= '<p><strong>Error message:</strong><br />';
	$output.= $message;
	$output.= '</p><p>For more information please contact the webmaster of this page.</p>';
	$output.= '<p><a href="?">back to home</a></p>';

	// return/throw
	if ($this->isAjax()) {
	    // add as error
	    // TODO
	    echo '<error>'.$output.'</error>';
	    exit;
	} else {
	    // delete session
	    session_unset();
	    // print
	    echo $output;
	    // end script
	    exit;
	}
    }

    /** Redirect user
     *
     * Redirect user to another page (or event)
     *
     * @param string $event
     *	Name of event to redirect to (use 'back' to redirect one event back, 
     *	'this' to redirect to the current event and 'default' to redirect to 
     *	default start page)
     * @param bool|array|int $gets
     *	GET parameters for redirect or number of events to go back
     *
     */
    public function redirect ($event, $gets = false) {

	// TODO: Prevent internal runs from redirecting

	// get loop
	$loop = $this->Temp->getGet('loop');

	// get module and event
	if ($event === 'back') {
	    // go back to page in history

	    // get back-time
	    $time = ($gets === false OR !is_numeric($gets)) ? 1 : $gets;

	    // create link
	    $link = '?back='.$time;
	} elseif ($event === 'default') {
	    // set default-event
	    $link = '?event=$$$showIndex';
	} elseif ($event === 'this') {
	    // redirect to current page

	    // get parameters
	    $gets = $this->Temp->getGet(true, 0);
	    if (isset($gets['loop'])) unset($gets['loop']);

	    // sum up GET-parameters
	    $url_gets = '';
	    foreach ($gets as $index => $value) {
		$url_gets.= '&'.$index.'='.$value;
	    }

	    // get link
	    $link = '?'.substr($url_gets, 1);

	} elseif ($gets === true) {
	    // redirect to address given in $event
	    $link = $event;

	} elseif (!empty($event)) {

	    // get module and event from its parameters
	    $gets = ($gets === false OR !is_array($gets)) ? array() : $gets;
	    $gets['event'] = $event;

	    // sum up GET-parameters
	    $url_gets = '';
	    foreach ($gets as $index => $value) {
		$url_gets.= '&'.$index.'='.$value;
	    }

	    // get redirect-path
	    $link = '?'.substr($url_gets, 1);
	} else {

	    // event doesn't exist
	    $this->Log->alert('error', '{CLASS__TSUNIC__PAGE_NOT_FOUND}');
	    $link = '?back=1';
	}

	// loop-prevention
	if (!empty($loop) AND $loop >= 6) {
	    $this->Log->log(3, "TSunic: Redirect failed!");
	    $this->throwError('Redirect failed!');
	} elseif (!is_numeric($loop)) {
	    $loop = 0;
	}
	$loop++;
	$link.= '&loop='.$loop;

	// check, if ajax
	if ($this->isAjax()) {
	    // TODO
	    echo '<redirect>'.$link.'</redirect>';
	} else {
	    // redirect and exit
	    $this->Log->log(6, "TSunic::redirect: redirecting to $link");
	    header('Location:'.$link);
	}
	exit;
    }
}
?>
