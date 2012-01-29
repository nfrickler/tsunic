<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showIndex.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show index-page
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
<h1><?php $this->set('SHOWINDEX__H1'); ?></h1>
<p>
	<?php $this->set('SHOWINDEX__INFOTEXT'); ?>
</p>
<h2><?php $this->set('SHOWINDEX__H2_INDEX'); ?></h2>
<dl>
	<dt><a href="?event=showModules"><?php $this->set('SHOWINDEX__DT_MODULES'); ?></a></dt>
	<dd><?php $this->set('SHOWINDEX__DD_MODULES'); ?></dd>
	<dt><a href="?event=showSystemcheck"><?php $this->set('SHOWINDEX__DT_SYSTEMCHECK'); ?></a></dt>
	<dd><?php $this->set('SHOWINDEX__DD_SYSTEMCHECK'); ?></dd>
	<dt><a href="?event=showConfig"><?php $this->set('SHOWINDEX__DT_CONFIG'); ?></a></dt>
	<dd><?php $this->set('SHOWINDEX__DD_CONFIG'); ?></dd>
	<dt><a href="?event=showTools"><?php $this->set('SHOWINDEX__DT_TOOLS'); ?></a></dt>
	<dd><?php $this->set('SHOWINDEX__DD_TOOLS'); ?></dd>
	<dt><a href="?event=showSetLogin"><?php $this->set('SHOWINDEX__DT_SETLOGIN'); ?></a></dt>
	<dd><?php $this->set('SHOWINDEX__DD_SETLOGIN'); ?></dd>
</dl>