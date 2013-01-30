<!-- | Class to handle database -->
<?php
class ts_Database {

    /* database object of chosen type
     * object
     */
    private $Db_obj;

    /* preffix of all TSunic-tables
     * string
     */
    private $table_pref;

    /* constructor
     */
    public function __construct () {
	global $Config;

	// get connection-data
	$db_class = $Config->get('db_class');
	$host = $Config->get('db_host');
	$user = $Config->get('db_user');
	$pass = $Config->get('db_pass');
	$database = $Config->get('db_database');
	$this->table_pref = $Config->get('preffix');

	// validate input
	if (empty($db_class) OR empty($host) OR empty($user) OR empty($database) OR $pass === NULL) {
	    // no valid input
	    return;
	}

	// get object for chosen type of database
	$path = 'classes/ts_Database_'.$db_class.'.class.php';
	if (!file_exists($path)) die('Selected database-class does not exist!');
	include_once $path;
	$to_eval = '$this->Db_obj = new ts_Database_'.$db_class.'("'.$host.'", "'.$user.'", "'.$pass.'", "'.$database.'");';
	if ((eval($to_eval) === false) OR !$this->Db_obj) {
	    die('Invalid Database-class selected!');
	    return;
	}

	// error occurred?
	if ($this->Db_obj->getError()) {
	    $_SESSION['admin_error'] = $this->Db_obj->getError();
	}

	return;
    }

    /* get table preffix
     *
     * @return string
     */
    public function getPreffix () {
	return $this->table_pref;
    }

    /* parse query
     * @param string: sql-query
     *
     * @return sql-query
     *     (OR @return bool: false - error)
      */
    protected function _parseQuery ($sql) {

	// replace preffix
	$sql = str_replace('#__', $this->table_pref, $sql);

	return $sql;
    }

    /* return mysql-error (return false, if no error occurred)
     *
     * @return bool/string
     */
    public function getError () {
	return $this->Db_obj->getError();
    }

    /* get Data from database
     * @param string: sql-query
     * @param bool(optional): throw exception?
     *
     * @return array: result of query
     *     (or REDIRECT)
      */
    public function doSelect ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	// send request to database
	$return = $this->Db_obj->doSelect($this->_parseQuery($sql));

	// return
	return $this->getReturn($return, $error);
    }

    /* update database
     * @param string: sql-query
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function doUpdate ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	// send request to database
	$return = $this->Db_obj->doUpdate($this->_parseQuery($sql));

	// return
	return $this->getReturn($return, $error);
    }

    /* insert rows in database
     * @param string: sql-query
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function doInsert ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	// send request to database
	$return = $this->Db_obj->doInsert($this->_parseQuery($sql));

	// return
	return $this->getReturn($return, $error);
    }

    /* delete rows in database
     * @param string: sql-query
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function doDelete ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	$return = $this->Db_obj->doDelete($this->_parseQuery($sql));

	// return
	return $this->getReturn($return, $error);
    }

    /* just query database
     * @param string: sql-query
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function doQuery ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	// send request to database
	$return = $this->Db_obj->doUpdate($this->_parseQuery($sql));

	// return
	return $this->getReturn($return, $error);
    }

    /* check, if table exists
     * @param string: name of table
     * +@param bool: throw exception?
     *
     * @return array: result of query
     *     (or REDIRECT)
      */
    public function isTable ($table, $error = false) {

	// is running database?
	if (!$this->Db_obj) return false;

	return $this->getReturn($this->Db_obj->isTable($this->_parseQuery($table)), $error);
    }

    /* get all tables of database
     * +@param bool: get only tables of tsunic
     * +@param bool: throw exception?
     *
     * @return array or REDIRECT
      */
    public function getTables ($tsunic_only = true, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	$tables = $this->getReturn($this->Db_obj->getTables(), $error);
	if (!$tables) return false;

	// tsunic only?
	if ($tsunic_only) {
	    $tables_tsonly = array();
	    foreach ($tables as $index => $value) {
		if (substr($value, 0, strlen($this->table_pref)) == $this->table_pref) {
		    // add
		    $tables_tsonly[] = $value;
		}
	    }
	    $tables = $tables_tsonly;
	}

	return $tables;
    }

    /* get number of columns from database
     * @param string: table of which columns shall be returned
     * +@param bool: throw exception?
     *
     * @return array: column-names
     *     (or REDIRECT)
      */
    public function getColumns ($table, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	return $this->getReturn($this->Db_obj->getColumns($table), $error);
    }

    /* create a new table
     * @param string: sql-query
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function createTable ($sql, $error = true) {

	// is running database?
	if (!$this->Db_obj) return false;

	return $this->getReturn($this->Db_obj->createTable($sql), $error);
    }

    /* "execute" a sql-file
     * @param string: path to sql-file
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function runFile ($path) {

	// is database sub-object?
	if (!$this->Db_obj) return false;

	// is file?
	if (!file_exists($path)) return false;

	// load content of file
	$content = file($path);
	$content = implode(' ', $content);

	return $this->runString($content);
    }

    /* "execute" a sql-string (e.g. from a file)
     * @param string: string with sql statements
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function runString ($content) {

	// is database sub-object?
	if (!$this->Db_obj) return false;

	// is string?
	if (empty($content)) return false;

	// strip comments
	$content = preg_replace('#(\<\!--.*--\>)#Usi', '', $content);

	// replace prefix
	$content = str_replace('#__', $this->table_pref, $content);

	// split by ;
	$cache = explode(';', $content);

	// split and run all queries in a row
	foreach ($cache as $index => $value) {
	    $value = trim($value);
	    if (empty($value)) continue;
	    $return = $this->doInsert($value);
	}

	// return
	return $this->getReturn($return);
    }

    /* get return-value or redirect
     * @param mix: returned value of functions above (insert/delete etc.)
     * +@param bool: throw exception?
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    private function getReturn ($return, $error = false) {

	if ($error === true AND $return === false) {
	    // add error
	    die('Internal database-error!');
	}

	return $return;
    }

    /* export tables of database (or all tables)
     * @param array/bool: tables to be exported (true will export all)
     *
     * @return bool: true - success
     *     (or REDIRECT)
      */
    public function export ($tables) {
	$output = '';

	// TODO

	return $output;
    }
}
?>
