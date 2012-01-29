<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_BackupHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle backups
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

// static
class ts_BackupHandler {

	/* backup module
	 * @param string $path: path to module to backup
	 * +@param string $name: name to attach to the end of destination-folder	 
	 *
	 * @return array
	 */
	public function backupModule ($path, $name = false) {
		global $Config;

		// create new path
		$cache = explode('/', $path);
		if (empty($name)) $name = end($cache);
		$path_new = $Config->getRoot(true).'/backup/modules/'.date('Y_m_d__H_i_s').'__'.$name;

		// move folder to backup-directory
		if (ts_FileHandler::copyFolder($path, $path_new)) return true;
		return false;
	}


	/* backup style
	 * @param string $path: path to style to backup
	 * +@param string $name: name to attach to the end of destination-folder	 
	 *
	 * @return array
	 */
	public function backupStyle ($path, $name = false) {
		global $Config;

		// create new path
		$cache = explode('/', $path);
		if (empty($name)) $name = end($cache);
		$path_new = $Config->getRoot(true).'/backup/styles/'.date('Y_m_d__H_i_s').'__'.$name;

		// move folder to backup-directory
		if (ts_FileHandler::copyFolder($path, $path_new)) return true;
		return false;
	}

	/* backup runtime-folder
	 * @param bool $includeDatabase: also backup database
	 *
	 * @return array
	 */
	public function backupRuntime ($includeDatabase = false) {
		global $Config, $Database;

		// create paths
		$path = $Config->getRoot(false).'/runtime';
		$path_new = $Config->getRoot(true).'/backup/runtime/'.date('Y_m_d__H_i_s');

		// move folder to backup-directory
		if (!ts_FileHandler::copyFolder($path, $path_new)) return false;

		// backup database
		//TODO - skip database-backup (creates too big sql-file!)
		if ($includeDatabase) {

			// get path for sql-backup
			$path_sql = $path_new.'/backup_database.sql';

			// backup database
		//	if (!self::backupDatabase($path_sql)) return false;
		}

		// get number of backups
		$path = $Config->getRoot(true).'/backup/runtime';
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

	/* ######################### database backup ############################ */

	/* backup database
	 * @param string $path: path to sql backup-file
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
