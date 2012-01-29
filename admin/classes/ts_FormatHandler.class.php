<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_FormatHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; parse formats
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

class ts_FormatHandler {

	/* array containing all css-styles
	 * array
	 */
	private $format = array();

	/* array containing all css-styles added by styles
	 * array
	 */
	private $format_styles;

	/* cache-array
	 * array
	 */
	private $cache;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		return;
	}

	/* add css
	 * @param string $input: css-code to add
	 * +@param string $id__style: style-id; false - no style but a module	 
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
			if (!isset($this->format_styles[$id__style])) $this->format_styles[$id__style] = array();
			$this->format_styles[$id__style] = array_merge($this->format_styles[$id__style], $input_arr);
		}

		return true;
	}

	/* handle css-code from callback-function
	 * @param string $input: css-code to add
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

	/* write css-files
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
				$path = $Config->getRoot().'/runtime/css/style'.$index.'__format.css';
			} else {
				$path = $Config->getRoot().'/runtime/css/format.css';
			}

			// write file
			if (!ts_FileHandler::writeFile($path, $output, true)) {
				return false;
			}
		}

		return true;
	}
}