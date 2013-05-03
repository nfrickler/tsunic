<!-- | CLASS Issue -->
<?php
/** Issue object
 *
 * This class handles a single issue
 */
class $$$Issue extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
     */
    protected $tags = array(
	'ISSUE__AUTHOR',
	'ISSUE__NAME',
	'ISSUE__DESCRIPTION',
	'ISSUE__QUEUE',
	'ISSUE__MAINTAINER',
	'ISSUE__STATUS',
    );

    /** Get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return $this->getInfo('name').' ('.$this->getInfo('author').')';
    }

    /** Get Queue object
     *
     * @return Queue
     */
    public function getQueue () {
	global $TSunic;
	return $TSunic->get('$$$Queue', $this->getInfo('queue'));
    }
}
?>
