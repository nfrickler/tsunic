<!-- | CLASS ts_FormatHandler -->
<?php
/**
 * Class to parse CSS format files of all modules
 */
class ts_FormatHandler {

    /** Array containing all CSS styles
     * @var array $format
     */
    private $format = array();

    /** Array containing all CSS styles added by styles
     * @var array $format_styles
     */
    private $format_styles;

    /** cache array
     * @var array $cache
     */
    private $cache;

    /** Add CSS code
     * @var string $input
     *	CSS code to add
     * @var string $id__style
     *	Style-id; false - no style but a module
     *
     * @return bool
     */
    public function add ($input, $id__style = false) {
	$input_arr = array();
	$this->cache['formats'] = array();

	// convert input to array
	$cache1 = preg_replace_callback('#(\{.*\})#Usi', array($this, '_handleInput'), $input);
	$cache1 = explode('{}', $cache1);
	foreach ($cache1 as $index => $value) {
	    $value = trim($value);
	    if (empty($value)) continue;
	    $input_arr[$value] = $this->cache['formats'][$index];
	}

	// add input to formats
	if (!$id__style) {
	    $this->format = array_merge($this->format, $input_arr);
	} else {
	    if (!isset($this->format_styles[$id__style]))
		$this->format_styles[$id__style] = array();
	    $this->format_styles[$id__style] =
		array_merge($this->format_styles[$id__style], $input_arr);
	}

	return true;
    }

    /** Handle CSS code from callback function
     * @param string $input
     *	CSS code to add
     *
     * @return bool
     */
    private function _handleInput ($input) {
	$input = trim($input[0]);
	$input = substr($input, 1, (strlen($input) - 2));
	$array = array();

	// turn input to array
	$cache1 = explode(';', $input);
	foreach ($cache1 as $index => $value) {
	    $value = trim($value);
	    if (empty($value)) continue;
	    $cache2 = explode(':', $value);
	    $array[trim($cache2[0])] = trim($cache2[1]);
	}

	// add to cache-array
	$this->cache['formats'][] = $array;

	// replace by empty string
	return '{}';
    }

    /** Write CSS files
     *
     * @return bool
     */
    public function writeFiles () {
	global $Config;

	// add pseudo-style
	$this->format_styles[0] = array();

	// loop styles
	foreach ($this->format_styles as $index => $values) {

	    // merge formats
	    $current = $this->format;
	    foreach ($values as $in => $val) {
		if (isset($current[$in])) {
		    $current[$in] = array_merge($current[$in], $val);
		} else {
		    $current[$in] = $val;
		}
	    }

	    // order formats
	    $css1 = array();
	    $css2 = array();
	    $css3 = array();
	    foreach ($current as $in => $val) {
		$in = trim($in);
		if (substr($in,0,1) == '#') {
		    $css3[$in] = $val;
		} elseif (substr($in,0,1) == '.') {
		    $css2[$in] = $val;
		} else {
		    $css1[$in] = $val;
		}
	    }
	    ksort($css1);
	    ksort($css2);
	    ksort($css3);
	    $current = array_merge($css1, $css2, $css3);

	    // sum for output
	    $output = '';
	    foreach ($current as $in => $val) {
		$output.= $in.' {';
		foreach ($val as $i => $v) {
		    $output.= $i.':'.$v.';';
		}
		$output.= '} ';
	    }

	    // write file
	    if (!($index === 0) AND !empty($values)) {
		$path = $Config->get('dir_runtime').'/css/style'.$index.'__format.css';
	    } else {
		$path = $Config->get('dir_runtime').'/css/format.css';
	    }

	    // write file
	    if (!ts_FileHandler::writeFile($path, $output, true)) {
		return false;
	    }
	}

	return true;
    }
}
?>
