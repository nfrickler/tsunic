<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_LanguageHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; parse language-files
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

class ts_LanguageHandler {

	/* array containing all language-replacements
	 * array
	 */
	private $lang = array();

	/* array containing all language-replacements added by styles
	 * array
	 */
	private $lang_style = array();

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		return;
	}

	/* add language-replacements
	 * @param string $type: module or style
	 * @param int $id: module- or style-id
	 * @param string $language: language, replacements belong to
	 * @param array/string $input: array with language-replacements
	 * 			OR path to language-file	 	 
	 *
	 * @return bool
	 */
	public function add ($type, $id, $language, $input) {
		global $Parser;

		// validate input
		if (!in_array($type, array('module', 'style'))
			OR !is_numeric($id)
			OR empty($id)
			OR empty($language)
		) {
			return false;
		}

		// validate $input
		if (!is_array($input)) {

			// check file
			if (!file_exists($input)) return false;

			// include file
			ob_start();
			include $input;
			ob_get_clean();

			// is language
			if (!isset($lang) OR !is_array($lang)) return false;

			// set $lang as $input
			$input = $lang;
		}

		// is any input?
		if (empty($input)) return true;

		// replace moduls
		foreach ($input as $index => $value) {
			if (strstr($value, '$'))
				$input[$index] = strtoupper($Parser->replaceModule($value));
		}

		// add by type
		switch ($type) {
			case 'module':

				// prepare $this->lang
				if (!isset($this->lang[$id])) $this->lang[$id] = array();
				if (!isset($this->lang[$id][$language])) $this->lang[$id][$language] = array();

				// save in obj-vars
				foreach ($input as $index => $value) {
					$this->lang[$id][$language][$index] = $value;
				}

				break;
			case 'style':

				// loop input
				foreach ($input as $index => $value) {

					// get module
					$index = $Parser->replaceModule($index);
					$cache = explode('__', $index);
					$id__module = substr($cache[0], 3, (strlen($cache[0] - 5)));
					if (!$id__module OR !is_numeric($id__module)) continue;

					// check $this->lang_styles
					if (!isset($this->lang_styles[$id])) $this->lang_styles[$id] = array();
					if (!isset($this->lang_styles[$id][$id__module])) $this->lang_styles[$id][$id__module] = array();
					if (!isset($this->lang_styles[$id][$id__module][$language])) $this->lang_styles[$id][$id__module][$language] = array();

					// add
					$this->lang_styles[$id][$id__module][$language][$index] = $value;
				}

				break;
			default:
				return false;
		}

		return true;
	}

	/* write language-files
	 *
	 * @return string
	 */
	public function writeFiles () {
		global $Config;

		// add pseudo-style
		$this->lang_styles[0] = false;

		// loop all styles
		foreach ($this->lang_styles as $index => $values) {

			// loop all modules
			if (empty($this->lang) OR !is_array($this->lang)) return true;
			foreach ($this->lang as $in => $val) {

				// loop all languages
				if (empty($val) OR !is_array($val)) continue;
				foreach ($val as $i => $v) {

					// merge current
					if (isset($values[$in], $values[$in][$i])
						AND is_array($values[$in][$i]))
					{
						$current = array_merge($v, $values[$in][$i]);	
					} else {
						$current = $v;
					}

					// create file-content
					$content = '';
					foreach ($current as $ii => $vv) {

						// escape single-quotes
						$vv = str_replace("'", '\\\'', $vv);

						$content.= ",'".strtoupper('MOD'.$in.'__'.$ii)."'=>'".$vv."'";
					}
					$content = '<?php $lang = array('.substr($content, 1).'); ?>'; ?><?php

					// get path
					if (!($index === 0)) {
						$path = $Config->getRoot().'/runtime/lang/style'.$index.'__mod'.$in.'__'.$i.'.lang.php';
					} else {
						$path = $Config->getRoot().'/runtime/lang/mod'.$in.'__'.$i.'.lang.php';
					}

					// try to write
					if (!ts_FileHandler::writeFile($path, $content, true)) return false;
				}
			}
		}

		return true;
	}
}