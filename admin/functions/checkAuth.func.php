<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/checkAuth.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; check authorization
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

function checkAuth () {
	global $Config;

	// is password set?
	if ($Config->get('admin_password') === NULL) {
		// redirect to set-password-page
		$_SESSION['admin_info'] = 'INFO__SETPASSWORD';
		header('Location:?event=showSetLogin');
		exit;
	}

	// tries to log in?
	if (isset($_GET['event']) AND $_GET['event'] == 'doLogin') {
		// login

		// validate input
		if (!isset($_POST['pass'])) {
			$_SESSION['admin_error'] = 'ERROR__LOGINERROR';
			header('Location:?event=showLogin');
			exit;
		}

		// validate password
		if (md5(md5($_POST['pass'])) != $Config->get('admin_password')) {
			$_SESSION['admin_error'] = 'ERROR__LOGINERROR';
			header('Location:?event=showLogin');
			exit;
		}

		// successful login
		$_SESSION['admin_auth'] = true;
	}

	// is logged in?
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth'])) {
		// redirect to login-page
		header('Location:?event=showLogin');
		exit;
	}

	return true;
}
?>