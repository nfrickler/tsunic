<!-- | CLASS ts_ConfigParser -->
<?php
/**
 * Class to parse config xml file and add configuration possibilities to
 * TSunic
 */
class ts_ConfigParser {

    /** Array containing all data from config-files
     * @var array $data
     */
    protected $data;

    /** Constructor
     */
    public function __construct () {
	$this->data = array();
    }

    /** Read content from config file
     * @var string $path
     *	Path of config file
     * @var string $prefix
     *	Prefix to add to each configname
     *
     * @return bool
     */
    public function add ($path, $prefix) {
	global $Parser;

	// is such file?
	if (!file_exists($path)) return true;

	// read
	$Xml = simplexml_load_file($path);

	// save in object var
	foreach ($Xml->children() as $Value) {
	    $default = (string) $Value->attributes()->default;
	    $formtype = (string) $Value->attributes()->formtype;
	    $configtype = (string) $Value->attributes()->configtype;
	    $options = (string) $Value->attributes()->options;
	    $this->data[] = array(
		'name' => $prefix.utf8_decode("$Value"),
		'default' => $default,
		'configtype' => $configtype,
		'formtype' => $formtype,
		'options' => $options
	    );
	}

	return true;
    }

    /** Update confignames in database
     * @var string $table
     *	Name of table to insert config into
     *
     * @return bool
     */
    public function parseAll ($table) {
	global $Log, $Database;

	// udpate database
	foreach ($this->data as $index => $values) {
	    $sql = "INSERT INTO $table (name, systemdefault, configtype, formtype, options)
		VALUES ('".$values['name']."',
		    '".$values['default']."',
		    '".$values['configtype']."',
		    '".$values['formtype']."',
		    '".$values['options']."'
		)
		ON DUPLICATE KEY UPDATE
		    systemdefault = '".$values['default']."',
		    configtype = '".$values['configtype']."',
		    formtype = '".$values['formtype']."',
		    options = '".$values['options']."'
	    ;";
	    if ($Database->doInsert($sql) === false) {
		$Log->doLog(3, "AccessParser: Failed to write config in database!");
		return false;
	    }
	}

	$this->data = array();
	return true;
    }
}
?>
