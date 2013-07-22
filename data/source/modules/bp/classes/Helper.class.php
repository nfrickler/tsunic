<!-- | CLASS Helper -->
<?php
/** Helper class
 *
 * This class offers some helper methods
 */
class $$$Helper {

    /** All available Tag objects
     * @var array $tags
     */
    protected $tags = array();

    /** Get all available tags
     * @param bool $incId
     *	Include Id-Tags?
     *
     * @return int
     */
    public function getTags ($incId = false) {

	// load all tags
	if (empty($this->tags)) {
	    global $TSunic;

	    // get tags from database
	    $sql = "SELECT id, name, title, fk_type, isId
		FROM #__$bp$tags
		WHERE fk_account = '0'
		    OR fk_account = '".$TSunic->Usr->getIdGuest()."'
		    OR fk_account = '".$TSunic->Usr->getInfo('id')."'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);
	    if (!$result) return array();

	    // save in object var
	    $this->tags = array();
	    foreach ($result as $index => $values) {
		$Value = $TSunic->get('$$$Tag', $values['id']);
		$Value->setMulti($values);
		$this->tags[$values['name']] = $Value;
	    }
	}

	// include Id-Tags?
	if ($incId) return $this->tags;

	// filter Id-Tags
	$out = array();
	foreach ($this->tags as $index => $Value) {
	    if (!$Value->getInfo('isId')) $out[$Value->getInfo('name')] = $Value;
	}

	return $out;
    }

    /** Convert tagname to id
     * @param string $name
     *	Name of tag
     *
     * @return int
     */
    public function tag2id ($name) {
	if (is_numeric($name)) return $name;
	$tags = $this->getTags(true);
	if (isset($tags[$name])) {
	    return $tags[$name]->getInfo('id');
	} else {
	    global $TSunic;
	    $TSunic->Log->log(
		3, "bp::Helper::tag2id: ERROR No tag '$name' found!"
	    );
	    return 0;
	}
    }

    /** Get all objects of certain class (class can be omitted)
     * @param string $class
     *	Name class
     * @param string $sql_where
     *	sql-where statements
     *
     * @return array
     */
    public function getObjects ($class = '', $sql_where = '') {
	global $TSunic;

	// query database
	if (!empty($sql_where)) $sql_where = " AND ".$sql_where;
	if (!empty($class)) $sql_where = " AND class= '$class'".$sql_where;
	$sql = "SELECT objects.id
	    FROM #__$bp$objects as objects,
		#__$system$keys as keytable
	    WHERE keytable.fk_table = '#__$bp$objects'
		AND objects.id = keytable.fk_id
		AND (keytable.fk_account = '".$TSunic->Usr->getInfo('id')."'
		OR keytable.fk_account = '".$TSunic->Usr->getIdGuest()."')
		$sql_where
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get objects
	$out = array();
	if (empty($class)) $class = '$$$BpObject';
	foreach ($result as $index => $values) {
	    $Obj = $TSunic->get($class, $values['id']);
	    if (!$Obj) continue;
	    $Obj->setMulti($values);
	    $out[$values['id']] = $Obj;
	}

	return $out;
    }

    /** Get all values from Bit form
     *
     * @return array
     */
    public function getFormValues () {
	global $TSunic;

	// get all posts
	$posts = $TSunic->Input->post(true);

	// get all fk_tags, fk_bits and values
	$fk_tags = array();
	$fk_bits = array();
	$values = array();
	foreach ($posts as $index => $value) {
	    $cache = explode('__', $index);
	    if (count($cache) < 4 or $cache[1] != 'formBit') continue;

	    // get values
	    switch ($cache[2]) {
		case 'fk_tag':
		    $fk_tags[$cache[3]] = $value;
		    break;
		case 'fk_bit':
		    $fk_bits[$cache[3]] = $value;
		    break;
		case 'value':
		    // get multivalues
		    if ($cache[3] == "multi" and count($cache) >= 5) {
			if (!isset($values[$cache[4]]) or !is_array($values[$cache[4]]))
			    $values[$cache[4]] = array();
			$values[$cache[4]][$cache[5]] = $value;
		    } else {
			$values[$cache[3]] = $value;
		    }
		    break;
		default:
		    // skip
		    break;
	    }
	}

	// sum up
	$out = array();
	foreach ($fk_tags as $index => $value) {
	    $Tag = $TSunic->get('$$$Tag', $value);
	    $value_value = (isset($values[$index])) ? $values[$index] : 0;

	    // sum multiline
	    if (is_array($value_value)) {

		switch ($Tag->getType()->getInfo('name')) {
		    case 'date':
			if (!isset($value_value['d'], $value_value['m'],
			    $value_value['y']
			)) {
			    // error: missing value
			    $TSunic->Log->log(3, "bp::Helper::getFormValues: ".
				"Missing multi value!");
			}

			// create timestamp
			$value_value = mktime(
			    0,0,0, $value_value['m'],
			    $value_value['d'], $value_value['y']
			);

			break;
		    case 'timestamp':
			if (!isset($value_value['d'], $value_value['m'],
			    $value_value['y'], $value_value['h'],
			    $value_value['i'], $value_value['s']
			)) {
			    // error: missing value
			    $TSunic->Log->log(3, "bp::Helper::getFormValues: ".
				"Missing multi value!");
			}

			// create timestamp
			$value_value = mktime(
			    $value_value['h'], $value_value['i'],
			    $value_value['s'], $value_value['m'],
			    $value_value['d'], $value_value['y']
			);

			break;
		    default:
			// error
			$TSunic->Log->log(3, "bp::Helper::getFormValues: ".
			    "Unknown multi-value type!");
			break;
		}
	    }

	    $out[] = array(
		'fk_tag' => $value,
		'fk_bit' => (isset($fk_bits[$index])) ? $fk_bits[$index] : 0,
		'value' => $value_value
	    );
	}

	return $out;
    }

    /** Are valid form values?
     * @param array $form
     *	Form values
     *
     * @return array
     */
    public function validateFormValues ($form) {
	global $TSunic;

	// validate input
	foreach ($form as $index => $values) {
	    $Tag = $TSunic->get('$bp$Tag', $this->tag2id($values['fk_tag']));
	    if (!$Tag->isValidValue($values['value'])) {
		$values['tagname'] = $Tag->getInfo('name');
		return $values;
	    }
	}

	return array();
    }
}
?>
