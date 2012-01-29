<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showSetLogin.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show page to set login password
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
<h1><?php $this->set('SHOWSETLOGIN__H1'); ?></h1>
<p>
	<?php $this->set('SHOWSETLOGIN__INFOTEXT'); ?>
</p>
<form action="?event=setLogin" method="post" class="ts_form">
	<fieldset>
		<legend><?php echo $this->set('SHOWSETLOGIN__LEGEND'); ?></legend>
		<label for="system_users__formLogin__password"><?php echo $this->set('SHOWSETLOGIN__PASSWORD'); ?></label>
		<input type="password" name="pass" />
		<div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php echo $this->set('SHOWSETLOGIN__SUBMIT'); ?>" />
</form>