<!-- | class for mcrypt encryption -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Encryption_mcrypt.class.php
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

class $$$Encryption_mcrypt {

	/* key for encryption
	 * string
	 */
	private $key;

	/* algorithm (e.g. blowfish)
	 * string
	 */
	private $algorithm;

	/* mode (e.g. ecb)
	 * string
	 */
	private $mode;

	/* cypher-object
	 * object
	 */
	private $cipher_obj;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		global $TSunic;

		// load algorithm and mode
		$this->algorithm = $TSunic->Config->getConfig('encryption_algorithm');
		$this->mode = $TSunic->Config->getConfig('encryption_mode');

		// get cypher-object
		$this->cypher_obj = mcrypt_module_open($this->algorithm, '', $this->mode, '');

		return;
	}

	/* set password for en-/decryption
	 * @param string $key: encryption-key
	 *
	 * @return bool
	 */
	public function setPassword ($key) {

		// save key in obj-vars
		$this->key = $key;

		return true;
	}

	/* encrypts string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function encrypt ($input) {

		// init
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->cypher_obj), MCRYPT_RAND); 
		mcrypt_generic_init($this->cypher_obj, $this->key, $iv);

		// encrypt
		$output = mcrypt_generic($this->cypher_obj, $input);

		// deinit
		mcrypt_generic_deinit($this->cypher_obj);
		return $output;
	//	return base64_encode($output);
	}

	/* decrypts string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function decrypt ($input) {
		if (empty($input)) return '';
	//	$input = base64_decode($input);

		// init
		$ivsize = mcrypt_get_iv_size($this->algorithm, $this->mode);
		$iv = substr($input, 0, $ivsize);
	//	$input = substr($input, 0, $ivsize);
		mcrypt_generic_init ($this->cypher_obj, $this->key, $iv);

		// decrypt
		$output = mdecrypt_generic($this->cypher_obj, $input);

		// deinit
		mcrypt_generic_deinit ($this->cypher_obj);
		return trim($output);
	}
}
?>