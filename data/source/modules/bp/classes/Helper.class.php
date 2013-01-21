<!-- | Improve perfomance of bp module -->
<?php
class $$$Helper {

    /* all available Tag objects
     * array
     */
    protected $tags = array();

    /* get all available tags
     *
     * @return int
     */
    public function getTags () {
	if ($this->tags) return $this->tags;
	global $TSunic;

	// get tags from database
	$sql = "SELECT id, name, title, fk_type
	    FROM #__tags
	    WHERE fk_account = '0'
		OR fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// save in object var
	$this->tags = array();
	foreach ($result as $index => $values) {
	    $Value = $TSunic->get('$$$Tag', $values['id']);
	    $Value->presetInfo($values);
	    $this->tags[$values['name']] = $Value;
	}

	return $this->tags;
    }

    /* convert tag-name to id
     * @param string: name of tag
     *
     * @return int
     */
    public function tag2id ($name) {
	$tags = $this->getTags();
	return (isset($tags[$name])) ? $tags[$name]->getInfo('id') : 0;
    }
}
?>
