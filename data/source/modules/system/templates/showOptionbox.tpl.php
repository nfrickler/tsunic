<!-- | TEMPLATE - show optionbox -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/showOptionbox.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
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
?>
<div id="$$$div__showOptionbox">
	<h1><?php $this->setVar('headertext'); ?></h1>
	<p style="margin-bottom:20px;" class="ts_infotext"><?php $this->setVar('contenttext'); ?></p>
	<a class="ts_submit" href="<?php $this->setVar('submit_href'); ?>"><?php $this->setVar('submittext'); ?></a>
	<a class="ts_cancel" href="<?php $this->setVar('cancel_href'); ?>"><?php $this->setVar('canceltext'); ?></a>
</div>