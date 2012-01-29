<!-- | class to handle xml-templates -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Template_Xml.class.php
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

include_once '$$$Template.class.php';
class $$$Template_Xml extends $$$Template {

	/* constructor
	 * @param string $template: name of template
	 * +@param string $design: name of design (not used in this content)
	 *
	 * @return OBJECT
	 */
	public function __construct ($template, $design = 0) {
		global $TSunic;

		// get input
		$this->template = $template;

		// get design
		if ($design == 0) {

			// get default-design
			global $TSunic;
			$this->design = $TSunic->Config->getConfig('style');
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

	/* display template
	 *
	 * @return bool
	 */
	public function display () {
		global $TSunic;

		// get paths (priority-orderr)
		$paths = array('#runtime#xmlResponses/style'.$this->style.'__'.$this->template.'.xml.php',
					   '#runtime#xmlResponses/'.$this->template.'.xml.php',
					   '#runtime#xmlResponses/style'.$this->style.'__$$$noTemplateFound.xml.php',
					   '#runtime#xmlResponses/$$$noTemplateFound.xml.php');

		// try to include template
		foreach ($paths as $index => $value) {

			if ($index > 1) {
				// create error
				$TSunic->Log->add('error', 'XML-Template "'.$this->template.'" not found!', 1);
			}

			$File = $TSunic->get('$$$File', $value);
			if ($File->isValid()) {
				$this->_include($File);
				return true;
			}
		}

		// fatale error! No template found!
		$TSunic->throwError('No template found!');
		return false;
	}

	/* include and display sub-templates
	 * @param string $type: type of sub-templates to be included
	 * +@param string $design: name of design
	 *
	 * @return bool
	 */
	public function displaySub ($type, $design = 0) {
		return true;
	}
}
?>