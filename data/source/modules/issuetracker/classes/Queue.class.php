<!-- | CLASS Queue -->
<?php
/** Queue object
 *
 * This objects handles queues, where issues can be put in
 */
class $$$Queue extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
     */
    protected $tags = array(
	'QUEUE__NAME',
	'QUEUE__DESCRIPTION',
    );

    /** Get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return ($this->id) ? $this->getInfo('name') : '{CLASS__QUEUE__NAMEALL}';
    }

    /** Get all issues in this queue
     *
     * @return array
     */
    public function getIssues () {
	global $TSunic;
	$Helper = $TSunic->get('$bp$Helper');
	$all_issues = $Helper->getObjects('$$$Issue');

	// return all issues if id=0
	if (!$this->id) return $all_issues;

	$issues = array();
	foreach ($all_issues as $index => $Value) {
	    if ($Value->getInfo('queue') == $this->getInfo('id')) {
		$issues[] = $Value;
	    }
	}

	return $issues;
    }
}
?>
