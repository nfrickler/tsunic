<!-- | CLASS Queue -->
<?php
class $$$Queue extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'QUEUE__NAME',
	'QUEUE__DESCRIPTION',
    );

    /* get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return $this->getInfo('name');
    }
}
?>
