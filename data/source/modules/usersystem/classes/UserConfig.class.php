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
	global $TSunic;

	// access?
	if ($fk_account != $TSunic->Usr->getInfo('id')
	    and !$TSunic->Usr->access('$$$seeAllConfig')) {
	    return false;
	}
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

	// access?
	if (!$TSunic->Usr->access('$$$editAllConfig')) return false;

	// update database
	$sql = "INSERT INTO #__config
	    SET name = '$name',
		systemdefault = '$value',
		configtype = '".($isSystem ? 'system' : '0')."',
		dateOfCreation = NOW()
	    ON DUPLICATE KEY UPDATE
		systemdefault = '$value' AND
		configtype = '".($isSystem ? 'system' : '0')."'
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

    /* set value
     * @param string: name of config
     * @param mix: value to set (NULL means default value)
     *
     * @return bool
     */
    public function set ($name, $value) {
	global $TSunic;

	// access?
	if (($this->fk_account != $TSunic->Usr->getInfo('id') or
	    $this->getType($name) != 'normal')
	    and !$TSunic->Usr->access('editAllAccess')) {
	    return false;
	}

	// system config?
	if ($this->getType($name) == 'system') return false;

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

	// access?
	if (($this->fk_account != $TSunic->Usr->getInfo('id') or
	    $this->getType($name) != 'normal')
	    and !$TSunic->Usr->access('editAllAccess')) {
	    return false;
	}

	// update database
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
		    configtype,
		    formtype,
		    options
		FROM #__config
		WHERE NOT configtype = 'system' " .
		($TSunic->Usr->access('$$$editAllConfig')
		    ? "" : "AND NOT configtype = 'hidden';");
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return array();

	// create output
	$output = array();
	foreach ($result as $index => $values) {
	    if (!$values['configtype']) $values['configtype'] = 'normal';
	    $output[$values['name']] = array(
		'default' => $values['systemdefault'],
		'configtype' => $values['configtype'],
		'formtype' => $values['formtype'],
		'options' => $values['options'],
		'value' => $this->get($values['name'], false)
	    );
	}

	return $output;
    }

    /* get configtype
     * @param string: name of config
     *
     * @return mix
     */
    public function getType ($name) {
	global $TSunic;

	// try to get default config
	$sql = "SELECT configtype
	    FROM #__config
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return NULL;

	return ($result and $result[0]['configtype'])
	    ? $result[0]['configtype']
	    : 'normal';
    }
}
?>
