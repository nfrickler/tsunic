<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/setLogin.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; set login password
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

// deny direct access
defined('TS_INIT') OR die('Access denied!');

function setLogin () {
	global $Config;

	// is password already set?
	if ($Config->get('admin_password')) {

		// allow changes only, if logged in
		if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth'])) {
			$_SESSION['admin_error'] = 'ERROR__PLEASELOGIN';
			header('Location:?event=showLogin');
			exit;
		}
	}

	// validate input
	if (!isset($_POST['pass']) OR empty($_POST['pass'])) {
		$_SESSION['admin_error'] = 'ERROR__UNKNOWNERROR';
		header('Location:?event=showSetLogin');
		exit;
	}

	// get password
	$pass = md5(md5($_POST['pass']));

	// set password in config-file
	if (!$Config->set('admin_password', $pass)) {
		// error occurred
		$_SESSION['admin_error'] = 'ERROR__UNKNOWNERROR';
		header('Location:?event=showSetLogin');
		exit;
	}

	// update installation-progress
	if ($Config->get('installation') < 100) {
		$Config->setArray('installation_progress', 'setLogin', true);
	}

	// logout
	unset($_SESSION['admin_auth']);

	$_SESSION['admin_info'] = 'INFO__SAVED';
	header('Location:?event=showLogin');
	exit;
}
?>