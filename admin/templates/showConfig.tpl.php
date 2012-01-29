<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/templates/showConfig.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		TEMPLATE; show configuration
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

// get config-handler object
global $Config;

?>
<h1><?php $this->set('SHOWCONFIG__H1'); ?></h1>
<p>
	<?php $this->set('SHOWCONFIG__INFOTEXT'); ?>
</p>
<form action="?event=setConfig" method="post" class="ts_form">
	<fieldset>
		<legend><?php $this->set('SHOWCONFIG__LEGEND_DATABASE'); ?></legend>
		<label for="set__db_class"><?php $this->set('SHOWCONFIG__DB_CLASS'); ?></label>
		<select name="set__db_class" id="set__db_class">
			<option value="mysql" <?php if ($Config->get('db_class') == 'mysql') echo 'selected="selected"'; ?>>MySQL</option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="db_class_info_img" onclick="javascript:toggleInfo('db_class_info');" />
		<div class="form_infobox" id="db_class_info" onclick="javascript:toggleInfo('db_class_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DB_CLASS_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__db_host"><?php $this->set('SHOWCONFIG__DB_HOST'); ?></label>
		<input type="text" name="set__db_host" id="set__db_host" value="<?php echo $Config->get('db_host'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="db_host_info_img" onclick="javascript:toggleInfo('db_host_info');" />
		<div class="form_infobox" id="db_host_info" onclick="javascript:toggleInfo('db_host_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DB_HOST_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__db_user"><?php $this->set('SHOWCONFIG__DB_USER'); ?></label>
		<input type="text" name="set__db_user" id="set__db_user" value="<?php echo $Config->get('db_user'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="db_user_info_img" onclick="javascript:toggleInfo('db_user_info');" />
		<div class="form_infobox" id="db_user_info" onclick="javascript:toggleInfo('db_user_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DB_USER_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__db_pass"><?php $this->set('SHOWCONFIG__DB_PASS'); ?></label>
		<input type="password" name="set__db_pass" id="set__db_pass" value="<?php echo $Config->get('db_pass'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="db_pass_info_img" onclick="javascript:toggleInfo('db_pass_info');" />
		<div class="form_infobox" id="db_pass_info" onclick="javascript:toggleInfo('db_pass_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DB_PASS_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__db_database"><?php $this->set('SHOWCONFIG__DB_DATABASE'); ?></label>
		<input type="text" name="set__db_database" id="set__db_database" value="<?php echo $Config->get('db_database'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="db_database_info_img" onclick="javascript:toggleInfo('db_database_info');" />
		<div class="form_infobox" id="db_database_info" onclick="javascript:toggleInfo('db_database_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DB_DATABASE_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__preffix"><?php $this->set('SHOWCONFIG__PREFFIX'); ?></label>
		<input type="text" name="set__preffix" id="set__preffix" value="<?php echo $Config->get('preffix'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="preffix_info_img" onclick="javascript:toggleInfo('preffix_info');" />
		<div class="form_infobox" id="preffix_info" onclick="javascript:toggleInfo('preffix_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__PREFFIX_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
	</fieldset>
	<fieldset>
		<legend><?php $this->set('SHOWCONFIG__LEGEND_ENCRYPTION'); ?></legend>
		<label for="set__encryption_class"><?php $this->set('SHOWCONFIG__ENCRYPTION_CLASS'); ?></label>
		<select name="set__encryption_class" id="set__encryption_class">
			<option value="mcrypt" <?php if ($Config->get('encryption_class') == 'mcrypt') echo 'selected="selected"'; ?>>mcrypt</option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="encryption_class_info_img" onclick="javascript:toggleInfo('encryption_class_info');" />
		<div class="form_infobox" id="encryption_class_info" onclick="javascript:toggleInfo('encryption_class_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__ENCRYPTION_CLASS_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__encryption_algorithm"><?php $this->set('SHOWCONFIG__ENCRYPTION_ALGORITHM'); ?></label>
		<select name="set__encryption_algorithm" id="set__encryption_algorithm">
			<option value="blowfish" <?php if ($Config->get('encryption_algorithm') == 'blowfish') echo 'selected="selected"'; ?>>blowfish</option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="encryption_algorithm_info_img" onclick="javascript:toggleInfo('encryption_algorithm_info');" />
		<div class="form_infobox" id="encryption_algorithm_info" onclick="javascript:toggleInfo('encryption_algorithm_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__ENCRYPTION_ALGORITHM_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__encryption_mode"><?php $this->set('SHOWCONFIG__ENCRYPTION_MODE'); ?></label>
		<select name="set__encryption_mode" id="set__encryption_mode" <?php if ($Config->get('encryption_mode') == 'ecb') echo 'selected="selected"'; ?>>
			<option value="ecb">ecb</option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="encryption_mode_info_img" onclick="javascript:toggleInfo('encryption_mode_info');" />
		<div class="form_infobox" id="encryption_mode_info" onclick="javascript:toggleInfo('encryption_mode_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__ENCRYPTION_MODE_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__system_secret"><?php $this->set('SHOWCONFIG__SYSTEM_SECRET'); ?></label>
		<input type="text" name="set__system_secret" id="set__system_secret" value="<?php echo $Config->get('system_secret'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="system_secret_info_img" onclick="javascript:toggleInfo('system_secret_info');" />
		<div class="form_infobox" id="system_secret_info" onclick="javascript:toggleInfo('system_secret_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__SYSTEM_SECRET_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
	</fieldset>
	<fieldset>
		<legend><?php $this->set('SHOWCONFIG__LEGEND_PATHS'); ?></legend>
		<label for="set__root_folder"><?php $this->set('SHOWCONFIG__ROOT_FOLDER'); ?></label>
		<input type="text" name="set__root_folder" id="set__root_folder" value="<?php echo $Config->get('root_folder'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="root_folder_info_img" onclick="javascript:toggleInfo('root_folder_info');" />
		<div class="form_infobox" id="root_folder_info" onclick="javascript:toggleInfo('root_folder_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__ROOT_FOLDER_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__data_folder"><?php $this->set('SHOWCONFIG__DATA_FOLDER'); ?></label>
		<input type="text" name="set__data_folder" id="set__data_folder" value="<?php echo $Config->get('data_folder'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="data_folder_info_img" onclick="javascript:toggleInfo('data_folder_info');" />
		<div class="form_infobox" id="data_folder_info" onclick="javascript:toggleInfo('data_folder_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DATA_FOLDER_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
	</fieldset>
	<fieldset>
		<legend><?php $this->set('SHOWCONFIG__LEGEND_OTHERS'); ?></legend>
		<label for="set__default_language"><?php $this->set('SHOWCONFIG__DEFAULT_LANGUAGE'); ?></label>
		<select name="set__default_language" id="set__default_language">
			<option value="de" <?php if ($Config->get('default_language') == 'de') echo 'selected="selected"'; ?>>Deutsch</option>
			<option value="en" <?php if ($Config->get('default_language') == 'en') echo 'selected="selected"'; ?>>English</option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="default_language_info_img" onclick="javascript:toggleInfo('default_language_info');" />
		<div class="form_infobox" id="default_language_info" onclick="javascript:toggleInfo('default_language_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DEFAULT_LANGUAGE_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__system_email"><?php $this->set('SHOWCONFIG__SYSTEM_EMAIL'); ?></label>
		<input type="text" name="set__system_email" id="set__system_email" value="<?php echo $Config->get('system_email'); ?>" />
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="system_email_info_img" onclick="javascript:toggleInfo('system_email_info');" />
		<div class="form_infobox" id="system_email_info" onclick="javascript:toggleInfo('system_email_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__SYSTEM_EMAIL_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__email_enabled"><?php $this->set('SHOWCONFIG__EMAIL_ENABLED'); ?></label>
		<select name="set__email_enabled" id="set__email_enabled">
			<option value="true" <?php if ($Config->get('email_enabled') == true) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__YES'); ?></option>
			<option value="false" <?php if ($Config->get('email_enabled') == false) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__NO'); ?></option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="email_enabled_info_img" onclick="javascript:toggleInfo('email_enabled_info');" />
		<div class="form_infobox" id="email_enabled_info" onclick="javascript:toggleInfo('email_enabled_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__EMAIL_ENABLED_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<!--
		<label for="set__debug_mode"><?php $this->set('SHOWCONFIG__DEBUG_MODE'); ?></label>
		<select name="set__debug_mode" id="set__debug_mode">
			<option value="true" <?php if ($Config->get('debug_mode') == true) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__YES'); ?></option>
			<option value="false" <?php if ($Config->get('debug_mode') == false) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__NO'); ?></option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="debug_mode_info_img" onclick="javascript:toggleInfo('debug_mode_info');" />
		<div class="form_infobox" id="debug_mode_info" onclick="javascript:toggleInfo('debug_mode_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__DEBUG_MODE_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		-->
		<label for="set__system_online"><?php $this->set('SHOWCONFIG__SYSTEM_ONLINE'); ?></label>
		<select name="set__system_online" id="set__system_online">
			<option value="true" <?php if ($Config->get('system_online') == true) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__YES'); ?></option>
			<option value="false" <?php if ($Config->get('system_online') == false) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__NO'); ?></option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="system_online_info_img" onclick="javascript:toggleInfo('system_online_info');" />
		<div class="form_infobox" id="system_online_info" onclick="javascript:toggleInfo('system_online_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__SYSTEM_ONLINE_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
		<label for="set__allow_registration">
			<?php $this->set('SHOWCONFIG__ALLOW_REGISTRATION'); ?>
		</label>
		<select name="set__allow_registration" id="set__allow_registration">
			<option value="true" <?php if ($Config->get('allow_registration') == true) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__YES'); ?></option>
			<option value="false" <?php if ($Config->get('allow_registration') == false) echo 'selected="selected"'; ?>><?php $this->set('SHOWCONFIG__NO'); ?></option>
		</select>
		<img src="templates/images/info.gif" alt="Info" class="form_infoimg" id="allow_registration_info_img" onclick="javascript:toggleInfo('allow_registration_info');" />
		<div class="form_infobox" id="allow_registration_info" onclick="javascript:toggleInfo('allow_registration_info');">
			<img src="templates/images/arrow_top2downright.gif" class="form_infoimg_in" />
			<?php $this->set('SHOWCONFIG__ALLOW_REGISTRATION_INFO'); ?>
		</div>
		<div style="clear:both;"></div>
	</fieldset>

	<input type="submit" class="ts_submit" value="<?php echo $this->set('SHOWCONFIG__SUBMIT'); ?>" />
	<input type="reset" class="ts_reset" value="<?php echo $this->set('SHOWCONFIG__RESET'); ?>" />
</form>
<script type="text/javascript">

	// all info-fields
	var inputs = new Array();
	inputs[0] = 'db_class_info';
	inputs[1] = 'db_host_info';
	inputs[2] = 'db_user_info';
	inputs[3] = 'db_pass_info';
	inputs[4] = 'db_database_info';
	inputs[5] = 'encryption_class_info';
	inputs[6] = 'encryption_algorithm_info';
	inputs[7] = 'encryption_mode_info';
	inputs[8] = 'system_secret_info';
	inputs[9] = 'default_language_info';
	inputs[10] = 'system_email_info';
	inputs[11] = 'preffix_info';
	inputs[12] = 'email_enabled_info';
	inputs[13] = 'root_folder_info';
	inputs[14] = 'data_folder_info';
	inputs[15] = 'system_online_info';
	inputs[16] = 'allow_registration_info';

//	inputs[16] = 'debug_mode_info';

	function hideInfo (id) {
		document.getElementById(id).style.display = 'none';
		document.getElementById(id+'_img').style.display = 'block';
		return true;
	}

	function showInfo (id) {
		document.getElementById(id).style.display = 'block';
		document.getElementById(id+'_img').style.display = 'none';
		return true;
	}

	function hideAll () {
		for (var i = 0; i < inputs.length; i++) 
			hideInfo(inputs[i]);
		return true;
	}

	function showAll () {
		for (var i = 0; i < inputs.length; i++) 
			showInfo(inputs[i]);
		return true;
	}

	function toggleInfo (id) {
		if (document.getElementById(id).style.display == 'none')
			showInfo(id);
		else
			hideInfo(id);

		return true;
	}

	// hide all
	hideAll();
</script>
