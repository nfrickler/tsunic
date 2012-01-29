<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showStyles.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show styles
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
global $StyleHandler;
?>
<h1><?php $this->set('SHOWSTYLES__H1'); ?></h1>
<p>
	<?php $this->set('SHOWSTYLES__INFOTEXT'); ?>
</p>
<form action="?event=setStyles" method="post">
	<table>
		<tr>
			<th>&nbsp;</th>
			<th><?php $this->set('SHOWSTYLES__ID'); ?></th>
			<th><?php $this->set('SHOWSTYLES__MODNAME'); ?></th>
			<th><?php $this->set('SHOWSTYLES__VERSION'); ?></th>
			<th><?php $this->set('SHOWSTYLES__MODDESCRIPTION'); ?></th>
			<th><?php $this->set('SHOWSTYLES__AUTHOR'); ?></th>
			<th><?php $this->set('SHOWSTYLES__STATUS'); ?></th>
			<th><?php $this->set('SHOWSTYLES__ACTION'); ?></th>
		</tr>
		<?php foreach ($StyleHandler->getStyles() as $index => $Style) { ?>
		<tr class="packets__statusclass_<?php echo $Style->getStatus(); ?>">
			<td>
				<input type="checkbox" class="ts_checkbox" name="style__<?php echo $Style->getInfo('id__style'); ?>" id="style__<?php echo $Style->getInfo('id__style'); ?>" <?php if ($Style->getInfo('is_activated')) echo 'checked="checked"'; ?> />
			</td>
			<td><?php echo $Style->getInfo('id__style'); ?></td>
			<td>
				<label for="style__<?php echo $Style->getInfo('id__style'); ?>" class="label_classic">
					<?php echo $Style->getInfo('name'); ?>
				</label>
			</td>
			<td><?php echo $Style->getInfo('version'); ?></td>
			<td><?php echo $Style->getInfo('description'); ?></td>
			<td><?php echo $Style->getInfo('author'); ?></td>
			<td><?php $this->set($Style->getStatus(true)); ?></td>
			<td>
				<a href="?event=deleteStyle&amp;id=<?php echo $Style->getInfo('id__style'); ?>">
					<?php $this->set('SHOWSTYLES__ACTION_DELETE'); ?>
				</a><br />
				<?php if ($Style->getStatus() == 6 OR $Style->getStatus() == 9) { ?>
				<a href="?event=setDefaultStyle&amp;id=<?php echo $Style->getInfo('id__style'); ?>">
					<?php $this->set('SHOWSTYLES__ACTION_SETDEFAULT'); ?>
				</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<input type="submit" class="ts_submit" value="<?php $this->set('SHOWSTYLES__SUBMIT'); ?>" />
	<input type="reset" class="ts_reset" value="<?php $this->set('SHOWSTYLES__RESET'); ?>" />	
</form>
