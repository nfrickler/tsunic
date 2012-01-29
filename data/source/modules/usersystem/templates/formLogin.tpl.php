<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/formLogin.tpl.php
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
<div id="$$$div__formLogin">
	<form action="<?php $this->setUrl('$$$doLogin'); ?>" method="post" name="$$$formLogin__form" id="$$$formLogin__form" class="ts_form">
	    <fieldset>
	        <legend><?php echo $this->set('{FORMLOGIN__LEGEND}'); ?></legend>
	        <label for="$$$formLogin__emailname"><?php echo $this->set('{FORMLOGIN__EMAIL}'); ?></label>
	        <input type="text" class="ts_required" name="$$$formLogin__emailname" id="$$$formLogin__emailname" value="<?php $this->setPreset('$$$formLogin_emailname', $TSunic->Temp->getCookie('$$$formLogin__emailname')); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formLogin__password"><?php echo $this->set('{FORMLOGIN__PASSWORD}'); ?></label>
	        <input type="password" class="ts_required" name="$$$formLogin__password" id="$$$formLogin__password" />
	        <div style="clear:both;"></div>
	    </fieldset>
	    <input type="submit" class="ts_submit" value="<?php echo $this->set('{FORMLOGIN__SUBMIT}'); ?>" />
	</form>
</div>

<script type="text/javascript">

	// all input-fields in form
	var $$$formLogin__allInputs = new Array();
	$$$formLogin__allInputs[0] = new Array('$$$formLogin__emailname',
													  '<?php $this->setjs('{FORMLOGIN__EMAIL_PRESET}'); ?>',
													  '<?php $this->setjs('{FORMLOGIN__EMAIL_HELP}'); ?>');
	$$$formLogin__allInputs[1] = new Array('$$$formLogin__password',
													  '*******',
													  '<?php $this->setjs('{FORMLOGIN__PASSWORD_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formLogin__form'), $$$formLogin__allInputs);

	// focus on e-mail
//	document.getElementById('$$$formLogin__emailname').focus();
</script>