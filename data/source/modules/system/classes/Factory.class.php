<!-- | CLASS Factory -->
<?php
/** Object factory
 *
 * This is a factory class.
 * It will cache references to all objects created and will reuse them if
 * possible
 */
class $$$Factory {

    /** Cache of existing objects
     * @var array $objects
     */
    private $objects;

    /** Get object of specified class
     *
     * This method will try to get object of specified class. If an object of
     * the same class and with the same parameters has been created before, this
     * object will be returned, if not enforced different.
     *
     * @param string $class
     *	Name of class
     * @param array $values
     *	Parameters for constructor call
     * @param bool $forceNew
     *	Force object not to be cached
     *
     * @return object
     */
    public function get ($class, $values = array(), $forceNew = false) {
	global $TSunic;

	// parse input
	if (!is_array($values)) $values = array($values);

	// extract classes in $values
	$param_string = '';
	foreach ($values as $index => $value) {
	    if (is_object($value)) {
		$param_string.= '$values['.$index.'],';
	    } else {
		if (empty($value)) {
		    $param_string.= '"",';
		} else {
		    if ($value === true OR $value === false) {
			$param_string.= $value.',';
		    } elseif (!strstr($value, '"')) {
			$param_string.= '"'.$value.'",';
		    } else {
			$param_string.= "'".$value."',";
		    }
		}
	    }
	}
	$param_string = substr($param_string, 0, (strlen($param_string) - 1));

	// get object-id
	$obj_id = $class.'_'.md5($param_string);

	// check, if object already exist
	if ($forceNew == false AND isset($this->objects[$obj_id])) {
	    return $this->objects[$obj_id];
	}

	// get object
	$object = NULL;
	if (empty($param_string)) {
	    $object = new $class();
	} else {
	    try {
		$to_eval = '$object = new '.$class.'('.$param_string.');';
		eval($to_eval);
	    } catch (Exception $e) {
		$TSunic->Log->log('3', "system:Factory: ERROR Eval failed: '$to_eval'!");
		$TSunic->throwError('Critical TSunic error!');
	    }
	}

	// save object in array
	$this->objects[$obj_id] = $object;

	return $object;
    }
}
?>
