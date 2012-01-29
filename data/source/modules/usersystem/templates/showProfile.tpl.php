<!-- | TEMPLATE show profile -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/showProfile.tpl.php
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

// get data
$User = $this->getVar('User');
?>
<div id="$$$div__showProfile">
	<h1><?php echo $this->set('{SHOWPROFILE__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<!-- | <a id="$$$showAccount_editlink" href="<?php $this->setUrl('$$$showEditProfile'); ?>">
			<?php $this->set('{SHOWACCOUNT__TOEDITPROFILE}'); ?>
		</a> 
		-->
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWPROFILE__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
	    <tr>
	        <th style="min-width:200px;"><?php echo $this->set('{SHOWPROFILE__NAME}'); ?></th>
	        <td style="min-width:200px;" id="$$$showProfile__name"><?php $this->set($User->getInfo('name')); ?></td>
	    </tr>
	</table>
</div>