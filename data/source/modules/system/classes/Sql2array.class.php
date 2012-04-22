<!-- | class to convert sql-queries in arrays and reverse -->
<?php
class $$$Sql2array {

	/* primary list
	 * array
	 */
	private $primus = array('INSERT INTO',
		'SELECT',
		'DELETE FROM',
		'UPDATE',
		'FROM',
		'WHERE',
		'GROUP BY',
		'ORDER BY',
		'SET',
		'ON DUPLICATE KEY UPDATE',
		'VALUES');

	/* secondary list
	 * array
	 */
	private $secundus = array(',',
		'[\s]AND[\s]',
		'[\s]OR[\s]');

	/* third list
	 * array
	 */
	private $third = array('[\s]AS[\s]',
		'[\s]as[\s]',
		'[\s]As[\s]',
		'[\s]aS[\s]',
		'[\s]=[\s]',
		'[\s]>=[\s]',
		'[\s]<=[\s]',
		'[\s]>[\s]',
		'[\s]<[\s]');

	/* array with subqueries
	 * array
	 */
	private $subqueries = array();

	/* array with more information about the subqueries
	 * array
	 */
	private $subqueries_info = array();

	/* escape-term
	 * string
	 */
	private $escape_seq = '#_#';

	/* escape-term
	 * string
	 */
	private $extractedData = array();

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		return;
	}

	/* *************** sql to array ************************************* */

	/* convert sql-query in array
	 * @param string: sql-query
	 *
	 * @return array/false
 	 */
	public function toArray ($sql) {
		$array = array();
		$is_escaped = false;

		// skip semicolon at the end of the query
		$sql = trim($sql);
		if (substr($sql, -1) == ';') $sql = substr($sql, 0, (strlen($sql) - 1));

		// escape #
		if (preg_match("!#(data|subquery)_\d+#!Us", $sql) != 0) {
			$sql = preg_replace(
				"!#(data|subquery)_(\d+)#!Us",
				"#$1".$this->escape_seq."$2#",
				$sql
			);
			$is_escaped = true;
		}

		// extract all data
		$sql = preg_replace_callback(
			'!("([^"]*)"|\'([^\']*)\'|[\s\b,=]+([0-9]+)([\s]|,|$))!Usi',
			array($this, '_extractData'),
			$sql
		);

		// extract subqueries
		$sql = preg_replace_callback('!\((.*)\)!Usi', array($this, 'getSubquery'), $sql);

		// split by primary list
		$sql_primus = implode('[\s\n\r]*|', $this->primus).' ';
		$split_primus = preg_split('!('.$sql_primus.')!', $sql);

		// get primary order
		$sql_cache = $sql;
		foreach ($split_primus as $index => $value) {
			$sql_cache = str_replace($value, '|', $sql_cache);
		}
		$order_primus = explode('|', $sql_cache);

		// get arrays of single-parts
		foreach ($order_primus as $index => $value) {
			// skip empty values
			$value = trim($value);
			if (empty($value)) continue;
			// set sql as value
			$cache_sql = $split_primus[($index+1)];
			// add array of sql-phrase
			$array[$value] = $this->_getPhrase($cache_sql);
		}

		// unescape
		if ($is_escaped) {
			$array = $this->_unescape($array); 
		}

		return $array;
	}

	/* unescape all array elements
	 * @param array: input-array
	 *
	 * @return array
	 */
	private function _unescape ($array) {

		foreach ($array as $index => $value) {

			# is array?
			if (is_array($value)) {
				$array[$index] = $this->_unescape($value);
				continue;
			}

			# unescape
			$array[$index] = preg_replace(
				"!#(data|subquery)".$this->escape_seq."(\d+)#!Us",
				"#$1"."_"."$2#",
				$value
			);
		}

		return $array;
	}

	/* convert sql-query in array (from callback-function)
	 * @param array: input from callback-function
	 *
	 * @return array/false
 	 */
	public function getSubquery ($sql) {

		// get sql-string
		if (is_array($sql)) $sql = $sql[0];

		// skip braces
		$sql = trim(substr($sql, 1, (strlen($sql) - 2)));

		// skip empty $sql
		if (empty($sql)) return '()';

		// init array
		$array = array();
		$array_info = array();

		// check, if is subquery OR list
		$sql_primus = implode(' |', $this->primus).' ';
		if (preg_match('!('.$sql_primus.')!', $sql) == 0) {
			// is list
			$array = $this->_getPhrase($sql);
			$array_info['type'] = 'list';
		} else {
			// is subquery
			// get sql
			$array = $this->toArray($sql);
			$array_info['type'] = 'subquery';
		}

		// get unique id
		$id = count($this->subqueries);

		// save subquery
		$this->subqueries[$id] = $array;
		$this->subqueries_info[$id] = $array_info;

		// return #id# for callback
		return ' #subquery_'.$id.'# ';
	}

	/* convert sql-phrase in array
	 * @param string: sql-string
	 * +@param array/bool: array with phrases to split sql by
	 *
	 * @return array/bool
 	 */
	protected function _getPhrase ($sql, $splitBy = false) {
		$array = array();

		// get split-list
		if ($splitBy == false) $splitBy = $this->secundus;
		$sql_splitter = implode('|', $splitBy);
		$splitted_sql = preg_split('!('.$sql_splitter.')!Usi', $sql);

		// get primary order-list
		$sql_cache = $sql;
		$toRemove = $splitted_sql;
		while (count($toRemove) > 0) {

			// get longest string to remove
			$currentIndex = false;
			foreach ($toRemove as $index => $value) {

				// trim value
				$toRemove[$index] = $this->_trim($value);

				// get index
				if ($currentIndex === false) {
					$currentIndex = $index;
					continue;
				}
				if (strlen($toRemove[$currentIndex]) < strlen($toRemove[$index])) {
					// set longer one as current
					$currentIndex = $index;
				}
			}

			// strip longest value
			$sql_cache = $this->_trim(str_replace($toRemove[$currentIndex], '|', $sql_cache));
			unset($toRemove[$currentIndex]);
		}
		$order_secundus = explode('|', $sql_cache);

		// convert in array
		foreach ($splitted_sql as $index => $value) {

			// skip empty values
			if (empty($value)) continue;

			// get new array-index
			$array_index = count($array);
			if ($array_index < 10) $array_index = '0'.$array_index;
			if ($array_index < 100) $array_index = '0'.$array_index;
			if ($array_index < 1000) $array_index = '0'.$array_index;
			$array_index = $array_index.'_'.strtoupper(trim($order_secundus[$index]));

			// split by as or AS or =
			$sql_third = implode('|', $this->third);
			if (preg_match('!'.$sql_third.'!', $value) != 0) {
				$value = $this->_getPhrase($value, $this->third);
			}

			// set data as data
			if ($this->_isData($value)) {
				$value = array('data' => $this->_getExtractedData($value));
			}

			// add to array
			if (!is_array($value)) $value = trim($value);
			$array[$array_index] = $value;
		}

		// include subqueries
		$array = $this->_performLoopAction($array, array('this', '_replacementToSubquery'));

		return $array;
	}

	/* perform action on all array-elements
	 * @param array: array to look for elements
	 * @param string/array: function to perform (array: [0] => $object; [1] => $function)
	 *
	 * @return $array
	 */
	protected function _performLoopAction ($array, $action) {

		// validate action
		if (is_array($action)) {
			if ($action[0] == 'this') $action[0] = $this;
			if (!is_object($action[0])) return false;
		}

		// is array?
		if (!is_array($array)) {
			// no array - perform action
			$array = (is_array($action)) ? $action[0]->$action[1]($array) : $action($array);
			return $array;
		}

		// loop
		foreach ($array as $index => $values) {
			// is element array?
			if (is_array($values)) {
				// is array
				$array[$index] = $this->_performLoopAction($values, $action);
			} else {
				// no array - perform action
				$array[$index] = (is_array($action)) ? $action[0]->$action[1]($values) : $action($values);
			}
		}

		return $array;
	}

	/* replace subquery-replacements by their array
	 * @param string: $sql-query
	 *
	 * @return bool
	 */
	protected function _replacementToSubquery ($sql) {

		// check, if subquery/list embedded
		if (preg_match('!#subquery_[0-9]+#!Usi', $sql) != 0) {

			// split sql and get id
			$cache_val = explode('#', $sql);
			$id = str_replace('#', '', $cache_val[1]);
			$id = substr($id, 9);

			// type?
			$type = $this->subqueries_info[$id]['type'];
			if ($type == 'list') {
				// is list

				// start array
				$output = array();

				// add reference?
				if (!empty($cache_val[0])) {
					$output['reference'] = $cache_val[0];
				}
				$output['list'] = $this->subqueries[$id];

				// add reference?
				if (!empty($cache_val[2])) {
					$output['reference'] = $cache_val[2];
				}
			} else {
				// is subquery
				$output = $this->subqueries[$id];
			}
		} else {
			$output = $sql;
		}

		return $output;
	}

	/* check, if value is data
	 * @param mix: input-data
	 *
	 * @return bool
	 */
	protected function _isData ($data) {

		// is array
		if (is_array($data)) return false;

		// trim input
		$data = trim($data);

		// check, if extraced-data
		// check, if within single-quotes
		if (substr($data, 0, 6) == "#data_"
				AND substr($data, -1) == "#" AND strlen($data) <= 11) {
			// is data
			return true;
		}

		// check, if within single-quotes
		if (substr($data, 0, 1) == "'"
				AND substr($data, -1) == "'") {
			// is data
			return true;
		}

		// check, if numeric
		if (is_numeric($data)) {
			// is data
			return true;
		}

		return false;
	}

	/* trim data (e.g. by removing single quotes)
	 * @param mix: input-data
	 *
	 * @return mix
	 */
	protected function _trimData ($data) {

		// trim input
		$data = trim($data);

		// get extracted data
		$data = preg_replace_callback('!(#data_([0-9]+)#)!Usi', array($this, '_getExtractedData'), $data);

		// single-quotes?
		if (substr($data, 0, 1) == "'"
				AND substr($data, -1) == "'") {
			// remove single-quotes
			$data = substr($data, 1, (strlen($data) - 2));
		 }

		return $data;
	}

	/* replace data by placeholder
	 * @param array: input from callback-function
	 *
	 * @return array/false
	 */
	protected function _extractData ($sql) {
		$sql = trim($sql[0]);

		// strip quotes
		if ((substr($sql, 0, 1) == '"' AND substr($sql, -1) == '"')
				OR (substr($sql, 0, 1) == "'" AND substr($sql, -1) == "'")) {
			$sql = substr($sql, 1, (strlen($sql) - 2));
		}

		// is = or comma?
		$output_add = '';
		$output_pad = '';
		if (substr($sql, 0, 1) == '=') {
			$sql = substr($sql, 1);
			$output_add = ' =';
		}
		if (substr($sql, -1) == ',') {
			$sql = substr($sql, 0, (strlen($sql) - 1));
			$output_pad = ',';
		}

		// save data in obj-vars
		$id = count($this->extractedData);
		$this->extractedData[$id] = trim($sql);

		// return placeholder
		return $output_add.' #data_'.$id.'#'.$output_pad;
	}

	/* replace placeholder with extracted data
	 * @param string: input from callback-function
	 *
	 * @return array/false
	 */
	protected function _getExtractedData ($index) {
		if (is_array($index)) $index = $index[0];
		$index = trim($index);

		// is data?
		if ($this->_isData($index)) {

			// get id
			$index = substr($index, 6);
			$index = substr($index, 0, strlen($index) - 1);

			// get data
			$data = (isset($this->extractedData[$index])) ? $this->extractedData[$index] : $index;
		} else {
			$data = $index;
		}

		// return placeholder
		return $data;
	}

	/* *************** array to sql ************************************* */

	/* convert array in sql-query
	 * @param array: array-input
	 * @param bool: is subquery?
	 *
	 * @return mysql-query/false
	 */
	public function toSql ($array, $isSub = false) {
		$sql = '';

		// return, if no array
		if (!is_array($array)) return $array;
		foreach ($array as $index => $values) {

			// join lists
			if ($index == 'list') {
				$values = $this->_joinList($values);
			}
			if ($index == 'data') {
				$values = (is_numeric($values)) ? $values : "'".$values."'";
			}

			// get command-word
			$command = (is_numeric(substr($index, 0, 4))) ? substr($index, 5) : $index;
			$no_command_indexes = array('data', 'reference', 'list');
			if (in_array($index, $no_command_indexes)) $command = '';

			// get values
			if (is_array($values)) {
	
				// is subquery?
				if (isset($values['INSERT INTO']) OR isset($values['FROM'])) {
					// is subquery
					$values = '('.$this->toSql($values, true).')';
				} else {
					// no subquery
					$values = $this->toSql($values, true);
				}
			}

			// add sql-string to sql-query
			$sql.= ' '.trim($command).' '.trim($values);
			trim($sql);
		}

		// add semicolon at end of query
		if (!$isSub) $sql.= ';';
		return trim($sql);
	}

	/* join in sql-list
	 * @param array: array-input
	 *
	 * @return mysql-query/false
	 */
	public function _joinList ($array) {

		// join list
		$sql = "";
		foreach ($array as $index => $value) {
			// get sql-connection command
			$command = (is_numeric(substr($index, 0, 4))) ? substr($index, 5) : $index;
			if (empty($command)) $command = '';
			if (is_array($value) AND isset($value['data'])) {
				$array[$index] = (is_numeric($value['data']))
					? $value['data'] : "'".$value['data']."'";
			} else {
				$array[$index] = $this->toSql($value, true);
			}
			$sql.= " ".$command." ".$array[$index];
		}
		$sql = '('.$sql.')';

		return $sql;
	}

	/* trim string
	 * @param string: string to trim
	 *
	 * @return string
	 */
	public function _trim ($string) {
		// trim string
		$string = trim($string, chr(9).chr(10).chr(13).chr(32));
		return $string;
	}
}
?>
