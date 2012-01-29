<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_FileHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle files
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
class ts_FileHandler {

	/* get subfolders
	 * @param string $path: path to basis-folder
	 *
	 * @return array
	 */
	public function getSubfolders ($path) {
		$subfolders = array();

		// validate input
		if (!is_dir($path)) return array();

		// get subfolders
		$openfolder = opendir($path);
		while ($thefile = readdir($openfolder)) {
			if ($thefile == '.' OR $thefile == '..' OR !is_dir($path.'/'.$thefile)) continue;
			$subfolders[] = $thefile;
		}
		closedir($openfolder);

		return $subfolders;
	}

	/* get files within folder
	 * @param string $path: path to basis-folder
	 *
	 * @return array
	 */
	public function getSubfiles ($path) {
		$subfiles = array();

		// validate input
		if (!is_dir($path)) return array();

		// get subfiles
		$openfolder = opendir($path);
		while ($thefile = readdir($openfolder)) {
			if ($thefile == '.' OR $thefile == '..' OR is_dir($path.'/'.$thefile)) continue;
			$subfiles[] = $thefile;
		}
		closedir($openfolder);

		return $subfiles;
	}

	/* move folder including all it subfolders and -files
	 * @param string $source: path of source-folder
	 * @param string $destination: path of destination-folder (will be created, if nonexistent)	 
	 *
	 * @return bool
	 */
	public function copyFolder ($source, $destination, $files_only = false, $preffix = false) {

		// check source and destination-folders
		if (!is_dir($source)) return true;
		if (!is_dir($destination) AND !self::createFolder($destination)) return false;

		// move all subfiles
		$subfiles = self::getSubfiles($source);
		foreach ($subfiles as $index => $value) {
			$dst_name = (!empty($preffix)) ? $preffix.$value : $value;
			copy($source.'/'.$value, $destination.'/'.$dst_name);
		}

		// move all subfolders
		if (!$files_only) {
			$subfolders = self::getSubfolders($source);
			foreach ($subfolders as $index => $value) {
				if (!self::copyFolder($source.'/'.$value, $destination.'/'.$value))
					return false;
			}
		}

		return true;
	}

	/* delete folder and all it's subfolders and -files
	 * @param string $path: path of folder to delete
	 *
	 * @return bool
	 */
	public function deleteFolder ($path) {

		// does source exist?
		if (!is_dir($path)) return true;

		// empty folder
		if (!self::emptyFolder($path)) return false;

		// delete folder
		if (!@rmdir($path)) return false;

		return true;
	}

	/* empty folder and delete all it's subfolders and -files
	 * @param string $path: path of folder to empty
	 *
	 * @return bool
	 */
	public function emptyFolder ($path) {

		// does source exist?
		if (!is_dir($path) OR !is_dir($path)) return true;

		// remove all subfiles
		$subfiles = self::getSubfiles($path);
		foreach ($subfiles as $index => $value) {
			@unlink($path.'/'.$value);
		}

		// remove all subfolders
		$subfolders = self::getSubfolders($path);
		foreach ($subfolders as $index => $value) {
			if (!self::deleteFolder($path.'/'.$value)) return false;
		}

		return true;
	}

	/* create folder, if not exists
	 * @param string $path: absolute path of folder
	 *
	 * @return bool
	 */
	public function createFolder ($path) {

		// is folder?
		if (is_dir($path)) return true;

		// get all single folders
		$folders = explode('/', $path);

		// get last existing folder
		$current = $path;
		$to_add = array();
		while (!empty($current)) {

			// is path?
			if (is_dir($current)) break;

			// cut current
			$to_add[] = substr(strrchr($current, '/'),1);
			$to_remove = substr(strrchr($current, '/'),1);
			$to_add[] = $to_remove;
			$current = substr($current, 0, (strlen($current) - strlen($to_remove) - 1));
		}

		// create missing folders
		$to_add = array_reverse($to_add);
		foreach ($to_add as $index => $value) {
			$current.= '/'.$value;

			if (!is_dir($current) AND !mkdir($current)) {
				die('Could not create folder '.$current);
				return false;
			}
		}

		return true;
	}

	/* convert path to relative path
	 * @param string $path: path to file
	 * @param string $content: content to write to file
	 * +@param bool $overwrite: overwrite, if file exists 	 
	 *
	 * @return bool
	 */
	public function getRelative ($path) {
		global $Config;

		$path_root = $Config->get('root_folder');
		if (substr($path, 0, strlen($path_root)) == $path_root) {
			$path = '..'.substr($path, strlen($path_root));
		}

		return $path;
	}

	/* write content to file
	 * @param string $path: path to file
	 * @param string $content: content to write to file
	 * +@param bool $overwrite: overwrite, if file exists 	 
	 *
	 * @return bool
	 */
	public function writeFile ($path, $content, $overwrite = false) {

		// get relative path
		$path = self::getRelative($path);

		// overwrite?
		if (file_exists($path) AND !$overwrite) return false;

		// does folder exists?
		$path_folder = substr($path, 0, (strlen($path) - strlen(basename($path)) - 1));
		self::createFolder($path_folder);

		// open file
		$file = fopen($path, "w");

		// write content in file
		if (!$file OR (fwrite($file, $content)) === false) return false;

		// close file
		fclose($file);

		return true;
	}

	/* read content of file
	 * @param string $path: path to file	 
	 *
	 * @return bool
	 */
	public function readFile ($path, $as_array = false) {

		// overwrite?
		if (!file_exists($path)) return ($as_array) ? array() : '';

		// open file
		$content = file($path);

		// return
		return ($as_array) ? $content : trim(implode('', $content));
	}
}
