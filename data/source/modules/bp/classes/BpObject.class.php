<!-- | CLASS BpObject -->
<?php
class $$$BpObject extends $system$Object {

    /* table of objects
     * string
     */
    protected $table = '#__objects';

    /* bits
     * array
     */
    protected $bits;

    /* prior tags
     * array
     */
    protected $tags = array();

    /* ids of idbits
     * array
     */
    protected $idbits;

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!parent::_loadInfo()) return false;

	// load information from all idbits
	$bits = $this->getDefaultBits();
	foreach ($bits as $index => $Value) {
	    if (!$Value or !$Value->getTag()) continue;
	    $cache = explode('__', $Value->getTag()->getInfo('name'));
	    if (count($cache) < 2) continue;

	    $value = $Value->getInfo('value');
	    $Tag = $Value->getTag();
	    if ($Tag->getInfo('name') == 'selection'
		or $Tag->getType()->getInfo('name') == 'radio'
	    ) {
		$value = $Tag->getSelectionValue($value);
	    }
	    $this->info[strtolower($cache[1])] = $value;
	}

	return true;
    }

    /* get object with specified class
     *
     * @return object
     */
    public function getObject () {
	if (!$this->id) return NULL;
	global $TSunic;

	$out = NULL;
	eval('$out = $TSunic->get("'.$this->getInfo('class').'", '.$this->id.');');

	return $out;
    }

    /* create new object
     *
     * @return bool
     */
    public function create () {

	// update database
	global $TSunic;
	$data = array(
	    "class" => get_class($this),
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "dateOfCreation" => "NOW()"
	);
	return $this->_create($data);
    }

    /* delete this object
     *
     * @return bool
     */
    public function delete () {

	// delete all bits linking to this object
	$pieces = $this->getBits();
	foreach ($pieces as $index => $Value) {
	    if (!$Value->delete()) return false;
	}

	return $this->_delete();
    }

    /* add bit to this object
     * @param string: value of new bit
     * +@param int/string: tagname or fk_tag of new bit
     *
     * @return bool
     */
    public function addBit ($value, $fk_tag = 0) {
	global $TSunic;

	// create new Bit object
	$Bit = $TSunic->get('$$$Bit');

	// convert fk_tag to id if neccesary
	if (!is_numeric($fk_tag)) $fk_tag = $this->tag2id($fk_tag);

	// create new Bit
	if (!$Bit->create($this->id, $value, $fk_tag))
	    return false;

	// empty cache
	$this->bits = array();

	return true;
    }

    /* get all bits belonging to this object
     * +@param bool: get all bits (including idbits)?
     *
     * @return array
     */
    public function getBits ($incId = true) {
	if (!$this->id) return array();

	if (!$this->bits) {
	    global $TSunic;
	    $out = array();

	    // load pieces
	    $sql = "SELECT id
		FROM #__bits
		WHERE fk_object = '$this->id'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);
	    if (!$result) return array();

	    // get Bit objects
	    $this->bits = array();
	    foreach ($result as $index => $values) {
		$this->bits[] = $TSunic->get('$$$Bit', $values['id']);
	    }
	}

	// get all?
	if ($incId) return $this->bits;

	// skip idBits
	$out = array();
	foreach ($this->bits as $index => $Value) {

	    $isId = false;
	    foreach ($this->getIdBits() as $in => $val) {
		if ($Value->getInfo('fk_tag') == $val) {
		    $isId = true;
		    break;
		}
	    }

	    if (!$isId) $out[] = $Value;
	}

	return $out;
    }

    /* get all idbits of object
     *
     * @return array
     */
    public function getDefaultBits () {
	global $TSunic;
	$out = array();

	// get default bits
	$bits = $this->getBits();
	foreach ($this->tags as $index => $value) {

	    // exists?
	    $exists = false;
	    foreach ($bits as $in => $Val) {
		if ($Val->getTag()->getInfo('name') == $value) {
		    $exists = true;
		    $out[] = $Val;
		}
	    }

	    // create dummy Bit
	    if (!$exists) {
		$Bit = $TSunic->get('$$$Bit', false, true);
		$fk_tag = $this->tag2id($value);
		if ($fk_tag) {
		    $Bit->setDummy($fk_tag);
		    $out[] = $Bit;
		}
	    }
	}

	return $out;
    }

    /* get all idbits of object
     *
     * @return int
     */
    public function getIdBits () {
	if ($this->idbits) return $this->idbits;
	global $TSunic;

	// get ids of all idbits in $this->tags
	$sql_where = array();
	foreach ($this->tags as $index => $value) {
	    $sql_where[] = "name='$value'";
	}
	$sql = "SELECT id, name
	    FROM #__tags
	    WHERE
	    ".implode(" OR ", $sql_where)."
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return 0;

	// save in object var
	$this->idbits = array();
	foreach ($result as $index => $values) {
	    $this->idbits[$values['name']] = $values['id'];
	}

	return $this->idbits;
    }

    /* convert tag-name to id (idbits only)
     * @param string: name of tag
     *
     * @return int
     */
    public function tag2id ($name) {
	$idbits = $this->getIdBits();
	return (isset($idbits[$name])) ? $idbits[$name] : 0;
    }

    /* get all objects of this class
     *
     * @return bool
     */
    public function getAll () {
	global $TSunic;
	$out = array();

	// update database
	$sql = "SELECT id
	    FROM #__objects
	    WHERE class = '".get_class($this)."'
		AND fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get objects
	foreach ($result as $index => $values) {
	    $out[] = $TSunic->get(get_class($this), $values['id']);
	}

	return $out;
    }

    /* check, if fk_tag is valid
     * @param int: fk_tag
     *
     * @return bool
     */
    public function isValidFkTag ($fk_tag) {
	return (!$fk_tag or $this->_validate($fk_tag, 'int')
	    and $this->_isObject('#__tags', $fk_tag)
	) ? true : false;
    }
}
?>
