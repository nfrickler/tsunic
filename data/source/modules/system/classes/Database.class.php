<!-- | CLASS Database -->
<?php
/** Handle database access
 *
 * This object handles the access to the chosen database. One instance of this
 * class is available at TSunic::Db
 */
class $$$Database {

    /** Database object of chosen type
     * @var object $Db_obj
     */
    private $Db_obj;

    /** Constructor
     */
    public function __construct () {
	global $TSunic;

	// get connection-data
	$db_class = $TSunic->Config->get('db_class');
	$host = $TSunic->Config->get('db_host');
	$user = $TSunic->Config->get('db_user');
	$pass = $TSunic->Config->get('db_pass');
	$database = $TSunic->Config->get('db_database');

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

	return;
    }

    /* ######################### queries ################################ */

    /** Method to send SELECT query to database
     *
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    public function doSelect ($query) {
	return $this->_callDatabase('select', $query);
    }

    /** Method to send INSERT query to database
     *
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    public function doInsert ($query) {
	if (!$this->_callDatabase('insert', $query)) return false;
	$lastId = $this->_callDatabase('lastId');
	return ($lastId) ? $lastId : true;
    }

    /** Method to send UPDATE query to database
     *
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    public function doUpdate ($query) {
	return $this->_callDatabase('update', $query);
    }

    /** Method to send DELETE query to database
     *
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    public function doDelete ($query) {
	return $this->_callDatabase('delete', $query);
    }

    /** Method to send CREATE TABLE query to database
     *
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    public function createTable ($query) {
	return $this->_callDatabase('createTable', $query);
    }

    /** Method to get columns of table
     *
     * @param string $table
     *	Name of table
     *
     * @return array
     */
    public function getColumns ($table) {
	return $this->_callDatabase('getColumns', $table);
    }

    /** Method to check, if table of certain name exists
     *
     * @param string $table
     *	Name of table
     *
     * @return bool
     */
    public function isTable ($table) {
	return $this->_callDatabase('isTable', $table);
    }

    /** "execute" a sql-file
     *
     * @param string $path
     *	Path of SQL file
     *
     * @return bool
     */
    public function runFile ($path) {
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

    /** Parse SQL query for database
     *
     * @param string $type
     *	Type of query
     * @param string $query
     *	SQL query
     *
     * @return mix
     */
    private function _callDatabase ($type, $query = '') {
	global $TSunic;

	// start timer
	if (!empty($TSunic) AND is_object($TSunic)) {
	    if (isset($TSunic->Log)) $TSunic->Log->log(9, "Database: $query");
	    $TSunic->Stats->startTimer('mysql');
	}

	// query Database by type
	switch ($type) {
	    case 'select':
		$return = $this->Db_obj->doSelect($query);
		break;
	    case 'insert':
		$return = $this->Db_obj->doInsert($query);
		break;
	    case 'lastId':
		$return = $this->Db_obj->lastId();
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

	    // when called from Session-object there might be no TSunic object
	    // anymore...
	    if ($TSunic and $TSunic->Log) {
		$TSunic->Log->log(3, '$$$Database: Database error: "'.$this->Db_obj->getError().'" (query: '.$query.')"');
		$TSunic->Log->alert('error', '{CLASS__DATABASE__ERROR}');
	    } else {
		die("Database error (SESSION): ".$this->Db_obj->getError());
	    }
	}
	if ($return === false) {
	    if ($TSunic and $TSunic->Log) {
		$TSunic->Log->log(2, '$$$Database: Critical database error: "'.$this->Db_obj->getError().'" (query: '.$query.')"');
		$TSunic->throwError('{CLASS__DATABASE__CRITICAL_ERROR}');
	    }
	    die("Critical database error (SESSION)");
	}

	return $return;
    }
}
?>
