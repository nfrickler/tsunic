<!-- | TEMPLATE - show content of tsunic -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/footer.tpl.php
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

// stop system-timer
$TSunic->Stats->stopTimer('system');
?>
<div id="$$$div__footer">
	<div id="$$$div__footer_left">
		&nbsp;
	</div>
	<div id="$$$div__footer_middle">
		<span class="ts_required">&nbsp;<?php $this->set('{FOOTER__REQUIRED_INFO}'); ?>&nbsp;</span>
		<br /><br />Performance:<br />
		PHP: <?php echo round((($TSunic->Stats->getTimer('system') - $TSunic->Stats->getTimer('mysql')) * 1000), 1); ?>ms
		| MySQL: <?php echo round(($TSunic->Stats->getTimer('mysql')*1000),1); ?>ms
		| Encryption: <?php echo round(($TSunic->Stats->getTimer('encryption')*1000),1); ?>ms
		<br /><br />Powered by <a href="http://tsunic.de" target="_blank">TSunic <?php echo $TSunic->Config->getConfig('version'); ?></a> 
		<br />Copyright &copy;2011 Nicolas Frinker
		<?php $this->displaySub('system__footer'); ?>
	</div>
	<div id="$$$div__footer_right">
		<a href="<?php $this->setUrl('$$$showSysteminfo'); ?>">
			<?php $this->set('{FOOTER__TOSYSTEMINFO}'); ?></a>
	</div>
	<div style="clear:both;"></div>
</div>