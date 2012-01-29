<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_Database_mysql.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle mysql-database
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

class ts_Database_mysql {

	/* mysql-login: host
	 * string
	 */
	private $host;

	/* error message
	 * string
	 */
	private $error;

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

	/* db-identifier (cache)
	 *
	 */
	private $con;

	/* constructor
	 * @param string $host: mysql-login: host
	 * @param string $user: mysql-login: user
	 * @param string $password: mysql-login: password
	 * @param string $database: mysql-login: database
	 * @param string $table_pref: preffix of all TSunic-tables
	 *
	 * @return bool: true - success
	 * 				 false - error
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

	/* return mysql-error (return false, if no error occurred)
	 *
	 * @return bool/string
	 */
	public function getError () {

		// is error?
		if (empty($this->error)) return false;

		// return error
		return $this->error;
	}

	/* check, if connection exists AND connect to database
	 *
	 * @return bool
	 * 		   (OR @return bool: false - error)
	 */
	private function doConnect () {

		if (!empty($this->con) AND mysql_ping($this->con)) {
			// connection exists
			return true;
		}

		// connect to database
		$this->con = @mysql_connect($this->host, $this->user, $this->password);
		if ($this->con) $db = @mysql_select_db($this->database);

		// return errors
		if (!$this->con OR !$db) {
			$this->error = 'Connecting to database failed: '.mysql_error();
			return false;
		}

		return true;
	}

	/* send query to database
	 * @param string $sql: sql-query
	 *
	 * @return mysql-result
	 * 		   (OR @return bool: false - error)
	 */
	public function sendQuery ($sql) {
		global $TSunic;

		// connect to database
		$this->doConnect();

		// send query
		$result = mysql_query($sql);

		if (!empty($result)) {
			return $result;
		}

		die('Error: '.mysql_error());
	}

	/* fetch data from database
	 * @param string $sql: sql-query
	 *
	 * @return array: data of query
	 * 		   (OR @return bool: false - error)
	 */
	public function doSelect ($sql) {

		// fetch data from database via query
		if (!($result = $this->sendQuery($sql)) OR !$result) return false;

		// sum output in array
		$data = Array();
		while ($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}

		return $data;
	}

	/* update database
	 * @param string $sql: sql-query
	 *
	 * @return bool: true - success
	 * 				 false - error
	 */
	public function doUpdate ($sql) {

	    // update table by sending query
		return ($this->sendQuery($sql)) ? true : false;
	}

	/* insert a new row/several new rows
	 * @param string $sql: sql-query
	 *
	 * @return bool: true - success
	 * 				 false - error
	 */
	public function doInsert ($sql) {

	    // insert rows by sending query
	    if ($this->sendQuery($sql)) {
			return mysql_insert_id();
		}
		return false;
	}

	/* delete rows in database
	 * @param string $sql: sql-query
	 *
	 * @return bool: true - success
	 * 				 false - error
	 */
	public function doDelete ($sql) {

	    // delete rows by sending query
		return ($this->sendQuery($sql)) ? true : false;
	}

	/* get names of columns of a table
	 * @param string $table: name of table
	 *
	 * @return array: names of columns
	 * 		   (OR @return bool: false - error)
	 */
	public function getColumns ($table) {

		// get columns
		$sql = "SHOW COLUMNS FROM $table";
		if (!($result = $this->sendQuery($sql))) return false;

		// put return in array
		$columns = array();
		while ($arr = mysql_fetch_assoc($result)) {
			$columns[] = $arr["Field"];
		}

		return $columns;
	}

	/* create a new table
	 * @param string $sql: sql-query
	 *
	 * @return bool: true - success
	 * 				 false - error
	 */
	public function createTable ($sql) {

		// create table by sending query
		if (!($result = $this->sendQuery($sql))) return false;
		return true;
	}

	/* check, if table exists
	 * @param string $table: name of table
	 *
	 * @return bool: true - table exists
	 * 				 false - no table with the given name found
	 */
	public function isTable ($table) {

	    // get and send query
		$sql = "SHOW TABLES LIKE '".mysql_real_escape_string($table)."';";
		$result = $this->sendQuery($sql);

		// check, if table exists
		if (mysql_num_rows($result) > 0)
			//table exists
			return true;
		else
			//table doesn't exist
			return false;
	}

	/* get all tables in database
	 *
	 * @return bool: true - table exists
	 * 				 false - no table with the given name found
	 */
	public function getTables () {

	    // get and send query
		$sql = "SHOW TABLES;";
		$result = $this->sendQuery($sql);

		// get all tables in array
		$tables = array();
		while (list($current) = mysql_fetch_row($result)) {
			$tables[] = $current;
    	}

		return $tables;
	}

	/* run sql-file
	 * @param string $path: path to sql-file
	 *
	 * @return bool: true - success
	 * 				 false - error
 	 */
	public function insertSQL ($path) {

		// get content of file and skip comments
		$content = file_get_contents($path);
		$content = preg_replace ("%/\*(.*)\*/%Us", '', $content);
		$content = preg_replace ("%^--(.*)\n%mU", '', $content);
		$content = preg_replace ("%^$\n%mU", '', $content);

		// get querys
		$queries = explode(';', $content);

		// send queries
		foreach ($queries as $index => $sql) {
			$sql = trim($sql);
			if (empty($sql)) continue;
			if (!$this->TSunic->mysql->sendQuery($sql)) {
				return false;
			}
		}

		return true;
	}
}
?>