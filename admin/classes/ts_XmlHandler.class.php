<!-- | CLASS to handle XML files -->
<?php
// static
class ts_XmlHandler {

    /* get content of xml-file as array (1D)
     * @param string: path to xml-file
     *
     * @return array
     */
    public static function readAll ($path) {
	$output = array();

	// load content of XML file
	if (!file_exists($path)) return false;
	$Xml = simplexml_load_file($path);

	return ($Xml) ? self::xml2array($Xml) : array();
    }

    /* convert Xml-Object to array
     * @param object: Xml object
     *
     * @return array
     */
    public static function xml2array ($Xml) {
	$out = array();
	foreach ($Xml as $element) {

	    // create new array element
	    $arr = array();
	    $arr['tag'] = $element->getName();

	    // get all attributes
	    $arr['attrs'] = array();
	    foreach ($element->attributes() as $index => $value) {
		$arr['attrs'][$index] = "$value";
	    }
	    
	    // get value
	    if ($element->count()) {
		$arr['value'] = self::xml2array($element);
	    } else {
		$arr['value'] = "$element";
	    }
	    $out[] = $arr;
	}
	return $out;
    }
}
