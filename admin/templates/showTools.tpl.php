<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showTools.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show tools
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
<h1><?php $this->set('SHOWTOOLS__H1'); ?></h1>
<p>
	<?php $this->set('SHOWTOOLS__INFOTEXT'); ?>
</p>
<dl>
	<dt><a href="?event=showInitDatabase"><?php $this->set('SHOWTOOLS__DT_INITDATABASE'); ?></a></dt>
	<dd><?php $this->set('SHOWTOOLS__DD_INITDATABASE'); ?></dd>
	<dt><a href="?event=showResetAll"><?php $this->set('SHOWTOOLS__DT_RESETALL'); ?></a></dt>
	<dd><?php $this->set('SHOWTOOLS__DD_RESETALL'); ?></dd>
</dl>

