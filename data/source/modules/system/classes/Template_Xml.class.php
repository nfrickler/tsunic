<!-- | class to handle xml-templates -->
<?php

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
