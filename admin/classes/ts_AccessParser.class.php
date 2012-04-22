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
	 * @param string: preffix of usersystem tables
	 *
	 * @return bool
	 */
	public function parseAll ($preffix) {
		global $Log, $Database;

		// udpate database
		foreach ($this->data as $index => $values) {
			$sql = "INSERT INTO ${preffix}accessnames (name)
				VALUES ('".$values['name']."')
				ON DUPLICATE KEY UPDATE dateOfCreation = NOW()
			;";
			$result = $Database->doInsert($sql);
			if ($result === false) {
				$Log->doLog(3, "AccessParser: Failed to write accessnames in database!");
				return false;
			}

			// update default setting in allGroup
			$sql = "INSERT INTO ${preffix}access (fk__accessname, fk__owner, isUser, access)
				VALUES ('".$values['name']."', 1, 0, ".($values['default'] ? 1 : 0).")
				ON DUPLICATE KEY UPDATE access = ".($values['default'] ? 1 : 0)."
			;";
			$result = $Database->doInsert($sql);
			if ($result === false) {
				$Log->doLog(3, "AccessParser: Failed to set access for all group in database!");
				return false;
			}

		}

		return true;
	}
}
?>
