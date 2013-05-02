<!-- | CLASS Template_Xml -->
<?php
/** Template class for XML templates used by ajax requests
 *
 */
class $$$Template_Xml extends $$$Template {

    /** Constructor
     * @param string $template
     *	Name of template
     */
    public function __construct ($template) {
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

    /** Display template
     * @param bool|string $template
     *	False: display this template; string: display template $template
     * @param bool|array $data
     *	False: no data; array: data for new template
     *
     * @return bool
     */
    public function display ($template = false, $data = false) {
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

    /** Include and display sub-templates
     * @param string $position
     *	Position in template
     *
     * @return bool
     */
    public function displaySub ($position = '#standard#') {
	return true;
    }

    /** Include template
     * @param object $File
     *	File object of template file
     *
     * @return bool
     */
    protected function _include ($File) {
	include $File->getPath();
    }
}
?>
