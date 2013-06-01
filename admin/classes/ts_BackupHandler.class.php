<!-- | CLASS ts_BackupHandler -->
<?php
/**
 * Static backup handler
 * Currently not in use!
 */
class ts_BackupHandler {

    /** Backup module
     * @param string $path
     *	Path to module to backup
     * @param string $name
     *	Name to attach to the end of destination-folder
     *
     * @return array
     */
    public function backupModule ($path, $name = false) {
	global $Config;

	// create new path
	$cache = explode('/', $path);
	if (empty($name)) $name = end($cache);
	$path_new = $Config->get('dir_data').'/backup/modules/'.date('Y_m_d__H_i_s').'__'.$name;

	// move folder to backup-directory
	if (ts_FileHandler::copyFolder($path, $path_new)) return true;
	return false;
    }

    /** Backup style
     * @param string $path
     *	Path to style to backup
     * @param string $name
     *	Name to attach to the end of destination-folder
     *
     * @return array
     */
    public function backupStyle ($path, $name = false) {
	global $Config;

	// create new path
	$cache = explode('/', $path);
	if (empty($name)) $name = end($cache);
	$path_new = $Config->get('dir_data').'/backup/styles/'.date('Y_m_d__H_i_s').'__'.$name;

	// move folder to backup-directory
	if (ts_FileHandler::copyFolder($path, $path_new)) return true;
	return false;
    }

    /** Backup runtime folder
     * @param bool $includeDatabase
     *	Backup database, too?
     *
     * @return array
     */
    public function backupRuntime ($includeDatabase = false) {
	global $Config, $Database;

	// create paths
	$path = $Config->get('dir_runtime');
	$path_new = $Config->get('dir_data').'/backup/runtime/'.date('Y_m_d__H_i_s');

	// move folder to backup-directory
	if (!ts_FileHandler::copyFolder($path, $path_new)) return false;

	// backup database
	//TODO - skip database-backup (creates too big sql-file!)
	if ($includeDatabase) {

	    // get path for sql-backup
	    $path_sql = $path_new.'/backup_database.sql';

	    // backup database
	//    if (!self::backupDatabase($path_sql)) return false;
	}

	// get number of backups
	$path = $Config->get('dir_data').'/backup/runtime';
	$backups = ts_FileHandler::getSubFolders($path);
	rsort($backups);

	$counter = 0;
	foreach ($backups as $index => $value) {
	    $counter++;
	    if ($counter >= 10) {
		// delete backup
		ts_FileHandler::deleteFolder($path.'/'.$value);
	    }
	}

	return true;
    }

    /* ######################### database backup ######################## */

    /** Backup database
     * @param string $path
     *	Path to sql backup file
     *
     * @return bool
     */
    public function backupDatabase ($path) {
	global $Database;

	// get all tables
	$tables = $Database->getTables();
	if (!$tables OR empty($tables)) return true;

	// backup
	$sql_tables = implode(',', $tables);
	$sql_0 = "SELECT *
		INTO OUTFILE '".$path."'
		FIELDS TERMINATED BY ';'
		FROM ".$sql_tables.";";
	$result_0 = $Database->doQuery($sql_0);

	return true;
    }
}
?>
