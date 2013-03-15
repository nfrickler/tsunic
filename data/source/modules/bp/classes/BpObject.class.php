<!-- | CLASS BpObject -->
<?php
class $$$BpObject extends $system$Object {

    /* table of objects
     * string
     */
    protected $table = '#__$bp$objects';

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

    /* get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return 'Unknown';
    }

    /* get value to be showed
     * @param string/int: id or name of tag
     *
     * @return mix
     */
    public function get2show ($fk_tag) {
	$Bit = $this->getBit($fk_tag);
	return $Bit->get2show();
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
	    "class" => $this->getClass(),
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
     * @return false/Bit object
     */
    public function addBit ($value, $fk_tag = 0) {
	global $TSunic;

	// create new Bit object
	$Bit = $this->_getNewBit();

	// convert fk_tag to id if neccesary
	$fk_tag = $this->tag2id($fk_tag);

	// create new Bit
	if (!$Bit->create($this->id, $value, $fk_tag))
	    return false;

	// update dateOfChange
	$this->_edit(array('dateOfUpdate' => 'NOW()'));

	// empty cache
	$this->bits = array();

	return $Bit;
    }

    /* add new bit or edit existing one
     * @param int: fk_tag
     * @param int: fk_bit
     * @param mix: new value
     *
     * @return bool
     */
    public function addeditBit ($fk_tag, $fk_bit, $value) {

	// update dateOfChange
	$this->_edit(array('dateOfUpdate' => 'NOW()'));

	// exists already?
	if ($fk_bit) {
	    // edit
	    global $TSunic;
	    $Bit = $TSunic->get('$bp$Bit', $fk_bit);
	    return $Bit->edit($value);
	} else {
	    // add
	    return $this->addBit($value, $fk_tag);
	}

	return false;
    }

    /* add new bit or edit existing one (unique Tag per object)
     * @param int: fk_tag
     * @param mix: new value
     *
     * @return bool
     */
    public function saveByTag ($fk_tag, $value) {

	// get Bit
	$Bit = $this->getBit($fk_tag, true);

	// save value and return
	return ($Bit and $Bit->edit($value)) ? true : false;
    }

    /* get new empty Bit object
     *
     * @return object
     */
    protected function _getNewBit () {
	global $TSunic;
	$Bit = $TSunic->get('$$$Bit', false, true);
	//$Bit->pushTo($this->_getKey()->getInfo('fk_account'));
	return $Bit;
    }

    /* get first bit with specified tag
     * @param string/int: id or name of tag
     * +@param bool: add Bit if not exists?
     *
     * @return Bit
     */
    public function getBit ($tag, $add = false) {
	$Helper = $this->getHelper();
	$tag = $Helper->tag2id($tag);

	// get all Bits
	$bits = $this->getBits(true);

	// get first Bit that has specified Tag
	$Bit = NULL;
	foreach ($bits as $index => $Value) {
	    if ($Value->getInfo('fk_tag') == $tag) $Bit = $Value;
	}

	// get (empty) Bit if nothing found
	if (empty($Bit)) {
	    global $TSunic;
	    if ($add) {
		$Bit = $this->addBit(0, $tag);
	    } else {
		$Bit = $this->_getNewBit();
		$Bit->presetInfo(array('fk_tag' => $tag, 'fk_obj' => $this->id));
	    }
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
		FROM #__$bp$bits
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
		$Bit = $this->_getNewBit();
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

    /* get Bits of this object with a certain tag
     * @param int: tag to search for
     *
     * @return array
     */
    public function getByTag ($fk_tag) {
	$fk_tag = $this->tag2id($fk_tag);
	$bits = $this->getBits(true);

	// search for bits with certain tag
	$out = array();
	foreach ($bits as $index => $Value) {
	    if ($Value->getTag()->getInfo('id') == $fk_tag)
		$out[] = $Value;
	}

	return $out;
    }

    /* get first Bit of this object with a certain tag
     * @param int: tag to search for
     *
     * @return object
     */
    public function getFirstByTag ($fk_tag) {
	$all = $this->getByTag($fk_tag);
	return array_shift($all);
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

    /* check, if fk_tag is valid
     * @param int: fk_tag
     *
     * @return bool
     */
    public function isValidFkTag ($fk_tag) {
	return (!$fk_tag or $this->_validate($fk_tag, 'int')
	    and $this->_isObject('#__$bp$tags', $fk_tag)
	) ? true : false;
    }

    /* get class name of this object
     *
     * @return string
     */
    public function getClass () {
	return get_class($this);
    }

    /* give someone access to this object (share bits!)
     * @param array/int: list of users with access (array('id' => 'writable?'))
     *
     * @return bool
     */
    public function shareWith ($access) {
	global $TSunic;

	// share all bits with other users
	$bits = $this->getBits(true);
	foreach ($bits as $index => $Value) {
	    if (!$Value->shareWith($access)) {
		$TSunic->Log->log(3, "BpObject::pushTo: Failed to push Bit!");
		return false;
	    }
	}

	return parent::shareWith($access);
    }

    /* push this object to other user (move bits!)
     * @param int: id of other user
     *
     * @return bool
     */
    public function pushTo ($fk_account) {
	global $TSunic;

	// push all bits to other user
	$bits = $this->getBits(true);
	foreach ($bits as $index => $Value) {
	    if (!$Value->pushTo($fk_account)) {
		$TSunic->Log->log(3, "BpObject::pushTo: Failed to push Bit!");
		return false;
	    }
	}

	return parent::pushTo($fk_account);
    }
}
?>
