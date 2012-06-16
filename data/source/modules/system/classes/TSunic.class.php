<!-- | CLASS TSunic -->
<?php
class TSunic {

	/* reference to factory-object
	 * object
	 */
	protected $Factory;

	/* reference to database-object
	 * object
	 */
	public $Db;

	/* reference to templateEngine-object
	 * object
	 */
	public $Tmpl;

	/* reference to temp-object
	 * object
	 */
	public $Temp;

	/* reference to stats-object
	 * object
	 */
	public $Stats;

	/* reference to User object
	 * object
	 */
	public $Usr;

	/* reference to config-object
	 * object
	 */
	public $Config;

	/* reference to Log object
	 * object
	 */
	public $Log;

	/* is currently running internal
	 * bool
	 */
	protected $internal_run;

	/* constructor
	 */
	public function __construct () {

		// set global reference to this object
		global $TSunic;
		$TSunic = $this;

		// create factory-object
		include_once 'runtime/classes/$$$Factory.class.php';
		$this->Factory = new $$$Factory();

		// create stats-object
		$this->Stats = $this->get('$$$Stats');

		// create parser-object
		$this->Parser = $this->get('$$$Parser');

		// create setting-object
		$this->Config = $this->get('$$$Config');

		// create database-object
		$this->Db = $this->get('$$$Database');

		// create session-object (this starts session)
		$readonlysession = ($this->getRunningMode() == 'index') ? false : true;
		$this->Session = $this->get('$$$Session', array($this->Db, $readonlysession));

		// create Temp-object
		$this->Temp = $this->get('$$$Temp');

		// create Log object
		$this->Log = $this->get('$$$Log');

		// start template-engine
		$this->Tmpl = $this->get('$$$TemplateEngine');

		// create user object
		$this->verifyUser();

		return;
	}

	/* run TSunic-Function
	 * +@param string: event (internal-run only!)
	 * +@param array/string: parameters for event-function (internal-run only!)
	 *
	 * @return bool/mix
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

	/* get instance of class
	 * @param string: name of class
	 * +@param array: values of object in constructor
	 * +@param bool: force object to be a new one
	 *
	 * @return OBJECT
	 */
	public function get ($class, $values = array(), $forceNew = false) {
		return $this->Factory->get($class, $values, $forceNew);
	}

	/* get FsFile object (for: file.php!)
	 * @param int: id of file in users filesystem
	 *
	 * @return OBJECT
	 */
	public function getFsFile ($id) {
		return $this->get('$usersystem$FsFile', $id);
	}

	/* display output
	 * +@param string: main-template to display
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

	/* verify user-login
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
	/* check, if JavaScript is enabled
	 * @param bool: true - only true, if set by user; false - also true, if auto-set
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

	/* get type of running file
	 *
	 * @return string (index|ajax|javascript|file)
	 */
	public function getRunningMode () {

		// get filename of current-file
		$basename = basename($_SERVER['PHP_SELF']);

		// get mode
		switch ($basename) {
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
		if (isset($_GET['tmpl'])) {
			$output = 'template';
		}

		return $output;
	}

	/* check, if TSunic is booted from ajax-file
	 *
	 * @return bool
	 */
	public function isAjax () {
		return ($this->getRunningMode() == 'ajax') ? true : false;
	}

	/* check, if TSunic is booted from index-file
	 *
	 * @return bool
	 */
	public function isIndex () {
		return ($this->getRunningMode() == 'index') ? true : false;
	}

	/* check, if TSunic is booted as template-file
	 *
	 * @return bool
	 */
	public function isTemplate () {
		return ($this->getRunningMode() == 'template') ? true : false;
	}

	/* get all installed modules
	 *
	 * @return array/bool
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
		    FROM ".$this->Config->getConfig('preffix')."modules
		    WHERE is_activated = 1
			AND is_parsed = 1
		    ORDER BY name ASC;";
	    return $this->Db->doSelect($sql);
	}

	/* return fatale error-message and end script
	 * @param string: error-message
	 *
	 * @return - EXIT SCRIPT
	 */
	public function throwError ($message = 0) {

		// parse $message
		if ($message === 0) $message = 'Unknown error.';
		$message = str_replace('<', '&lt;', $message); // replace <
		$message = str_replace('>', '&gt;', $message); // replace >

		// display error
		$output = '<h1>TSunic '.$this->Config->getConfig('version').' - Fatal error!</h1>';
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

	/* redirect user
	 * @param string: name of event to redirect to
	 *	OR back, this, default
	 * +@param bool/array/int: GET-parameters
	 *	OR int: time-hops to go back
	 *
	 * @return EXIT
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
			header('Location:'.$link);
		}
		exit;
	}
}
?>
