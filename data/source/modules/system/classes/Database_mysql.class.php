<!-- | mysql-class -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Database_mysql.class.php
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
	 * @param string $host: mysql-login: host
	 * @param string $user: mysql-login: user
	 * @param string $password: mysql-login: password
	 * @param string $database: mysql-login: database
	 *
	 * @return OBJECT
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
	 * @param string $sql: sql-query
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
	 * @param string $sql: sql-query
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
	 * @param string $sql: sql-query
	 *
	 * @return bool
	 */
	public function doUpdate ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* insert a new row/several new rows
	 * @param string $sql: sql-query
	 *
	 * @return bool
	 */
	public function doInsert ($sql) {
	    return ($this->_sendQuery($sql)) ? true : false;
	}

	/* delete rows in database
	 * @param string $sql: sql-query
	 *
	 * @return bool
	 */
	public function doDelete ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* just send query as is and return result
	 * @param string $sql: sql-query
	 *
	 * @return bool
	 */
	public function doQuery ($sql) {
		return $this->_sendQuery($sql);
	}

	/* get names of columns of a table
	 * @param string $table: name of table to get columns from
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
	 * @param string $sql: sql-query
	 *
	 * @return bool
	 */
	public function createTable ($sql) {
		return ($this->_sendQuery($sql)) ? true : false;
	}

	/* check, if table exists
	 * @param string $table: name of table
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