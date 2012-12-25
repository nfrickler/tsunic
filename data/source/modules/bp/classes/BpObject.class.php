<!-- | CLASS BpObject -->
<?php
class $$$BpObject extends $system$Object {

    /* TAG of this object
     * string
     */
    protected $tag = "ID";

    /* pieces
     * array
     */
    protected $pieces;

    /* load Key of pieces
     *
     * @return Object
     */
    protected function getPiecesKey () {
	global $TSunic;
	if (!$this->_Key) $this->_Key =
	    $TSunic->get('$$$Key', array($this->table, 0));
	return $this->_Key;
    }

    /* add piece to this object
     *
     * @return bool
     */
    protected function addPiece ($fk_piece = 0, $name = false, $value = false) {
	global $TSunic;
    
	// get Piece object
	$Piece = $TSunic->get('$$$Piece', $fk_piece);
	if (!$fk_piece AND !$Piece->create()) return NULL;

	// add bits
	if (!$Piece->addBit($this->tag, $this->id) OR !($name AND $Piece->addBit($name, $value))) {
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
    protected function getPieces () {
	if (!$this->id) return false;
	if ($this->pieces) return $this->pieces;
	$out = array();

	// get Key
	$Key = $this->getPiecesKey();

	// load pieces
	$sql = "SELECT pieces.id
	    FROM #__bits as bits, #__pieces as pieces
	    WHERE pieces.id = bits.fk_pieces
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

}
?>
