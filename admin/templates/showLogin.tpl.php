<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showLogin.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show login page
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
?>
<h1><?php $this->set('SHOWLOGIN__H1'); ?></h1>
<p>
	<?php $this->set('SHOWLOGIN__INFOTEXT'); ?>
</p>
<form action="?event=doLogin" method="post" class="ts_form">
	<fieldset>
		<legend><?php echo $this->set('SHOWLOGIN__LEGEND'); ?></legend>
		<label for="pass"><?php echo $this->set('SHOWLOGIN__PASSWORD'); ?></label>
		<input type="password" name="pass" id="pass" />
		<div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php echo $this->set('SHOWLOGIN__SUBMIT'); ?>" />
</form>
