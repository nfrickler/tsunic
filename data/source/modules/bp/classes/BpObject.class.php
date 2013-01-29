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

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!parent::_loadInfo()) return false;

	// load information from all default bits
	$bits = $this->getDefaultBits();
	foreach ($bits as $index => $Value) {
	    if (!$Value or !$Value->getTag()) continue;
	    $cache = explode('__', $Value->getTag()->getInfo('name'));
	    if (count($cache) < 2) continue;

	    $value = $Value->getInfo('value');
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
	$Bit = $TSunic->get('$$$Bit', false, true);

	// convert fk_tag to id if neccesary
	$fk_tag = $this->tag2id($fk_tag);

	// create new Bit
	if (!$Bit->create($this->id, $value, $fk_tag))
	    return false;

	// empty cache
	$this->bits = array();

	return true;
    }

    /* get first bit with specified tag
     * @param string/int: id or name of tag
     *
     * @return Bit
     */
    public function getBit ($tag) {
	$Helper = $this->getHelper();
	$tag = $Helper->tag2id($tag);

	// get all Bits
	$bits = $this->getBits(true);

	// get first Bit that has specified Tag
	$Bit = NULL;
	foreach ($bits as $index => $Value) {
	    if ($Value->getInfo('fk_tag') == $tag) $Bit = $Value;
	}

	// get empty Bit if nothing found
	if (empty($Bit)) {
	    global $TSunic;
	    $Bit = $TSunic->get('$bp$Bit', false, true);
	    $Bit->presetInfo(array('fk_tag' => $tag, 'fk_obj' => $this->id));
	}

	return $Bit;
    }

    /* get all bits belonging to this object
     * +@param bool: get all bits (including default bits?)
     *
     * @return array
     */
    public function getBits ($incId = false) {
	if (!$this->id) return array();

	if (!$this->bits) {
	    global $TSunic;
	    $out = array();

	    // load pieces
	    $sql = "SELECT id, fk_object, fk_tag
		FROM #__bits
		WHERE fk_object = '$this->id'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);
	    if (!$result) return array();

	    // get Bit objects
	    $this->bits = array();
	    foreach ($result as $index => $values) {
		$Bit = $TSunic->get('$$$Bit', $values['id']);
		$Bit->presetInfo($values);
		$this->bits[] = $Bit;
	    }
	}

	// get all?
	if ($incId) return $this->bits;

	// skip idBits
	$out = array();
	foreach ($this->bits as $index => $Value) {

	    $isId = false;
	    foreach ($this->getDefaultTags() as $in => $Val) {
		if ($Value->getInfo('fk_tag') == $Val->getInfo('id')) {
		    $isId = true;
		    break;
		}
	    }

	    if (!$isId) $out[] = $Value;
	}

	return $out;
    }

    /* get all default bits of object
     *
     * @return array
     */
    public function getDefaultBits () {
	global $TSunic;
	$out = array();

	// get default bits
	$bits = $this->getBits(true);
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

    /* get all default tags of this object
     *
     * @return int
     */
    public function getDefaultTags () {

	// get all tags
	$tags = $this->getHelper()->getTags(true);

	// filter only those requested
	$out = array();
	foreach ($this->tags as $index => $value) {
	    if (isset($tags[$value])) $out[] = $tags[$value];
	}

	return $out;
    }

    /* get Helper object
     *
     * @return Helper object
     */
    public function getHelper () {
	global $TSunic;
	return $TSunic->get('$$$Helper');
    }

    /* convert tag-name to id
     * @param string: name of tag
     *
     * @return int
     */
    public function tag2id ($name) {
	return $this->getHelper()->tag2id($name);
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
