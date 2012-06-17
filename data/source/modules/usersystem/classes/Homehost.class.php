<!-- | Homehost class -->
<?php
include_once '$system$Object.class.php';
class $$$Homehost extends $system$Object {

    /* get SQL query to get object information from database
     *
     * @return sql-query
     */
    protected function loadInfoSql () {
	$sql = "SELECT name as name,
		key as key,
		uri as uri
	    FROM #__homehosts
	    WHERE id = '$this->id';";
	return $sql;
    }

    /* create new homehost object
     *
     * @return bool
     */
    public function create ($name, $key, $uri) {

	// validate input
	if (!$this->isValidName($name)
	    or !$this->isValidKey($key)
	    or !$this->isValidUri($uri)
	) {
	    return false;
	}

	// create object
	$sql = "INSERT INTO #__homehosts
	    SET name = '$name',
		key = '$key',
		link = '$link'
	;";
	return $this->_create($sql);
    }

    /* edit homehost object
     *
     * @return bool
     */
    public function edit ($name, $key, $uri) {

	// validate input
	if (!$this->isValidName($name)
	    or !$this->isValidKey($key)
	    or !$this->isValidUri($uri)
	) {
	    return false;
	}

	// create object
	$sql = "UPDATE #__homehosts
	    SET name = '$name',
		key = '$key',
		link = '$link'
	    WHERE id = '$this->id'
	;";
	return $this->_edit($sql);
    }

    /* delete homehost object
     *
     * @return bool
     */
    protected function delete () {
	$sql = "DELETE FROM #__homehosts
	    WHERE id = '$this->id' ;";
	return $this->_delete($sql);
    }

    /* is valid name?
     * @param string: name to check
     *
     * @return bool
     */
    public function isValidName ($name) {
	return $this->_validate($name, 'string');
    }

    /* is valid key?
     * @param string: key to check
     *
     * @return bool
     */
    public function isValidKey ($key) {
	return $this->_validate($key, 'string');
    }

    /* is valid uri?
     * @param string: uri to check
     *
     * @return bool
     */
    public function isValidUri ($uri) {
	return $this->_validate($uri, 'uri');
    }
}
?>
