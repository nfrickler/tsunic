<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_StyleHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle styles
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

class ts_StyleHandler {

	/* style-objects of all existing styles
	 * array
	 */
	private $styles;	 

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		// load style-class
		include_once 'classes/ts_Style.class.php';

		return;
	}

	/* make sure that a default-style has been set
	 *
	 * @return bool
	 */
	public function validateDefault () {

		// get all styles
		$styles = $this->getStyles();

		// is default?
		$no = true;
		$possible_default = false;
		foreach ($styles as $index => $Value) {
			if ($Value->getInfo('is_default')) {
				$no = false;
			} elseif ($Value->getStatus() == 5 OR $Value->getStatus() == 9) {
				$possible_default = $Value;
			}
		}

		// set a random one, if possible
		if ($no AND $possible_default) {
			$possible_default->setAsDefault();
		}

		return true;
	}

	/* get all styles
	 * @param bool $force_update: force to get new list from database (not a cached one from obj-var)
	 *
	 * @return array
	 */
	public function getStyles ($force_update = false) {
		global $Database, $Config;

		// already in obj-var?
		if (!$force_update AND isset($this->styles) AND !empty($this->styles)) return $this->styles;

		// get module-ids from database
		$sql_0 = "SELECT id__style as id__style
					FROM #__styles
					ORDER BY name ASC;";
		$result_0 = $Database->doSelect($sql_0);
		if ($result_0 === false) return false;

		// get available sources
		include_once 'classes/ts_FileHandler.class.php';
		$subfolders = ts_FileHandler::getSubfolders($Config->getRoot(true).'/source/styles');
		if (!is_array($subfolders)) return false;

		// get style-objects and save them in obj-var
		$style_files = array();
		foreach ($subfolders as $index => $value) {
			$style_files[] = new ts_Style(false, $value);
		}

		// add already deleted styles
		$this->styles = array();
		foreach ($style_files as $index => $Value) {
			$this->styles[$Value->getInfo('name').'__'.$Value->getInfo('nameid')] = $Value;
		}
		foreach ($result_0 as $index => $values) {
			$Style = new ts_Style($values['id__style']);
			if (!isset($this->styles[$Style->getInfo('name').'__'.$Style->getInfo('nameid')])) {
				$this->styles[$Style->getInfo('name').'__'.$Style->getInfo('nameid')] = $Style;
			}
		}

		// sort
		ksort($this->styles);

		return $this->styles;
	}
}