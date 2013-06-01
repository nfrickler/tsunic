<!-- | CLASS ts_Database_mysql -->
<?php
/**
 * Database class for MySQL database
 */
class ts_Database_mysql {

    /** Host of MySQL database
     * @var string $host
     */
    private $host;

    /** MySQL error message
     * @var string $error
     */
    private $error;

    /** User of MySQL database
     * @var string $user
     */
    private $user;

    /** Password of MySQL database
     * @var string $password
     */
    private $password;

    /** Database name of MySQL database
     * @var string $database
     */
    private $database;

    /** Connection cache
     * @var array $con
     */
    private $con;

    /** Constructor
     * @param string $host
     *  Host of MySQL database
     * @param string $user
     *  User of MySQL database
     * @param string $password
     *  Password of MySQL database
     * @param string $database
     *  Database name of MySQL database
     */
    public function __construct ($host, $user, $password, $database) {

	// save parameters
	$this->host = $host;
	$this->user = $user;
	$this->password = $password;
	$this->database = $database;

	// connect to database
	$this->doConnect();
    }

    /** Return MySQL error (return false, if no error occurred)
     *
     * @return bool
     */
    public function getError () {

	// is error?
	if (empty($this->error)) return '';

	return $this->error;
    }

    /** Check, if connection exists AND connect to database
     *
     * @return bool
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

    /** Send query to database
     * @param string $sql
     *	Sql query
     *
     * @return mysql-result|false
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

    /** Fetch data from database
     * @param string $sql
     *	Sql query
     *
     * @return array|false
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

    /** Update database
     * @param string $sql
     *	Sql query
     *
     * @return bool
     */
    public function doUpdate ($sql) {

	// update table by sending query
	return ($this->sendQuery($sql)) ? true : false;
    }

    /** Insert a new row/several new rows
     * @param string $sql
     *	Sql query
     *
     * @return bool
     */
    public function doInsert ($sql) {

	// insert rows by sending query
	if ($this->sendQuery($sql)) {
	    return mysql_insert_id();
	}
	return false;
    }

    /** Delete rows in database
     * @param string $sql
     *	Sql query
     *
     * @return bool
     */
    public function doDelete ($sql) {
	// delete rows by sending query
	return ($this->sendQuery($sql)) ? true : false;
    }

    /** Get names of columns of a table
     * @param string $table
     *	Name of table
     *
     * @return array|false
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

    /** Create a new table
     * @param string $sql
     *	Sql query
     *
     * @return bool
     */
    public function createTable ($sql) {

	// create table by sending query
	if (!($result = $this->sendQuery($sql))) return false;
	return true;
    }

    /** Check, if table exists
     * @param string $table
     *	Name of table
     *
     * @return bool
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

    /** Get all tables in database
     *
     * @return bool
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

    /** Run sql file
     * @param string $path
     *	Path to sql file
     *
     * @return bool
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
