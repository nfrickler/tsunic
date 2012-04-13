<!-- | Class to parse config-files -->
<?php
class ts_ConfigParser {

	/* array containing all data from config-files
	 * array
	 */
	protected $data;

	/* constructor
	 */
	public function __construct () {
		$this->data = array();
	}

	/* read content from config file
	 * @param string: path of config file
	 * @param string: preffix to add to each configname
	 *
	 * @return bool
	 */
	public function add ($path, $preffix) {
		global $Parser;

		// is such file?
		if (!file_exists($path)) return true;

		// read
		$Xml = simplexml_load_file($path);

		// save in object var
		foreach ($Xml->children() as $Value) {
			$default = (string) $Value->attributes()->default;
			$formtype = (string) $Value->attributes()->formtype;
			$options = (string) $Value->attributes()->options;
			$this->data[] = array(
				'name' => $preffix.utf8_decode("$Value"),
				'default' => $default,
				'formtype' => $formtype,
				'options' => $options
			);
		}

		return true;
	}

	/* update confignames in database
	 * @param string: name of table to insert config into
	 *
	 * @return bool
	 */
	public function parseAll ($table) {
		global $Log, $Database;

		// udpate database
		foreach ($this->data as $index => $values) {
			$sql = "INSERT INTO $table (name, systemdefault, formtype, options)
				VALUES ('".$values['name']."',
					'".$values['default']."',
					'".$values['formtype']."',
					'".$values['options']."'
				)
				ON DUPLICATE KEY UPDATE
					systemdefault = '".$values['default']."',
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
