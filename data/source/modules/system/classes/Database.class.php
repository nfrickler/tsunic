<!-- | -->
<?php
class $$$Database {

	/* database object of chosen type
	 * object
	 */
	private $Db_obj;

	/* sql2array-object
	 * object
	 */
	private $Sql2array;

	/* constructor
	 */
	public function __construct () {
		global $TSunic;

		// get connection-data
		$db_class = $TSunic->Config->getConfig('db_class');
		$host = $TSunic->Config->getConfig('db_host');
		$user = $TSunic->Config->getConfig('db_user');
		$pass = $TSunic->Config->getConfig('db_pass');
		$database = $TSunic->Config->getConfig('db_database');

		// get object for chosen type of database
		$this->Db_obj = $TSunic->get('$$$Database_'.$db_class, array($host, $user, $pass, $database));
		if (!$this->Db_obj) {
			$TSunic->throwError('{CLASS__DATABASE__INVALID_CLASS}');
			return;
		}
		if (!$this->Db_obj->isValid()) {
			$TSunic->throwError('{CLASS__DATABASE__CONNECTION_FAILED}');
			return;
		}

		// get sql2array-object
		$this->Sql2array = $TSunic->get('$$$Sql2array');

		return;
	}

	/* ######################### queries ################################ */

	/* functions to send queries to database
	 * @param string: query
	 * +@param bool: false will skip encryption
	 *
	 * @return mix
	 */
	public function doSelect ($query, $is_enc = true) {

		// encrypt data
		if ($is_enc) $query = $this->encrypt($query);

		// call database
		$return = $this->_callDatabase('select', $query);

		// decrypt data
		if (is_array($return) AND $is_enc) $return = $this->decrypt($return);
		return $return;
	}
	public function doInsert ($query) {

		// encrypt data
		$query = $this->encrypt($query);

		return $this->_callDatabase('insert', $query);
	}
	public function doUpdate ($query) {

		// encrypt data
		$query = $this->encrypt($query);

		return $this->_callDatabase('update', $query);
	}
	public function doDelete ($query) {
		return $this->_callDatabase('delete', $query);
	}
	public function createTable ($query) {
		return $this->_callDatabase('createTable', $query);
	}
	// @param string $table: name of the table to get columns from
	public function getColumns ($table) {
		return $this->_callDatabase('getColumns', $table);
	}
	// @param string $table: name of the table to check
	public function isTable ($table) {
		return $this->_callDatabase('isTable', $table);
	}

	/* "execute" a sql-file
	 * @param string: path to sql-file
	 *
	 * @return bool
	 */
	public function runFile ($path, $id__module = false) {
		global $TSunic;

		// get content of file
		$File = $TSunic->get('$$$File', $path);
		if (!$File->isValid) return false;

		// get query from file
		$query = $File->readFile(true);

		// strip comments
		$query = preg_replace('#(\<\!--.*--\>)#Usi', '', $query);

		// split and run all queries in a row
		$cache = explode(';', $query);
		foreach ($cache as $index => $value) {
			if (empty($value)) continue;

			$result = $this->_callDatabase('doQuery', $value);
			if ($result === false) return false;
		}

		return true;
	}

	/* parse sql-query for database
	 * @param string: sql-query (exeptions see above)
	 *
	 * @return bool or REDIRECT
	 */
	private function _callDatabase ($type, $query) {
		global $TSunic;

		// start timer
		if (!empty($TSunic) AND is_object($TSunic))
			$TSunic->Stats->startTimer('mysql');

		// query Database by type
		switch ($type) {
			case 'select':
				$return = $this->Db_obj->doSelect($query);
				break;
			case 'insert':
				$return = $this->Db_obj->doInsert($query);
				break;
			case 'update':
				$return = $this->Db_obj->doUpdate($query);
				break;
			case 'delete':
				$return = $this->Db_obj->doDelete($query);
				break;
			case 'createTable':
				$return = $this->Db_obj->createTable($query);
				break;
			case 'getColumns':
				$return = $this->Db_obj->getColumns($query);
				break;
			case 'isTable':
				$return = $this->Db_obj->isTable($query);
				break;
			case 'doQuery':
				$return = $this->Db_obj->doQuery($query);
				break;
		}

		// stop timer
		if (!empty($TSunic) AND is_object($TSunic))
			$TSunic->Stats->stopTimer('mysql');

		// handle errors
		if ($this->Db_obj->getError()) {
			// add error in log
			$TSunic->Log->doLog(2, "system->Database: Database error: '".$this->Db_obj->getError()."' (query: '$query')");
			$TSunic->Log->add('warning', 'Database-Error: '.$this->Db_obj->getError().'!', 1);
		}
		if ($return === false) {
			// critical database-error
			$TSunic->Log->doLog(2, "system->Database: Critical database error: '".$this->Db_obj->getError()."' (query: '$query')");
			$TSunic->throwError('Database-Error!');
			exit;
		}

		return $return;
	}

	/* ######################### encryption ############################# */

	/* parse query with encryption
	 * @param array: array with sql-query-data
	 *
	 * @return array or REDIRECT
	 */
	public function encrypt ($sql) {
		global $TSunic;

		// skip, if no TSunic-object (e.g. SESSION!)
		if (empty($TSunic) OR !is_object($TSunic)) return $sql;

		// start timer
		$TSunic->Stats->startTimer('encryption');

		// get tree
		$array = $this->Sql2array->toArray($sql);

		// encrypt data
		$array = $this->encryptArray($array);

		// convert to sql-query
		$sql = $this->Sql2array->toSql($array);

		// stop timer
		$TSunic->Stats->stopTimer('encryption');

		return $sql;
	}

	/* encrypt data, if values of name $name have to be encrypted
	 * @param string: name
	 * @param string: value
	 *
	 * @return string
	 */
	protected function _encryptNameValue ($name, $value) {

		// check, if value has to be encrypted
		if (substr($name, 0, 1) == '_'
				AND substr($name, -1) == '_') {
			// encrypt value
			$value = $this->doEncrypt($value);
		}

		return $value;
	}

	/* encrypt data in array
	 * @param array: array with sql-query-data
	 *
	 * @return array or REDIRECT
	 */
	protected function encryptArray ($array) {

		// check, if is array
		if (!is_array($array)) {
			return $array;
		}
		if (isset($array['VALUES'])) {
			// get corresponding column
			if (isset($array['INSERT INTO'])) {
				// get array of insert into
				$corr_array = reset($array['INSERT INTO']);
			} elseif (isset($array['UPDATE'])) {
				$corr_array = reset($array['UPDATE']);
			} else {
				continue;
			}
			$corr_array = $corr_array['list'];
			ksort($corr_array);
			$corr_array = array_values($corr_array);

			// run through values
			foreach ($array['VALUES'] as $index => $values) {
				if (!isset($values['list']) or !is_array($values['list'])) continue;
				$counter = 0;
				foreach ($values['list'] as $in => $val) {
					if (isset($val['data'])) {
						// encrypt data
						$array['VALUES'][$index]['list'][$in]['data'] = $this->_encryptNameValue($corr_array[$counter], $val['data']);
					}
					// increase counter
					$counter++;
				}
			}
		}


		if (count($array) == 2) {

			foreach ($array as $index => $values) {
				if (is_array($values) AND isset($values['data']) AND substr($index, 5) == '=') {

					// get other index
					foreach ($array as $in => $val) {
						if ($in != $index) break;
					}

					// encrypt
					$array[$index]['data'] = $this->_encryptNameValue($array[$in], $values['data']);
				}
			}

			return $array;
		}

		// check, if data to encrypt
		if (isset($array['data'], $array['reference'])) {

			// get column-reference
			$cache = explode('.', $array['reference']);
			$reference = (isset($cache[1])) ? $cache[1] : $cache[0];

			// encrypt data
			$array['data'] = $this->_encryptNameValue($reference, $array['data']);
		}
		foreach ($array as $index => $values) {

			// skip columns
			$to_skip = array('VALUES', 'data');
			if (in_array($index, $to_skip)) continue;

			// get sub-arrays
			if (is_array($values)) {
				$array[$index] = $this->encryptArray($values);
			}
		}

		return $array;
	}

	/* encrypts a string
	 * @param array/string: string to encrypt
	 *
	 * @return string
 	 */
	private function doEncrypt ($data) {
		global $TSunic;
		if (!$TSunic->Usr) return $data;

		// get first value if array
		if (is_array($data)) $data = $data[0];

		// encrypt data
		$data = mysql_real_escape_string($TSunic->Usr->encrypt($data));

		return $data;
	}

	/* decrypts a string
	 * @param array: array with data to decrypt
	 *
	 * @return string
 	 */
	private function decrypt ($data) {
		global $TSunic;
		if (!$TSunic->Usr) return $data;

		// validate type
		if (!is_array($data)) return $data;

		// decrypt values
		foreach ($data as $index => $value) {
			foreach ($value as $in => $val) {

				// skip empty values
				if (empty($val)) continue;

				// decrypt value
				$return = $TSunic->Usr->decrypt($val);
				if ($return) $data[$index][$in] = $return;
			}
		}

		return $data;
	}
}
?>
