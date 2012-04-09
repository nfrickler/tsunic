<!-- | not used yet -->
<?php
class $$$Object {

	/* object ID
	 * int
	 */
	protected $id;

	/* information about object
	 * array
	 */
	protected $info;

	/* constructor
	 * +@param int: Object ID
	 */
	public function __construct ($id = 0) {

		// save input
		$this->id = $id;

		return;
	}

	/* get information about object
	 * +@param string/bool: name of info (true will return $this->info)
	 * +@param bool: force update of object infos?
	 *
	 * @return mix
	 */
	public function getInfo ($name = true, $update = false) {
		global $TSunic;

		// check, if is object ID
		if (!$this->id) return false;

		// onload data
		if ($update or empty($this->info)) loadInfo();

		// return requested info
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];

		return NULL;
	}

	/* load information about object
	 */
	protected function loadInfo () {
		global $TSunic;

		// get data from database
		$result = $TSunic->Db->doSelect($this->loadInfoSql());
		$this->info = ($result_0) ? $result_0[0] : array();

		// add object ID to array
		$this->info['id'] = $this->id;
	}

	/* get SQL query to get object information from database
	 *
	 * @return sql-query
	 */
	protected function loadInfoSql () {
		// to be used in child objects
		return "";
	}

	/* create new object
	 * @param string: sql query to add entry in database
	 *
	 * @return bool
	 */
	protected function _create ($sql) {
		global $TSunic;

		// add entry in database
		$result = $TSunic->Db->doInsert($sql);
		if (!$result) return false;

		// save object ID
		$this->id = mysql_insert_id();

		return true;
	}

	/* edit object
	 * @param string: sql query to edit object in database
	 *
	 * @return bool
	 */
	protected function _edit ($sql) {
		global $TSunic;

		// edit object in database
		$result = $TSunic->Db->doUpdate($sql);

		return ($result) ? true : false;
	}

	/* delete object
	 * @param string: sql query to delete object in database
	 *
	 * @return bool
	 */
	protected function _delete ($sql) {
		global $TSunic;

		// delete object in database
		$result = $TSunic->Db->doDelete($sql);
		if (!$result) return false;

		// invalidate object
		$this->id = 0;
		$this->loadInfo();

		return true;
	}

	/* check, if this object is valid
	 *
	 * @return bool
	 */
	public function isValid () {

		// object is considered valid, if it has an ID and at least
		// one more information in $this->info
		if ($this->getInfo() and count($this->getInfo() > 1))
			return true;

		return false;
	}

	/* check, if value has correct type
	 * @param mix: value
	 * @param string: requested type of value
	 *
	 * @return bool
	 */
	protected function _validate ($value, $type) {
		include_once '$$$Validator.class.php';

		// validate type
		switch ($type) {
			case 'string':
				return $$$Valiator::isString($value);
			case 'int':
				return $$$Valiator::isInt($value);
			case 'uri':
				return $$$Valiator::isUri($value);
			case 'email':
				return $$$Valiator::isEMail($value);
			case 'password':
				return $$$Valiator::isPassword($value);
		}

		return false;
	}
}
?>
