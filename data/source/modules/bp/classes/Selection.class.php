<!-- | CLASS Selection -->
<?php
/** Selection objects
 *
 * Bits of Type "selection" will be handled by this object.
 * Every selection has some options to choose from.
 */
class $$$Selection extends $system$Object {

    /** Table
     * @var string $table
     */
    protected $table = "#__$bp$selections";

    /** Create new selection
     * @param int $fk_tag
     *	fk_tag
     * @param string $name
     *	Name
     * @param string $description
     *	Description
     *
     * @return bool
     */
    public function create ($fk_tag, $name, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidName($name)
	    OR !$this->isValidFkTag($fk_tag)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'fk_tag' => $fk_tag,
	    'name' => $name,
	    'description' => $description
	);
	return $this->_create($data);
    }

    /** Edit type
     * @param int $fk_tag
     *	fk_tag
     * @param string $name
     *	Name
     * @param string $description
     *	Description
     *
     * @return bool
     */
    public function edit ($fk_tag, $name, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidName($name)
	    OR !$this->isValidFkTag($fk_tag)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'fk_tag' => $fk_tag,
	    'name' => $name,
	    'description' => $description
	);
	return $this->_edit($data);
    }

    /** Delete Tag
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /** Is valid name?
     * @param string $name
     *	Name
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($name and $this->_validate($name, 'string')
	) ? true : false;
    }

    /** Is valid description?
     * @param string $description
     *	Description
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description) or $this->_validate($description, 'extString')
	) ? true : false;
    }

    /** Is valid fk_tag?
     * @param int $fk_tag
     *	fk_tag
     *
     * @return bool
     */
    public function isValidFkTag ($fk_tag) {
	return ($fk_tag and $this->_validate($fk_tag, 'int')
	    and $this->_isObject('#__$bp$tags', $fk_tag)
	) ? true : false;
    }
}
?>
