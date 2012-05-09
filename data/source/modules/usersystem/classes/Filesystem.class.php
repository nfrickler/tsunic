<!-- | Filesystem class -->
<?php
include_once '$$$FsDirectory.class.php';
class $$$Filesystem extends $$$FsDirectory {

	/* constructor
	 */
	public function __construct ($id = 0) {
		$this->id = 0;
	}

	/* get information about object
	 * +@param string/bool: name of info (true will return $this->info)
	 * +@param bool: force update of object infos?
	 *
	 * @return mix
	 */
	public function getInfo ($name = true, $update = false) {
		global $TSunic;

		switch ($name) {
			case 'name':
				return '{CLASS__FILESYSTEM__NAME}';
			case 'fk_account':
				return $TSunic->Usr->getInfo('id');
			case 'fk_parent':
				return false;
		}

		return NULL;
	}

	/* create new directory
	 * @param string: name
	 * +@param int: fk of parent
	 *
	 * @return bool
	 */
	public function create ($name, $fk_parent = 0) {
		return false;
	}

	/* edit directory
	 * @param string: new name
	 * +@param int: fk of parent
	 *
	 * @return bool
	 */
	public function edit ($name, $fk_parent) {
		return false;
	}

	/* delete directory
	 *
	 * @return bool
	 */
	public function delete () {
		return false;
	}

	/* get parent object
	 *
	 * @return OBJECT
	 */
	public function getParent () {
		return false;
	}
}
?>
