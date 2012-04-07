<!-- | factory class to handle all objects -->
<?php
class $$$Factory {

	/* array with all existing objects
	 * array [Class_md5values => reference]
	 */
	private $objects;

	/* constructor
	 */
	public function __construct () {
		return;
	}

	/* include class
	 * @param string: name of class
	 *
	 * @return bool
	 */
	private function includeClass ($class) {

		// get path
		$path = 'runtime/classes/'.$class.'.class.php';
		if (!file_exists($path)) {
			die('Class doesn\'t exist! ("'.$class.'")');
		}

		// include class
		include_once $path;

		return true;
	}

	/* get instance of class
	 * @param string: name of class
	 * +@param array: values of object in constructor
	 * +@param bool: force object to be a new one	 
	 *
	 * @return OBJECT
	 */
	public function get ($class, $values = array(), $forceNew = false) {

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

		// include class
		$this->includeClass($class);

		// get object
		if (empty($param_string)) {
			$object = new $class();
		} else {
			$to_eval = '$object = new '.$class.'('.$param_string.');';
			eval($to_eval);
		}

		// save object in array
		$this->objects[$obj_id] = $object;

		return $object;
	}
}
?>
