<!-- | CLASS XML Templates for Ajax requests -->
<?php
include_once '$$$Template.class.php';
class $$$Template_Xml extends $$$Template {

    /* constructor
     * @param string: name of template
     * +@param string: name of design (not used in this content)
     */
    public function __construct ($template, $design = 0) {
	global $TSunic;

	// get input
	$this->template = $template;

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

	// get paths (priority-order)
	$paths = array(
	    '#runtime#xmlResponses/style'.$this->getStyle().'__'.$this->template.'.xml.php',
	    '#runtime#xmlResponses/'.$this->template.'.xml.php',
	    '#runtime#xmlResponses/style'.$this->getStyle().'__$$$noTemplateFound.xml.php',
	    '#runtime#xmlResponses/$$$noTemplateFound.xml.php'
	);

	// try to include template
	foreach ($paths as $index => $value) {

	    if ($index > 1) {
		// create error
		$TSunic->Log->alert('error', 'XML-Template "'.$this->template.'" not found!');
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
     * @param string: type of sub-templates to be included
     * +@param string: name of design
     *
     * @return bool
     */
    public function displaySub ($type, $design = 0) {
	return true;
    }

    /* include template
     * @param object: File object
     *
     * @return bool
     */
    protected function _include ($File) {
	include $File->getPath();
    }
}
?>
