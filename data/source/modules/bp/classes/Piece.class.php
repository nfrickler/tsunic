<!-- | CLASS Piece -->
<?php
class $$$Piece extends $system$Object {

    /* all bits of this piece
     * array
     */
    protected $bits;


    /* edit bit from piece
     *
     * @return bool
     */
    protected function editBit ($name, $value) {
	if (!$this->id) return false;
	global $TSunic;
	$Bit = $TSunic->get('$$$Bit', $this->id, $name);
	return true;
    }


    /* add bit to piece
     *
     * @return bool
     */
    protected function addBit ($name, $value) {
	if (!$this->id) return false;
	global $TSunic;
	$Bit = $TSunic->get('$$$Bit', $this->id, $name);
	return true;
    }


    /* get all bits belonging to this piece
     *
     * @return array
     */
    protected function getBit ($name) {
	if (!$this->id) return false;
	global $TSunic;
	$Bit = $TSunic->get('$$$Bit', $this->id, $name);
	return $Bit;
    }

    /* get all bits belonging to this piece
     *
     * @return array
     */
    protected function getBits () {
	if (!$this->id) return false;
	$out = array();

	return $out;
    }


}
?>
