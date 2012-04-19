<!-- | UserConfig class -->
<?php
class $$$UserConfig {

	/* account ID
	 * int
	 */
	protected $fk_account;

	/* constructor
	 * @param int: fk account
	 */
	public function __construct ($fk_account) {
		$this->fk_account = $fk_account;
	}

	/* get config of user
	 * @param string: name of config
	 * +@param bool: return default, if no userconfig?
	 *
	 * @return mix
	 */
	public function get ($name, $returnDefault = true) {
		global $TSunic;

		// try to get user config
		$sql = "SELECT value
			FROM #__userconfig
			WHERE fk_account = '$this->fk_account'
				AND fk_config = '$name';";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return NULL;
		if (!empty($result)) {
			return $result[0]['value'];
		}

		// return default value
		return ($returnDefault) ? $this->getDefault($name) : NULL;
	}

	/* get default config
	 * @param string: name of config
	 *
	 * @return mix
	 */
	public function getDefault ($name) {
		global $TSunic;

		// try to get default config
		$sql = "SELECT systemdefault
			FROM #__config
			WHERE name = '$name';";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return NULL;
		if (!empty($result)) {
			return $result[0]['systemdefault'];
		}

		// config name does not exist
		return NULL;
	}

	/* does config name exist?
	 * @param string: name of config
	 *
	 * @return bool
	 */
	public function exists ($name) {
		return ($this->getDefault($name) != NULL) ? true : false;
	}

	/* set value
	 * @param string: name of config
	 * @param mix: value to set (NULL means default value)
	 *
	 * @return bool
	 */
	public function set ($name, $value) {

		// config name exists?
		if (!$this->exists($name)) return false;

		// default value?
		if ($value === NULL or $value === "") {
			return ($this->get($name, false) != NULL)
				? $this->delete($name) : true;
		}

		// update database
		global $TSunic;
		$sql = "INSERT INTO #__userconfig
			SET fk_config = '$name',
				fk_account = '$this->fk_account',
				value = '$value'
			ON DUPLICATE KEY UPDATE value = '$value';";
		return $TSunic->Db->doInsert($sql);
	}

	/* delete userconfig
	 * @param string: name of config
	 *
	 * @return bool
	 */
	public function delete ($name) {
		global $TSunic;
		$sql = "DELETE FROM #__userconfig
			WHERE fk_account = '$this->fk_account'
				AND fk_config = '$name';";
		return $TSunic->Db->doDelete($sql);
	}

	/* get all config names and values
	 *
	 * @return array
	 */
	public function getAll () {
		global $TSunic;

		// get all config names from database
		$sql = "SELECT name,
				systemdefault,
				formtype,
				options
			FROM #__config;";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return array();

		// create output
		$output = array();
		foreach ($result as $index => $values) {
			$output[$values['name']] = array(
				'default' => $values['systemdefault'],
				'formtype' => $values['formtype'],
				'options' => $values['options'],
				'value' => $this->get($values['name'], false)
			);
		}

		return $output;
	}
}
?>
