<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showModules.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show modules
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

// get global vars
global $ModuleHandler;
?>
<h1><?php $this->set('SHOWMODULES__H1'); ?></h1>
<p>
	<?php $this->set('SHOWMODULES__INFOTEXT'); ?>
</p>
<form action="?event=setModules" method="post">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th><?php $this->set('SHOWMODULES__ID'); ?></th>
			<th><?php $this->set('SHOWMODULES__MODNAME'); ?></th>
			<th><?php $this->set('SHOWMODULES__VERSION'); ?></th>
			<th><?php $this->set('SHOWMODULES__MODDESCRIPTION'); ?></th>
			<th><?php $this->set('SHOWMODULES__AUTHOR'); ?></th>
			<th><?php $this->set('SHOWMODULES__STATUS'); ?></th>
			<th><?php $this->set('SHOWMODULES__ACTION'); ?></th>
		</tr>
		<?php foreach ($ModuleHandler->getModules() as $index => $Module) { ?>
		<tr class="packets__statusclass_<?php echo $Module->getStatus(); ?>">
			<td>
				<input type="checkbox" class="ts_checkbox" name="module__<?php echo $Module->getInfo('id__module'); ?>" id="module__<?php echo $Module->getInfo('id__module'); ?>" <?php if ($Module->getInfo('is_activated')) echo 'checked="checked"'; ?> />
			</td>
			<td><?php echo $Module->getInfo('id__module'); ?></td>
			<td>
				<label for="module__<?php echo $Module->getInfo('id__module'); ?>" class="label_classic">
					<?php echo $Module->getInfo('name'); ?>
				</label>
			</td>
			<td>
				<?php if ($Module->getStatus() == 3) {
					echo $Module->getInfo('version_installed').' -> '.$Module->getInfo('version');
				} else {
					echo $Module->getInfo('version');
				} ?>
			</td>
			<td><?php echo $Module->getInfo('description'); ?></td>
			<td><?php echo $Module->getInfo('author'); ?></td>
			<td><?php $this->set($Module->getStatus(true)); ?></td>
			<td>
				<?php switch ($Module->getStatus()) { 
					case 4:
						?>
						<a href="?event=installModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_INSTALL'); ?>
						</a>
						<?php
						// no break
					case 5:
						?>
						<a href="?event=deleteModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_DELETE'); ?>
						</a>
						<?php
						break;
					case 2:
						?>
						<a href="?event=uninstallModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_UNINSTALL'); ?>
						</a>
						<?php
						break;
					case 1:
						?>
						<a href="?event=installModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_INSTALL'); ?>
						</a>
						<a href="?event=deleteModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_DELETE'); ?>
						</a>
						<?php
						break;
					case 3:
						?>
						<a href="?event=updateModule&amp;id=<?php echo $Module->getInfo('id__module'); ?>">
							<?php $this->set('SHOWMODULES__ACTION_UPDATE'); ?>
						</a>
						<?php
						break;
				} ?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<input type="submit" name="submit_render" class="ts_submit" value="<?php $this->set('SHOWMODULES__RENDER'); ?>" />
	<input type="submit" name="submit_setModules" class="ts_submit" value="<?php $this->set('SHOWMODULES__SUBMIT'); ?>" />
	<input type="reset" class="ts_reset" value="<?php $this->set('SHOWMODULES__RESET'); ?>" />	
</form>
