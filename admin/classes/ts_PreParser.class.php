<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_PreParser.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; PreParser
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

class ts_PreParser {

	/* current module
	 * object
	 */
	private $current_module;

	/* current packet
	 * object
	 */
	private $Packet;

	/* flags of current file
	 * array
	 */
	private $flags;

	/* all file-extensions that shall be parsed
	 * array
	 */
	private $parse_ext = array('php', 'html', 'htm', 'css', 'xml', 'js');

	/* constructor	 	 
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		return;
	}

	/* set current module
	 * @param object $Packet: packet-object which is going to be parsed next	 
	 *
	 * @return string
	 */
	public function setPacket ($Packet) {
		$this->Packet = $Packet;
		return true;
	}

	/* parse
	 * @param string $path: source-path
	 * @param string $path_new: destination_path
	 * +@param string/bool $path_to_cut: common path of module/style (internal use)	 	 
	 *
	 * @return string
	 */
	public function parse ($path, $path_new, $path_to_cut = false) {
		global $Config;

		// is module or style?
		if (empty($this->Packet)) return false;

		// $path_to_cut
		if (empty($path_to_cut)) $path_to_cut = $path_new;

		// get all files
		$files = ts_FileHandler::getSubfiles($path);

		// preparse all files
		foreach ($files as $index => $value) {

			// read
			$content = ts_FileHandler::readFile($path.'/'.$value);

			// skip foreign files
			$cache = explode('.', $value);
			if (!in_array(end($cache), $this->parse_ext)) {

				// move only
				if (!ts_FileHandler::writeFile($path_new.'/'.$value, $content))
					return false;

				continue;
			}

			// is flag-comment at the beginning?
			if (substr($content, 0, 4) != '<!--') $content = '<!-- | -->'.$content;

			// read flags, get filetype and file-path
			$flags = $this->getFlags($content);
			$filepath = substr($path_new, (strlen($path_to_cut)+1));
			if (!empty($filepath)) $filepath.= '/';
			$cache = explode('.', basename($value));
			$filetype = end($cache);

			// add header
			if (!isset($flags['h'])) {

				// clear file
				$content = preg_replace('#(\/\*\* header .* \*\/)#Usi', '', $content);
				$content = preg_replace('#(\<\?php[\s]*\?\>)#Usi', '', $content);
				$content = preg_replace('#(\<!--[\s]*--\>)#Usi', '', $content);

				// generate new header
				$header = '/** header *********************************************************************'.chr(10);
				$header.= ' * project:			TSunic '.$Config->get('version').' | '.$this->Packet->getInfo('name').' '.$this->Packet->getInfo('version').chr(10);
				$header.= ' * file:			'.$filepath.$value.chr(10);
				if ($this->Packet->getInfo('author')) $header.= ' * author:			'.$this->Packet->getInfo('author').chr(10);
				if ($this->Packet->getInfo('copyright')) $header.= ' * copyright:		'.$this->Packet->getInfo('copyright').chr(10);
				if ($this->Packet->getInfo('licence')) {
					// is only one line?
					$cache = explode(chr(10), $this->Packet->getInfo('licence'));
					if (count($cache) < 2) {
						$header.= ' * licence:			'.$this->Packet->getInfo('licence').chr(10);
					} else {
						$header.= ' * licence:			'.trim($cache[0]).chr(10);
						for ($i = 1; $i < count($cache); $i++) {
							$cache[$i] = trim($cache[$i]);
							if (empty($cache[$i])) {
								$header.= ' * '.chr(10);
							} else {
								$header.= ' * 					'.$cache[$i].chr(10);
							}
						}
					}
				}
				$header.= ' * ************************************************************************** */'.chr(10);

				// add header to content
				$cache = explode('-->', $content);
				$content = $cache[0].'-->'.chr(10);
				unset($cache[0]);
				switch ($filetype) {
					case 'php':
						$content.= '<?php'.chr(10).$header.'?>'.chr(10); ?><?php
						break;
					case 'js':
					case 'css':
						$content.= $header.chr(10);
						break;
					default:
						$content.= '<!--'.chr(10).$header.'-->'.chr(10);
						break;
				}

				// skip empty lines at the beginning
				$cache_1 = explode(chr(10), $cache[1]);
				foreach ($cache_1 as $in => $val) {
					$val = trim($val);
					if (empty($val)) {
						unset($cache_1[$in]);
						continue;
					} elseif ($val == '<?php') {
						continue;
					}
					break;
				}
				$cache[1] = implode(chr(10), $cache_1);

				// combine again
				$content.= implode('-->', $cache);
			}

			// trim
			$content = str_replace('?>'.chr(10).'<?php', '', $content); ?><?php

			// write
			if (!ts_FileHandler::writeFile($path_new.'/'.$value, $content)) {
				return false;
			}
		}

		// get all subfolders
		$subfolders = ts_FileHandler::getSubfolders($path);

		// parse all subfolders
		foreach ($subfolders as $index => $value) {
			// preparse
			if (!$this->parse($path.'/'.$value, $path_new.'/'.$value, $path_to_cut)) return false;
		}

		return true;
	}


	/* read flags from content of file
	 * @param string $content: content of file
	 *
	 * @return array
	 */
	public function getFlags ($content) {
		$this->flags = array();

		// extract header
		$cache = explode('<?php', $content);
		$cache = explode('-->', $cache[0]);
		$cache = explode('<!--', $cache[0]);

		// is header?
		if (count($cache) < 1) array();

		// split header
		$cache = explode('|', $cache[1]);

		// get flags
		$flags = str_replace(' ', '', trim($cache[0]));
		$flags = (array) $flags;
		foreach ($flags as $index => $value) {
			if (empty($value)) continue;
			$this->flags[$value] = $value;
		}

		return $this->flags;
	}
}
