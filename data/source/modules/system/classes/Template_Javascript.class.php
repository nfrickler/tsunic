<!-- | class for javascript-templates -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Template_Javascript.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
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

include_once 'ts_System__Template.class.php';
class ts_System__Template_Javascript extends ts_System__Template {
	/* constructor
	 * +@param string $template: name of template
	 * +@param string $design: name of design
	 *
	 * @return OBJECT
	 */
	public function __construct ($template = false, $design = 0) {
		global $TSunic;
		// get input
		$this->template = $template;
		// get design
		if ($design == 0) {
			// get default-design
			$this->design = $TSunic->Settings->getConfig('style');
		} else {
			// chosen design
			$this->design = $design;
		}
		// get data for template
		if (isset($TSunic->Tmpl->data[$template])) {
			$this->data = $TSunic->Tmpl->data[$template];
		} else {
			$this->data = array();
		}
		return;
	}
	/* parse for output (language- and bbcode-replacements)
	 * @param string $text: text to parse
	 * @param 0/array $vars: variables to replace in lang-string
	 * +@param bool $doEcho: true - display $text; false - do not display
	 * +@param bool $doEscape: true - escape singe and double quotes	 
	 *
	 * @return bool
	 */
	public function set ($text, $vars = 0, $doEcho = true, $doEscape = true) {
		return parent::set($text, $vars, $doEcho, $doEscape);
	}
	/* display template
	 *
	 * @return bool
	 */
	public function includeTemplate () {
		global $TSunic;
		// set path
		$this->path = '#runtime#javascript/#style#__'.$this->template.'.js';
		// get file-object
		$File = $TSunic->get('ts_System__File', $this->path);
		// try to include file
		if ($File->isValid()) {
			// include file
			include $File->getPath();
		} else {
			// template does not exist
			return false;
		}
		return true;
	}
	/* parse Link for output
	 * @param string $module: name of module
	 * @param string $event: name of event
	 * @param bool/array $data: false - no GET-parameter; array - GET-parameters	 
	 * +@param bool $is_html: is link placed in html-code (set false for javascript etc.)
	 * +@param bool $doEcho: print link (false returns link)	 	 
	 *
	 * @return bool
	 */
	public function setUrl ($module, $event = false, $data = false, $is_html = false, $doEcho = true) {
		global $TSunic;
		// get url
		$link = parent::setUrl($module, $event, $data, $is_html, false);
		// skip ?
		$link = substr($link, 1);
		// parse link for html-output
		if (!empty($is_html)) $link = str_replace('&', '&amp;', $link);
		// print or return
		if ($doEcho == true) {
			echo $link;
		} else {
			return $link;
		}
	}
}
?>