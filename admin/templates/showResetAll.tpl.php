<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showResetAll.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show page to reset software
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
<h1><?php $this->set('SHOWRESETALL__H1'); ?></h1>
<p>
	<?php $this->set('SHOWRESETALL__INFOTEXT'); ?>
</p>
<p class="error">
	<?php $this->set('SHOWRESETALL__WARNING'); ?>
</p>
<p>
	<a href="?event=resetAll"><?php $this->set('SHOWRESETALL__RESETALL'); ?></a>
</p>