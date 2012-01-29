<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_Template.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle one template
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

// deny direct access
defined('TS_INIT') OR die('Access denied!');

class ts_Template {

	/* path to template-file
	 * string
	 */
	protected $path;

	/* name of template
	 * string
	 */
	protected $template;

	/* data for template
	 * array
	 */
	protected $data;

	/* cache
	 * array
	 */
	protected $cache;

	/* constructor
	 * +@param string $template: name of template
	 * +@param string $design: name of design
	 *
	 * @return OBJECT
	 */
	public function __construct ($template = false, $design = 0) {
		global $TemplateEngine;

		// get input
		$this->template = $template;

		// get data for template
		if (isset($TemplateEngine->data[$template])) {
			$this->data = $TemplateEngine->data[$template];

		} else {
			$this->data = array();
		}

		return;
	}

	/* display template
	 * +@param string $path: path of template-file
	 * +@param bool $return_error: return error? (OR return false)	 
	 *
	 * @return bool
	 */
	public function includeTemplate ($path = false, $return_error = true) {

		// set path
		if ($path == false) $path = 'templates/'.$this->template.'.tpl.php';

		// try to include
		if (file_exists($path)) {
			include $path;
		} else {
			// template does not exist
			echo '<p class="error">Template does not exist! (path: '.$path.')</p>';
		}

		return true;
	}

	/* display other template
	 * @param string $template: name of template
	 * +@param bool/array $data: data for template
	 *
	 * @return bool
	 */
	public function display ($template, $data = false) {
		global $TemplateEngine;

		// get template to include
		$activated = $TemplateEngine->getActivatedTemplates();
		if (empty($template) AND isset($activated['html'], $activated['html'][0])) {
			$template = $activated['html'][0];
		}

		// get template-object
		$template = new ts_Template($template);

		// display template
		$template->includeTemplate();

		return true;
	}

	/* get value from $this->data
	 * @param string $name: name of data | $name = true => all data
	 *
	 * @return bool
	 */
	public function setVar ($name) {

		// set value
		$this->set($this->getVar($name));
		return;
	}

	/* get value from $this->data
	 * @param string $name: name of data | $name = true => all data
	 *
	 * @return bool
	 */
	public function getVar ($name) {

		// check name
		if (!isset($name) OR empty($name)) return false;

		// return  values
		if ($name === true) return $this->data;
		if (isset($this->data[$name])) return $this->data[$name];

		return false;
	}

	/* parse for output (language- and bbcode-replacements)
	 * @param string $text: text to parse
	 * @param 0/array $vars: variables to replace in lang-string
	 * +@param bool $doEcho: true - display $text; false - do not display
	 * +@param bool $doEscape: true - escape singe and double quotes	 
	 *
	 * @return bool
	 */
	public function set ($text, $vars = 0, $doEcho = true, $doEscape = false) {
		global $TemplateEngine;

		// replace language
		$text = $TemplateEngine->parse($text, $doEscape);

		// validate that $vars is an array
		if ($vars === 0) $vars = array();
		if (!is_array($vars)) $vars = array($vars);
		$this->cache['vars'] = $vars;

		// replace variables (#...#)
		$text = preg_replace_callback('$#([0-9a-zA-zöäüÖÄÜ]+)#$Us', array($this, 'replaceVar'), $text);

		// get new lines and trim finally
		$text = nl2br($text);
		$text = str_replace('\r\n', '<br />', $text);
		$text = str_replace('\n\n', '<br />', $text);
		$text = trim($text);

		// echo or return
		if ($doEcho == true) {
			// echo and return
			echo $text;
			return '';
		} else {
			// return
			return $text;
		}
	}

	/* get lang-var (needed for $this->set())
	 * @param array $in: [1] -> number (+1) of lang-var
	 *
	 * @return string: text-output of lang-var
 	 */
	private function replaceVar ($in) {

		// get index
		$in = str_replace('#', '', $in[1]);

		// check, if replacement exists and return
		if (isset($this->cache['vars'][$in])) return $this->set($this->cache['vars'][$in], false, false);
		if (isset($this->data[$in])) return $this->set($this->data[$in], false, false);
		return '?error?';
	}
}
?>
