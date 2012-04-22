<!-- | UserConfig class -->
<?php
class $$$UserConfig {

	/* account ID
	 * int
	 */
	protected $fk_account;

	/* runtime config
	 * array
	 */
	protected $runtime;

	/* constructor
	 * @param int: fk account
	 */
	public function __construct ($fk_account) {
		$this->fk_account = $fk_account;

		# load runtime config
		$this->runtime = array();
		if (isset($_SESSION['$$$UserConfig__runtime'])) {
			$this->runtime = $_SESSION['$$$UserConfig__runtime'];
		}
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
		if (!empty($result)) return $result[0]['value'];

		// is a config value really OR is guest?
		if (!$this->exists($name) or $this->fk_account == 2)
			return $this->getRuntime($name);

		// return default value
		return ($returnDefault) ? $this->getDefault($name) : NULL;
	}

	/* get runtime config
	 * @param string: name of config
	 *
	 * @return mix
	 */
	public function getRuntime ($name) {
		return (isset($this->runtime[$name]))
			? $this->runtime[$name] : NULL;
	}

	/* set runtime config
	 * @param string: name of config
	 * @param mix: value of config
	 *
	 * @return bool
	 */
	public function setRuntime ($name, $value) {
		$this->runtime[$name] = $value;
		$_SESSION['$$$UserConfig__runtime'] = $this->runtime;
		return true;
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

	/* set default config
	 * @param string: name of config
	 * @param string: value of config
	 * +@param bool: is system config?
	 *
	 * @return bool
	 */
	public function setDefault ($name, $value, $isSystem = true) {
		global $TSunic;

		// update database
		$sql = "INSERT INTO #__config
			SET name = '$name',
				systemdefault = '$value',
				isSystem = '".($isSystem ? '1' : '0')."',
				dateOfCreation = NOW()
			ON DUPLICATE KEY UPDATE
				systemdefault = '$value' AND
				isSystem = '".($isSystem ? '1' : '0')."'
		;";
		$return = $TSunic->Db->doInsert($sql);

		return true;
	}

	/* does config name exist?
	 * @param string: name of config
	 *
	 * @return bool
	 */
	public function exists ($name) {
		return ($this->getDefault($name) != NULL) ? true : false;
	}

	/* is system config?
	 * @param string: name of config
	 *
	 * @return bool
	 */
	public function isSystem ($name) {
		global $TSunic;
		$sql = "SELECT name
			FROM #__config
			WHERE name = '$name'
				AND isSystem = '1';";
		return ($TSunic->Db->doSelect($sql)) ? true : false;
	}

	/* set value
	 * @param string: name of config
	 * @param mix: value to set (NULL means default value)
	 *
	 * @return bool
	 */
	public function set ($name, $value) {

		// is system config?
		if ($this->isSystem($name)) return false;

		// is config really OR is guest?
		if (!$this->exists($name) or $this->fk_account == 2)
			return $this->setRuntime($name, $value);

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

	/* get all real config names and values (no system config)
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
			FROM #__config
			WHERE isSystem = '0';";
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
