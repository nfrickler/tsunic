<!-- | TEMPLATE - show system-information -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/showSysteminfo.tpl.php
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

// get input
$modules = $this->getData('modules');
?>
<div class="$$$div__systeminfo">
	<h1><?php $this->set('{SYSTEMINFO__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SYSTEMINFO__INFOTEXT}'); ?></p>

	<h2><?php $this->set('{SYSTEMINFO__SHOWMODULES_H1}'); ?></h2>
	<p><?php $this->set('{SYSTEMINFO__SHOWMODULES_INFOTEXT}'); ?></p>
	<table>
		<tr>
			<th><?php $this->set('{SYSTEMINFO__SHOWMODULES_NAME}'); ?></th>
			<th><?php $this->set('{SYSTEMINFO__SHOWMODULES_VERSION}'); ?></th>
			<th><?php $this->set('{SYSTEMINFO__SHOWMODULES_DESCRIPTION}'); ?></th>
			<th><?php $this->set('{SYSTEMINFO__SHOWMODULES_LINK}'); ?></th>
		</tr>
		<?php foreach ($modules as $index => $values) { ?>
		<tr>
			<td><?php echo $values['name']; ?></td>
			<td><?php echo $values['version_installed']; ?></td>
			<td><?php echo $values['description']; ?></td>
			<td>
				<?php if (!empty($values['link'])) { ?>
				<a href="<?php echo $values['link']; ?>" target="_blank">
					<?php $this->set('{SYSTEMINFO__SHOWMODULES_TOLINK}'); ?></a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>