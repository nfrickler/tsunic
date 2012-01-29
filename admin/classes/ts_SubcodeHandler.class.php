<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_SubcodeHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; parse subcodes
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

class ts_SubcodeHandler {

	/* array containing all subfunctions
	 * array
	 */
	private $subcodes;

	/* cache-array
	 * array
	 */
	private $cache;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		// init
		$this->subcodes = array();

		return;
	}

	/* add subcodes
	 * @param string $input: subcodes to add (xml-content of subcode-file)
	 *
	 * @return bool
	 */
	public function add ($input) {
		global $Parser;
		$this->cache = array();

		// parse infos
		$input = preg_replace_callback('#\[(sub.*)\]#Usi', array($this, '_addCb'), $input);

		// split
		$cache = explode('[sub]', $input);
		for ($i = 1; $i <= count($cache); $i++) {

			// validate
			if (!isset($this->cache[($i-1)])) continue;
			if (empty($cache[$i])) continue;

			// replace module
			$cache[$i] = $Parser->replaceModule($cache[$i]);

			// save content
			if (!isset($this->subcodes[$this->cache[($i-1)]['path']])) $this->subcodes[$this->cache[($i-1)]['path']] = array();
			if (!isset($this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']])) $this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']] = array();
			$this->subcodes[$this->cache[($i-1)]['path']][$this->cache[($i-1)]['line']][] = $cache[$i];
		}

		return true;
	}

	/* add subcodes (callback)
	 * @param array $input: input from callback-function
	 *
	 * @return bool
	 */
	private function _addCb ($input) {
		global $Parser, $Config;
		$cache = array();
		$input = substr($input[0], 1, (strlen($input[0])-2));

		// split
		$cache = explode(':', $input);
		if ($cache < 3) return false;

		// get full path
		$cache[1] = $Parser->replaceModule($cache[1]);

		// save in cache
		$this->cache[] = array('path' => $Config->getRoot().'/runtime/'.$cache[1],
							   'line' => $cache[2]);

		return '[sub]';
	}

	/* inject all subcodes and complete file-rendering
	 * +@param string/bool $path: path to folder in which all files (also in subfolders) will be parsed
	 * 								false will parse all needed folders 
	 *
	 * @return bool
	 */
	public function parseAll ($path = false) {
		global $Config, $Parser;

		// run all?
		if ($path == false) {
			if ($this->parseAll($Config->getRoot().'/runtime/functions')
				AND $this->parseAll($Config->getRoot().'/runtime/classes')
				AND $this->parseAll($Config->getRoot().'/runtime/templates')
				) {
				return true;
			}
			return false;
		}

		// validate path
		if (!is_dir($path)) return false;

		// parse all files
		$subfiles = ts_FileHandler::getSubfiles($path);
		foreach ($subfiles as $index => $value) {

			// get filepath
			$filepath = $path.'/'.$value;

			// read file
			$content = ts_FileHandler::readFile($filepath);

			// check, if anything to replace in this file
			if (isset($this->subcodes[$filepath])) {

				// parse all lines to be add
				foreach ($this->subcodes[$filepath] as $in => $val) {
					$to_add = '';

					// sum everything to add to this line
					foreach ($val as $i => $v) {
						$to_add.= $v;
					}

					// replace line by subfunctions
					$content = str_replace('{line_'.$in.'}', $to_add, $content);
				}
			}

			// strip all {line_xx}
			$content = preg_replace('#\{line_[0-9]*\}#Usi', '', $content);

			// trim again
			$content = $Parser->trim($content, true);

			// write file
			if (!ts_FileHandler::writeFile($filepath, $content, true)) {
				return false;
			}
		}

		// parse all subfolders
		$subfolders = ts_FileHandler::getSubfolders($path);
		foreach ($subfolders as $index => $value) {
			if (!$this->parseAll($path.'/'.$value)) return false;
		}

		return true;
	}
}
