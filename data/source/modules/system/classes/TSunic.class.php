<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/TSunic.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

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

	/* reference to CurrentUser-object
	 * object
	 */
	public $CurrentUser;

	/* reference to SecurityHandler-object
	 * object
	 */
	public $Encryption;

	/* reference to config-object
	 * object
	 */
	public $Config;

	/* reference to Log-object
	 * object
	 */
	public $Log;

	/* constructor
	 *
	 * @return OBJECT
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

		// create Encryption-object
		$this->Encryption = $this->get('$$$Encryption');

		// create database-object
		$this->Db = $this->get('$$$Database');

		// create session-object (this starts session)
		$readonlysession = ($this->getRunningMode() == 'index') ? false : true;
		$this->Session = $this->get('$$$Session', array($this->Db, $readonlysession));

		// create Temp-object
		$this->Temp = $this->get('$$$Temp');

		// create Log-object
		$this->Log = $this->get('$$$Log');

		// start template-engine
		$this->Tmpl = $this->get('$$$TemplateEngine');

		// get or create user-object
		$this->verifyUser();

		return;
	}

	/* run TSunic-Function
	 * +@param string $event: event (internal-run only!)
	 * +@param array/string $parameters: parameters for event-function (internal-run only!)
	 *
	 * @return bool/mix
	 */
	public function run ($event = NULL, $parameters = NULL) {
		$is_internal = false;

		// is internal run?
		if (!empty($event)) {
			// internal
			$is_internal = true;

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
			if ($is_internal OR $this->isAjax()) return false;

			// page not found!
			$this->Log->add('error', '{CLASS__TSUNIC__PAGE_NOT_FOUND}', 3);
			$this->redirect('back');
		}

		// include function
		$File->includeFile();

		// run function
		if (!$is_internal OR empty($parameter_string)) {
			$return = $event();
		} else {
			$to_eval = '$return = '.$event.'('.$parameter_string.');';
			try {
				@eval($to_eval);
			} catch (Exception $e) {
				// invalid function
				$this->throwError('Fatale error: Requested function is invalid! ('.$this->Temp->getEvent().')');
			}
		}

		if (!$is_internal OR $return === NULL) return true;
		return $return;
	}

	/* get instance of class
	 * @param string $class: name of class
	 * +@param array $values: values of object in constructor
	 * +@param bool $forceNew: force object to be a new one
	 *
	 * @return OBJECT
	 */
	public function get ($class, $values = array(), $forceNew = false) {
		return $this->Factory->get($class, $values, $forceNew);
	}

	/* get userfile-object (for: file.php!)
	 * @param int $id__usersystem__userfile: id of userfile	 
	 *
	 * @return OBJECT
	 */
	public function getUserfile ($id__usersystem__userfile) {
		return $this->get('$usersystem$Userfile', $id__usersystem__userfile);
	}

	/* display output
	 * +@param string $template: main-template to display
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
							   '$help$showMain');

		// get currentUser-object
		$this->CurrentUser = $this->get('$usersystem$CurrentUser');

		// check, if user is guest
		if ($this->CurrentUser->isGuest()) {
			// is guest
			// check, if index-request
			if (!$this->isIndex()) return true;
			if (!in_array($this->Temp->getEvent(), $allowed_pages)) {
				// prompt login-form
				$this->Log->add('error', '{CLASS__TSUNIC__LOGINFIRST}', 3, '$usersystem$showLogin');
				exit;
			}
		}

		return true;
	}
	/* check, if JavaScript is enabled
	 * @param bool $getDistinguishable: true - only true, if set by user; false - also true, if auto-set
	 *
	 * @return bool
	 */
	public function isJavascript ($getDistinguishable = false) {

		// get javascript-setting
		$value = $this->Config->getRuntime('javascript');

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
		if ($this->getRunningMode() == 'ajax') return true;
		return false;
	}

	/* check, if TSunic is booted from index-file
	 *
	 * @return bool
	 */
	public function isIndex () {
		if ($this->getRunningMode() == 'index') return true;
		return false;
	}

	/* check, if TSunic is booted as template-file
	 *
	 * @return bool
	 */
	public function isTemplate () {
		if ($this->getRunningMode() == 'template') return true;
		return false;
	}

	/* return fatale error-message and end script
	 * @param string $message: error-message
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
	 * @param string $event: name of event to redirect to
	 * 		OR back, this, default
	 * +@param bool/array/int $gets: GET-parameters
	 * 		OR int: time-hops to go back	 
	 *
	 * @return EXIT
	 */
	public function redirect ($event, $gets = false) {

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
			$this->Log->add('error', '{CLASS__TSUNIC__PAGE_NOT_FOUND}');
			$link = '?back=1';
		}

		// loop-prevention
		if (!empty($loop) AND $loop >= 6) {
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