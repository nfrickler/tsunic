<!-- | TEMPLATE - show setting-bar -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/settings.tpl.php
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
<div id="$$$div__settings">
	<?php if ($TSunic->isJavascript() == true) { ?>
	<a href="<?php $this->setUrl('$$$disableJavascript'); ?>">
		<img src="<?php $this->setImg('project', '$$$javascript_enabled.gif'); ?>" alt="<?php $this->set('{SETTINGS__ENABLEJAVASCRIPT}'); ?>" style="height:20px; width:20px;" />
	</a>
	<?php } else { ?>
	<a href="<?php $this->setUrl('$$$enableJavascript'); ?>">
		<img src="<?php $this->setImg('project', '$$$javascript_disabled.gif'); ?>" alt="<?php $this->set('{SETTINGS__DISABLEJAVASCRIPT}'); ?>" style="height:20px; width:20px;" />
	</a>
	<?php } ?>
	<ul>
		<li>
			<a href="<?php $this->setUrl('$$$setLanguage', array('lang' => 'en')); ?>">
				en
			</a>
		</li>
		<li>
			<a href="<?php $this->setUrl('$$$setLanguage', array('lang' => 'de')); ?>">
				de
			</a>
		</li>
	</ul>
	<?php $this->displaySub('$$$settings'); ?>
</div>