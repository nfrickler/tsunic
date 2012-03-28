<!-- | class to validate strings -->
<?php

class $$$StringValidator {

	/* check, if string is email-address
	 * @param string $email: email-address to be validated
	 *
	 * @return bool
	 */
	public function isEMail ($email) {

		// Might be a better regex-phrase from James Watts and Francisco Jose Martin Moreno:
		// /^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i
		// check email
		if (preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email) == 0) {
			return true;
		}
		return false;
	}

	/* check, if string is possible password
	 * @param string $password: password
	 *
	 * @return bool
	 */
	public function isPassword ($password) {
		// TODO
		return true;
	}
}
?>
