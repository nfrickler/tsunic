<!-- | class for preparsing modules or styles -->
<?php
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
	 */
	public function __construct () {
		return;
	}

	/* set current module
	 * @param object: packet-object which is going to be parsed next
	 *
	 * @return string
	 */
	public function setPacket ($Packet) {
		$this->Packet = $Packet;
		return true;
	}

	/* preparse
	 * @param string: source-path
	 * @param string: destination_path
	 * +@param string/bool: common path of module/style (internal use)
	 * +@param bool: remove flag comments?
	 *
	 * @return string
	 */
	public function parse ($path, $path_new, $path_to_cut = "", $rm_flags = false) {
		global $Config, $Log;

		// is packet set?
		if (empty($this->Packet)) return false;

		// get all files
		$files = ts_FileHandler::getSubfiles($path);

		// preparse all files
		foreach ($files as $index => $value) {
			if (substr($value, -4) == ".swp") continue;

			if (!$this->parseFile("$path/$value", "$path_new/$value", $path_to_cut, $rm_flags)) {
				return false;
			}
		}

		// get all subfolders
		$subfolders = ts_FileHandler::getSubfolders($path);

		// parse all subfolders
		foreach ($subfolders as $index => $value) {
			if (!$this->parse("$path/$value", "$path_new/$value", $path_to_cut, $rm_flags)) {
				$Log->doLog(3, "PreParser: Failed to preparse subfolder ($path/$value)");
				return false;
			}
		}

		return true;
	}

	/* preparse file
	 * @param string: source file
	 * @param string: destination file
	 * +@param string: path to root
	 * +@param bool: remove flag comments?
	 *
	 * @return bool
	 */
	public function parseFile ($source, $destination, $path_to_cut = "", $rm_flags = false) {
		global $Config, $Log;

		// is packet set?
		if (empty($this->Packet)) return false;

		// read
		$Log->doLog(5, "PreParser: Read file '$source'");
		$content = ts_FileHandler::readFile($source);
		if ($content === false) {
			$Log->doLog(3, "PreParser: Unable to read file '$source'");
			return false;
		}

		// move only?
		$cache = explode('.', basename($source));
		$filetype = end($cache);
		if (!in_array($filetype, $this->parse_ext)) {

			if (
				$source != $destination and
				!ts_FileHandler::writeFile($destination, $content)
			) {
				$Log->doLog(3, "PreParser: Unable to move file to '$destination'");
				return false;
			}

			return true;
		}

		// add flag comment if missing
		if (substr($content, 0, 4) != '<!--') $content = '<!-- | -->'.$content;

		// read flags, get file-path
		$flags = $this->getFlags($content);
		if (isset($flags['p'])) return true;
		$filepath = substr($destination, (strlen($path_to_cut)+1));

		// add header
		if (!isset($flags['h'])) {

			// clear file
			$content = preg_replace('#(\/\*\* header .* \*\/)#Usi', '', $content);
			$content = preg_replace('#(\<\?php[\s]*\?\>)#Usi', '', $content);
			$content = preg_replace('#(\<!--[\s]*--\>)#Usi', '', $content);

			// generate new header
			$header = '/** header ***********************************************************'.chr(10);
			$header.= ' * project:   TSunic '.$Config->get('version').' | '.
				$this->Packet->getInfo('name').' '.
				$this->Packet->getInfo('version').chr(10);
			$header.= ' * file:      '.$filepath.chr(10);
			if ($this->Packet->getInfo('author'))
				$header.= ' * author:    '.
				$this->Packet->getInfo('author').chr(10);
			if ($this->Packet->getInfo('copyright'))
				$header.= ' * copyright: '.
				$this->Packet->getInfo('copyright').chr(10);
			if ($this->Packet->getInfo('licence')) {
				// is only one line?
				$cache = explode(chr(10), $this->Packet->getInfo('licence'));
				if (count($cache) < 2) {
					$header.= ' * licence:   '.
						$this->Packet->getInfo('licence').chr(10);
				} else {
					$header.= ' * licence:   '.trim($cache[0]).chr(10);
					for ($i = 1; $i < count($cache); $i++) {
						$cache[$i] = trim($cache[$i]);
						if (empty($cache[$i])) {
							$header.= ' *'.chr(10);
						} else {
							$header.= ' *            '.
								$cache[$i].chr(10);
						}
					}
				}
			}
			$header.= ' * **************************************************************** */'.chr(10);

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

		// remove flags?
		if ($rm_flags) {
			$lines = explode(chr(10), $content);
			$lines[0] = "";
			unset($lines[0]);
			$content = implode(chr(10), $lines);
		}

		// trim
		$content = str_replace('?>'.chr(10).'<?php', '', $content); ?><?php

		// write
		$Log->doLog(5, "PreParser: Write file '$source'");
		if (!ts_FileHandler::writeFile($destination, $content, 1)) {
			$Log->doLog(3, "PreParser: Unable to write file ($destination)");
			return false;
		}

		return true;
	}

	/* read flags from content of file
	 * @param string: content of file
	 *
	 * @return array with flags
	 * Available flags:
	 * 	i - ignore file at parsing
	 * 	p - ignore file at preparsing
	 * 	h - do not add header
	 *
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
