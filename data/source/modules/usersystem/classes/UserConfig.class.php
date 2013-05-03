<!-- | CLASS UserConfig -->
<?php
/** Manage user configuration
 *
 * This class handles the user configuration
 */
class $$$UserConfig {

    /** Account ID
     * @var int $fk_account
     */
    protected $fk_account;

    /** Runtime config
     * @var array $runtime
     */
    protected $runtime;

    /** Userconfig cache
     * @var array $configcache
     */
    protected $configcache = array();

    /** Constructor
     * @param int $fk_account
     *	fk account
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

    /** Get config of user
     * @param string $name
     *	Name of config
     * @param bool $returnDefault
     *	Return default, if no userconfig?
     *
     * @return mix
     */
    public function get ($name, $returnDefault = true) {
	if (isset($this->configcache[$name])) return $this->configcache[$name];
	global $TSunic;

	// try to get user config
	$sql = "SELECT value
	    FROM #__$usersystem$userconfig
	    WHERE fk_account = '$this->fk_account'
		AND fk_config = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return NULL;
	if (!empty($result)) {
	    $this->configcache[$name] = $result[0]['value'];
	    return $result[0]['value'];
	}

	// is a config value really OR is guest?
	if (!$this->exists($name) or $this->fk_account == 2)
	    return $this->getRuntime($name);

	// return default value
	return ($returnDefault) ? $this->getDefault($name) : NULL;
    }

    /** Get runtime config
     * @param string $name
     *	Name of config
     *
     * @return mix
     */
    public function getRuntime ($name) {
	return (isset($this->runtime[$name]))
	    ? $this->runtime[$name] : NULL;
    }

    /** Set runtime config
     * @param string $name
     *	Name of config
     * @param mix $value
     *	Value of config
     *
     * @return bool
     */
    public function setRuntime ($name, $value) {
	$this->runtime[$name] = $value;
	$_SESSION['$$$UserConfig__runtime'] = $this->runtime;
	return true;
    }

    /** Get default config
     * @param string $name
     *	Name of config
     *
     * @return mix
     */
    public function getDefault ($name) {
	global $TSunic;

	// try to get default config
	$sql = "SELECT systemdefault
	    FROM #__$usersystem$config
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return NULL;
	if (!empty($result)) {
	    return $result[0]['systemdefault'];
	}

	// config name does not exist
	return NULL;
    }

    /** Set default config
     * @param string $name
     *	Name of config
     * @param string $value
     *	Value of config
     * @param bool $isSystem
     *	Is system configuration?
     *
     * @return bool
     */
    public function setDefault ($name, $value, $isSystem = true) {
	global $TSunic;

	// access?
	if (!$TSunic->Usr->access('$$$editAllConfig')) return false;

	// update database
	$sql = "INSERT INTO #__$usersystem$config
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

    /** Does config name exist?
     * @param string $name
     *	Name of config
     *
     * @return bool
     */
    public function exists ($name) {
	return ($this->getDefault($name) != NULL) ? true : false;
    }

    /** Set value
     * @param string $name
     *	Name of config
     * @param mix $value
     *	Value to set (NULL means default value)
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
	$sql = "INSERT INTO #__$usersystem$userconfig
	    SET fk_config = '$name',
		fk_account = '$this->fk_account',
		value = '$value'
	    ON DUPLICATE KEY UPDATE value = '$value';";
	return $TSunic->Db->doInsert($sql);
    }

    /** Delete userconfig
     * @param string $name
     *	Name of config
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
	$sql = "DELETE FROM #__$usersystem$userconfig
		WHERE fk_account = '$this->fk_account'
		    AND fk_config = '$name';";
	return $TSunic->Db->doDelete($sql);
    }

    /** Get all real config names and values (no system config)
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
		FROM #__$usersystem$config
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

    /** Get configtype
     * @param string $name
     *	Name of config
     *
     * @return mix
     */
    public function getType ($name) {
	global $TSunic;

	// try to get default config
	$sql = "SELECT configtype
	    FROM #__$usersystem$config
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return NULL;

	return ($result and $result[0]['configtype'])
	    ? $result[0]['configtype']
	    : 'normal';
    }
}
?>
