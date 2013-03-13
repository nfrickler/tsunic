<!-- | CLASS Issue -->
<?php
class $$$Issue extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'ISSUE__AUTHOR',
	'ISSUE__NAME',
	'ISSUE__DESCRIPTION',
	'ISSUE__QUEUE',
	'ISSUE__MAINTAINER',
	'ISSUE__STATUS',
    );

    /* get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return $this->getInfo('name').' ('.$this->getInfo('author').')';
    }

    /* get Queue object
     *
     * @return object
     */
    public function getQueue () {
	global $TSunic;
	return $TSunic->get('$$$Queue', $this->getInfo('queue'));
    }
}
?>
