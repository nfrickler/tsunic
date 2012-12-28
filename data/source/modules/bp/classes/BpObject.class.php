<!-- | CLASS BpObject -->
<?php
class $$$BpObject extends $system$Object {

    /* TAG of this object
     * string
     */
    protected $tag = "ID";

    /* tags to be connected with this object
     * array
     */
    protected $tags = array();

    /* pieces
     * array
     */
    protected $pieces;

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!parent::_loadInfo()) return false;

	// load all tags in info array
	// use name after first __
	// TODO: enhance
	$pieces = $this->getPieces();
	foreach ($pieces as $index => $Value) {
	    $bits = $Value->getBits();
	    foreach ($bits as $in => $Val) {
		foreach ($this->tags as $i => $v) {
		    if ($Val->getInfo('name') == $v) {
			$name = substr($Val->getInfo('name'), (strpos($Val->getInfo('name'), '__')+2));
			$this->info[strtolower($name)] = $Val->getInfo('value');
			break;
		    }
		}
	    }
	}

	return true;
    }

    /* load Key of pieces
     *
     * @return Object
     */
    protected function getPiecesKey () {
	global $TSunic;
	if (!$this->_Key) $this->_Key =
	    $TSunic->get('$system$Key', array('#__pieces', 1));
	return $this->_Key;
    }

    /* add piece to this object
     *
     * @return bool
     */
    public function addPiece ($fk_piece = 0, $name = false, $value = false) {
	global $TSunic;

	// get Piece object
	$Piece = $TSunic->get('$$$Piece', $fk_piece);
	if (!$fk_piece AND !$Piece->create()) return false;

	// add bits
	if (!$Piece->addBit($this->tag, $this->id) OR ($name AND !$Piece->addBit($name, $value))) {
	    return false;
	}

	// clear pieces cache
	$this->pieces = array();

	return true;
    }

    /* get all pieces belonging to this object
     *
     * @return bool
     */
    public function getPieces () {
	if (!$this->id) return false;
	if ($this->pieces) return $this->pieces;
	global $TSunic;
	$out = array();

	// get Key
	$Key = $this->getPiecesKey();

	// load pieces
	$sql = "SELECT pieces.id
	    FROM #__bits as bits, #__pieces as pieces
	    WHERE pieces.id = bits.fk_piece
		AND bits._name_ = '".$Key->encrypt($this->tag)."'
		AND bits._value_ = '".$Key->encrypt($this->id)."'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$this->pieces = array();
	foreach ($result as $index => $values) {
	    $this->pieces[] = $TSunic->get('$$$Piece', $values['id']);
	}

	return $this->pieces;
    }

    /* delete this object
     *
     * @return bool
     */
    public function delete () {

	// delete all pieces linking to this object
	$pieces = $this->getPieces();
	foreach ($pieces as $index => $Value) {
	    if (!$Value->delete()) return false;
	}

	// keep key!
	return $this->_delete();
    }
}
?>
