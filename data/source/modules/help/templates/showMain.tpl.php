<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | help 1.0
 * file:			templates/showMain.tpl.php
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
<div class="$$$div__showMain">
	<h1><?php $this->set('{SHOWMAIN__H}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWMAIN__INTRO}'); ?></ü>

	<h2><?php $this->set('{SHOWMAIN__H_LINKS}'); ?></h2>
	<dl>
	    <dt><a href="http://tsunic.de" target="_blank"><?php $this->set('{SHOWMAIN__LINKS_TSUNIC}'); ?></a></dt>
	    <dd><?php $this->set('{SHOWMAIN__LINKS_TSUNIC_INFO}'); ?></dd>

	    <dt style="margin-top:20px;"><a href="http://dokumentation.tsunic.de" target="_blank"><?php $this->set('{SHOWMAIN__LINKS_DOCUMENTATION}'); ?></a></dt>
	    <dd><?php $this->set('{SHOWMAIN__LINKS_DOCUMENTATION_INFO}'); ?></dd>
	</dl>
</div>