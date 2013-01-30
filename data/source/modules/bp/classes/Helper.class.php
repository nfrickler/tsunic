<!-- | Improve perfomance of bp module -->
<?php
class $$$Helper {

    /* all available Tag objects
     * array
     */
    protected $tags = array();

    /* get all available tags
     * +@param bool: include Id-Tags?
     *
     * @return int
     */
    public function getTags ($incId = false) {

	// load all tags
	if (empty($this->tags)) {
	    global $TSunic;

	    // get tags from database
	    $sql = "SELECT id, name, title, fk_type, isId
		FROM #__tags
		WHERE fk_account = '0'
		    OR fk_account = '".$TSunic->Usr->getInfo('id')."'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);
	    if (!$result) return array();

	    // save in object var
	    $this->tags = array();
	    foreach ($result as $index => $values) {
		$Value = $TSunic->get('$$$Tag', $values['id']);
		$Value->presetInfo($values);
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

    /* convert tag-name to id
     * @param string: name of tag
     *
     * @return int
     */
    public function tag2id ($name) {
	if (is_numeric($name)) return $name;
	$tags = $this->getTags(true);
	return (isset($tags[$name])) ? $tags[$name]->getInfo('id') : 0;
    }

    /* get all objects of certain class (class can be omitted)
     * @param string: name class
     *
     * @return array
     */
    public function getObjects ($class) {
	global $TSunic;

	// query database
	$sql_where = (empty($class)) ? "" : "AND class = '$class'";
	$sql = "SELECT id
	    FROM #__objects
	    WHERE fk_account = '".$TSunic->Usr->getInfo('id')."'
		$sql_where;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get objects
	$out = array();
	foreach ($result as $index => $values) {
	    $Obj = $TSunic->get($class, $values['id']);
	    $Obj->presetInfo($values);
	    $out[] = $Obj;
	}

	return $out;
    }
}
?>
