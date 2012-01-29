<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_XmlHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle XML-files
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
class ts_XmlHandler {

	/* get content of xml-file as array
	 * @param string $path: path to xml-file
	 *
	 * @return array
	 */
	public function readAll ($path) {
		$output = array();

		// load content of xml-file
		if (!file_exists($path)) return false;
		$Xml = simplexml_load_file($path);
		if (!$Xml) return false;

		// get content
		foreach ($Xml->children() as $Data) {
			$array = array();

			// add to output
			$output[$Data->getName()] = utf8_decode("$Data");
		}

		return $output;
	}


}