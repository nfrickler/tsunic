<!-- | Class to parse access-files -->
<?php
class ts_AccessParser {

	/* array containing all data from access-files
	 * array
	 */
	protected $data;

	/* constructor
	 */
	public function __construct () {
		$this->data = array();
	}

	/* read content from access file
	 * @param string: path of access file
	 * @param string: preffix to add to each accessname
	 *
	 * @return bool
	 */
	public function add ($path, $preffix) {

		// is such file?
		if (!file_exists($path)) return true;

		// read
		$Xml = simplexml_load_file($path);

		// save in object var
		foreach ($Xml->children() as $Value) {
			$myval = (string) $Value->attributes()->default;
			if ($myval == "false") $myval = 0;
			$this->data[] = array(
				'name' => $preffix.utf8_decode("$Value"),
				'default' => ($myval ? 1 : 0)
			);
		}

		return true;
	}

	/* update accessnames in database
	 * @param string: name of table to insert accessnames into
	 *
	 * @return bool
	 */
	public function parseAll ($table) {
		global $Log, $Database;

		// udpate database
		foreach ($this->data as $index => $values) {
			$sql = "INSERT INTO $table (name, systemdefault)
				VALUES ('".$values['name']."', '".$values['default']."')
				ON DUPLICATE KEY UPDATE systemdefault = '".$values['default']."';";
			$result = $Database->doInsert($sql);
			if ($result === false) {
				$Log->doLog(3, "AccessParser: Failed to write accessnames in database!");
				return false;
			}
		}

		return true;
	}
}
?>
