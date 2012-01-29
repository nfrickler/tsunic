<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/formRegistration.tpl.php
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
<div id="$$$div__formRegistration">
	<form action="<?php $this->setUrl('$$$doRegister'); ?>" method="post" name="$$$formRegistration__form" id="$$$formRegistration__form" class="ts_form">
	    <fieldset>
	        <legend><?php echo $this->set('{FORMREGISTRATION__LEGEND}'); ?></legend>
	        <label for="$$$formRegistration__name"><?php echo $this->set('{FORMREGISTRATION__NAME}'); ?></label>
	        <input type="text" class="ts_required" name="$$$formRegistration__name" id="$$$formRegistration__name" value="<?php $this->setPreset('$$$formRegistration__name'); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formRegistration__email"><?php echo $this->set('{FORMREGISTRATION__EMAIL}'); ?></label>
	        <input type="text" class="ts_required" name="$$$formRegistration__email" id="$$$formRegistration__email" value="<?php $this->setPreset('$$$formRegistration__email'); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formRegistration__password"><?php echo $this->set('{FORMREGISTRATION__PASSWORD}'); ?></label>
	        <input type="password" class="ts_required" name="$$$formRegistration__password" id="$$$formRegistration__password" />
	        <div style="clear:both;"></div>
	        <label for="$$$formRegistration__passwordrepeat"><?php echo $this->set('{FORMREGISTRATION__PASSWORDREPEAT}'); ?></label>
	        <input type="password" class="ts_required" name="$$$formRegistration__passwordrepeat" id="$$$formRegistration__passwordrepeat" />
	        <div style="clear:both;"></div>
	    </fieldset>
	    <input type="submit" class="ts_submit" value="<?php $this->set('{FORMREGISTRATION__SUBMIT}'); ?>" />
	</form>
</div>
<script type="text/javascript">
	// all input-fields in form
	var $$$formRegistration__allInputs = new Array();
	$$$formRegistration__allInputs[0] = new Array('$$$formRegistration__name',
															 '<?php $this->setjs('{FORMREGISTRATION__NAME_PRESET}'); ?>',
															 '<?php $this->setjs('{FORMREGISTRATION__NAME_HELP}'); ?>');
	$$$formRegistration__allInputs[1] = new Array('$$$formRegistration__email',
															 '<?php $this->setjs('{FORMREGISTRATION__EMAIL_PRESET}'); ?>',
															 '<?php $this->setjs('{FORMREGISTRATION__EMAIL_HELP}'); ?>');
	$$$formRegistration__allInputs[2] = new Array('$$$formRegistration__password',
															 '*******',
															 '<?php $this->setjs('{FORMREGISTRATION__PASSWORD_HELP}'); ?>');
	$$$formRegistration__allInputs[3] = new Array('$$$formRegistration__passwordrepeat',
															 '*******',
															 '<?php $this->setjs('{FORMREGISTRATION__PASSWORDREPEAT_HELP}'); ?>');
	// add help to form
	$system$showFormHelp(document.getElementById('$$$formRegistration__form'), $$$formRegistration__allInputs);
</script>