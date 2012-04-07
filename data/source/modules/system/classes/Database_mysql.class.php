<!-- | mysql-class -->
<?php
class $$$Database_mysql {

	/* mysql-login: host
	 * string
	 */
	private $host;

	/* mysql-login: user
	 * string
	 */
	private $user;

	/* mysql-login: password
	 * string
	 */
	private $password;

	/* mysql-login: name of database
	 * string
	 */
	private $database;

	/* current connection
	 *
	 */
	private $con;

	/* constructor
	 * @param string: mysql-login: host
	 * @param string: mysql-login: user
	 * @param string: mysql-login: password
	 * @param string: mysql-login: database
	 */
	public function __construct ($host, $user, $password, $database) {

		// save parameters
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;

		// connect to database
		$this->doConnect();

		return;
	}

	/* check, if connection exists OR connect to database
	 *
	 * @return bool
	 */
	private function doConnect () {
		global $TSunic;

		// already connected?
		if (!empty($this->con) AND @mysql_ping($this->con)) return true;

		// connect to database
		$this->con = @mysql_connect($this->host, $this->user, $this->password);
		if ($this->con) $db = @mysql_select_db($this->database);

		// handle errors
		if (!$this->con OR !$db) {
			$TSunic->Log->add('error', 'Couldn\'t connect to Mysql-Database! Error:"'.mysql_error().'"!', 1);
			return false;
		}

		return true;
	}

	/* send query to database
	 * @param string: sql-query
	 *
	 * @return mysql-result
	 */
	private function _sendQuery ($sql) {

		// connect to database
		if (!$this->doConnect()) return false;

		// send query
		$result = @mysql_query($sql);

		return $result;
	}

	/* fetch data from database
	 * @param string: sql-query
	 *
	 * @return array/bool
	 */
	public function doSelect ($sql) {

		// fetch data from database via query
		$result = $this->_sendQuery($sql);
		if (!$result) return false;

		// sum output in array
		$output = array();
		while ($row = mysql_fetch_assoc($result)) $output[] = $row;

		return $output;
	}

	/* update database
	 * @param string: sql-query
	 *
	 * @return bool
	 */
	public function doUpdate ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* insert a new row/several new rows
	 * @param string: sql-query
	 *
	 * @return bool
	 */
	public function doInsert ($sql) {
	    return ($this->_sendQuery($sql)) ? true : false;
	}

	/* delete rows in database
	 * @param string: sql-query
	 *
	 * @return bool
	 */
	public function doDelete ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* just send query as is and return result
	 * @param string: sql-query
	 *
	 * @return bool
	 */
	public function doQuery ($sql) {
		return $this->_sendQuery($sql);
	}

	/* get names of columns of a table
	 * @param string: name of table to get columns from
	 *
	 * @return array/bool
	 */
	public function getColumns ($table) {

		// get columns
		$sql = "SHOW COLUMNS FROM ".mysql_real_escape_string($table).";";
		$result = $this->_sendQuery($sql);
		if (!$result) return false;

		// put return in array
		$columns = array();
		while ($arr = mysql_fetch_assoc($result)) $columns[] = $arr['Field'];

		return $columns;
	}

	/* create a new table
	 * @param string: sql-query
	 *
	 * @return bool
	 */
	public function createTable ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* check, if table exists
	 * @param string: name of table
	 *
	 * @return bool
	 */
	public function isTable ($table) {

	    // get and send query
		$sql = "SHOW TABLES LIKE '".mysql_real_escape_string($table)."';";
		$result = $this->_sendQuery($sql);

		// check, if table exists
		if ($result AND mysql_num_rows($result) > 0)
			//table exists
			return true;
		else
			//table doesn't exist
			return false;
	}

	/* check, if database-object is operating correctly
	 *
	 * @return bool
	 */
	public function isValid () {
		if ($this->doConnect()) return true;
		return false;
	}

	/* get mysql-error
	 *
	 * @return bool/array
	 */
	public function getError () {

		// try to get error
		$output = @mysql_error();

		if (empty($output)) return false;
		return $output;
	}
}
?>
