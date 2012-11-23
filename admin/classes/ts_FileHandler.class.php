<!-- | class to handle files and folders -->
<?php
// static
class ts_FileHandler {

    /* get subfolders
     * @param string: path to basis-folder
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
	    if ($thefile == '.' OR $thefile == '..' OR !is_dir("$path/$thefile")) continue;
	    $subfolders[] = $thefile;
	}
	closedir($openfolder);

	return $subfolders;
    }

    /* get files within folder
     * @param string: path to basis-folder
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
     * @param string: path of source-folder
     * @param string: path of destination-folder (will be created, if nonexistent)
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

    /* move file to other destination
     * @param string: path of source file
     * @param string: path of destination file
     *
     * @return bool
     */
    public function moveFile ($source, $destination) {
	if (!file_exists($source)) return false;
	return copy($source, $destination);
    }

    /* delete folder and all it's subfolders and -files
     * @param string: path of folder to delete
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
     * @param string: path of folder to empty
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
     * @param string: absolute path of folder
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
	    $to_remove = substr(strrchr($current, '/'),1);
	    $to_add[] = $to_remove;
	    $current = substr($current, 0, (strlen($current) - strlen($to_remove) - 1));
	}

	// create missing folders
	$to_add = array_reverse($to_add);
	foreach ($to_add as $index => $value) {
	    $current.= '/'.$value;
	    if (!is_dir($current) and !mkdir($current)) {
		die('Could not create folder '.$current);
		return false;
	    }
	}

	return true;
    }

    /* write content to file
     * @param string: path of file
     * @param string: content to write to file
     * +@param int: new file without overwriting
     *	      new file or overwriting
     *	      append to file
     *
     * @return bool
     */
    public function writeFile ($path, $content, $mode = 0) {

	// overwrite?
	if (file_exists($path) AND !$mode) return false;

	// create folder
	$path_folder = substr($path, 0, (strlen($path) - strlen(basename($path)) - 1));
	self::createFolder($path_folder);

	// open file
	$filemode = ($mode == 1 or !file_exists($path)) ? "w" : "a";
	$file = fopen($path, $filemode);

	// write content to file
	if (!$file OR (fwrite($file, $content)) === false) return false;

	// close file
	fclose($file);

	return true;
    }

    /* read content of file
     * @param string: path of file
     * +@param bool: return content as array of lines?
     *
     * @return bool
     */
    public function readFile ($path, $as_array = false) {

	// overwrite?
	if (!file_exists($path)) return ($as_array) ? array() : '';

	// read file
	$content = file($path);

	// return
	return ($as_array) ? $content : trim(implode('', $content));
    }
}
