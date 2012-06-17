<!-- | Class to handle XML files -->
<?php
// static
class ts_XmlHandler {

    /* get content of xml-file as array (1D)
     * @param string: path to xml-file
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
