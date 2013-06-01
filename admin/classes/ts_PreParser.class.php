<!-- | CLASS ts_PreParser -->
<?php
/**
 * PreParser class to handle preparsing of modules and styles
 */
class ts_PreParser {

    /** Current packet
     * @var Packet $Packet
     */
    private $Packet;

    /** All file extensions that shall be parsed
     * @var array $parse_ext
     */
    private $parse_ext = array('php', 'html', 'htm', 'css', 'xml', 'js');

    /** Constructor
     * @param object $Packet
     *	Packet object which is going to be parsed next
     */
    public function __construct ($Packet = NULL) {
	$this->Packet = $Packet;
	return;
    }

    /** Preparse
     * @param string $path
     *	Source path
     * @param string $path_new
     *	Destination path
     * @param string|bool $path_to_cut
     *	Common path of module/style (internal use)
     * @param bool $rm_flags
     *	Remove flag comments?
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

	    // only move directories named static
	    if ($value == 'static') {
		ts_FileHandler::copyFolder("$path/$value", "$path_new/$value");
		continue;
	    }

	    if (!$this->parse("$path/$value", "$path_new/$value", $path_to_cut, $rm_flags)) {
		$Log->doLog(3, "PreParser: Failed to preparse subfolder ($path/$value)");
		return false;
	    }
	}

	return true;
    }

    /** Preparse file
     * @param string $source
     *	Source file
     * @param string $destination
     *	Destination file
     * @param string $path_to_cut
     *	Path to root
     * @param bool $rm_flags
     *	Remove flag comments?
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

	// get filetype
	$cache = explode('.', basename($source));
	$filetype = end($cache);

	// filetype to move only?
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

	// split flag comment from rest of content
	if (substr($content, 0, 4) != '<!--') $content = '<!-- | -->'.chr(10).$content;
	$content_lines = explode(chr(10), $content);
	$flag_comment = trim($content_lines[0]);
	unset($content_lines[0]);
	$content = implode(chr(10),$content_lines);

	// read flags and get path to display
	$flags = $this->getFlags($flag_comment);
	if (isset($flags['p'])) return true;
	$displaypath = substr($destination, (strlen($path_to_cut)+1));

	// add header
	if (!isset($flags['h'])) {

	    // remove existing headers
	    $content = preg_replace('#(\/\*\* header .* \*\/)#Usi', '', $content);
	    $content = preg_replace('#(\<\?php[\s]*\?\>)#Usi', '', $content);
	    $content = preg_replace('#(\<!--[\s]*--\>)#Usi', '', $content);

	    // generate new header
	    // First two lines have to be separated or the publish
	    // script will remove the following header definition!
	    $header = '/*'.
		'* header *********************************************************'.chr(10).
		' * project:   TSunic '.$Config->get('version').' | '.
		$this->Packet->getInfo('name').' '.
		$this->Packet->getInfo('version').chr(10).
		' * file:      '.$displaypath.chr(10);
	    if ($this->Packet->getInfo('author'))
		$header.= ' * author:    '.
		    $this->Packet->getInfo('author').chr(10);
	    if ($this->Packet->getInfo('copyright'))
		$header.= ' * copyright: '.
		    $this->Packet->getInfo('copyright').chr(10);
	    if ($this->Packet->getInfo('licence')) {
		$cache = explode(chr(10), $this->Packet->getInfo('licence'));
		$header.= ' * licence:   '.trim($cache[0]).chr(10);
		if (count($cache) > 1) {
		    for ($i = 1; $i < count($cache); $i++) {
			$cache[$i] = trim($cache[$i]);
			$header.= (empty($cache[$i]))
			    ? ' *'.chr(10)
			    : ' *	    '.$cache[$i].chr(10);
		    }
		}
	    }
	    $header.= ' * ************************************************************** */'.chr(10);

	    // embed header in required tags
	    switch ($filetype) {
		case 'php':
		    $header = '<?php'.chr(10).$header.'?>';
		    break;
		case 'js':
		case 'css':
		    break;
		default:
		    $header = '<!--'.chr(10).$header.'-->';
		    break;
	    }

	    // add header to content
	    $content = $header.chr(10).$content;

	    // skip empty lines at the beginning
	    $cache = explode(chr(10), $content);
	    foreach ($cache as $index => $value) {
		$value = trim($value);
		if (empty($value)) {
		    unset($cache[$index]);
		    continue;
		} elseif ($value == '<?php') {
		    continue;
		}
		break;
	    }
	    $content = implode(chr(10), $cache);
	}

	// add flag comment again
	if (!$rm_flags) $content = $flag_comment.chr(10).$content;

	// trim
	$content = str_replace('?>'.chr(10).'<?php', '', $content);

	// write
	$Log->doLog(5, "PreParser: Write file '$source'");
	if (!ts_FileHandler::writeFile($destination, $content, 1)) {
	    $Log->doLog(3, "PreParser: Unable to write file ($destination)");
	    return false;
	}

	return true;
    }

    /** Read flags of file
     *
     * Available flags:
     *   i - ignore file at parsing
     *   p - ignore file at preparsing
     *   h - do not add header
     *
     * @param string $content
     *	Content of file
     *
     * @return array
     */
    public function getFlags ($content) {
	$flags = array();

	// extract header
	//$cache = explode('<?php', $content);
	$cache = explode('-->', $content);
	$cache = explode('<!--', $cache[0]);

	// is flag comment?
	if (count($cache) < 1) return array();

	// split header
	$cache = explode('|', $cache[1]);

	// get flags
	$tmpflags = str_replace(' ', '', trim($cache[0]));
	$tmpflags = (array) $tmpflags;
	foreach ($tmpflags as $index => $value) {
	    if (empty($value)) continue;
	    $flags[$value] = $value;
	}

	return $flags;
    }
}
?>
