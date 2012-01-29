<!-- | TEMPLATE show account -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/showAccount.tpl.php
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
<div id="$$$div__showAccount">
	<h1><?php echo $this->set('{SHOWACCOUNT__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a id="$$$showAccount__editlink" href="<?php $this->setUrl('$$$showEditAccount'); ?>">
			<?php $this->set('{SHOWACCOUNT__TOEDITACCOUNT}'); ?></a>
		<a id="$$$showAccount__deletelink" href="<?php $this->setUrl('$$$showDeleteAccount'); ?>">
			<?php $this->set('{SHOWACCOUNT__TODELETEACCOUNT}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWACCOUNT__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
	    <tr>
	        <th style="min-width:200px;"><?php echo $this->set('{SHOWACCOUNT__EMAIL}'); ?></th>
	        <td style="min-width:200px;" id="$$$showAccount__email"><?php $this->set($User->getInfo('email')); ?></td>
	    </tr>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__PASSWORD}'); ?></th>
	        <td id="$$$showAccount__password">*******</td>
	    </tr>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__DATEOFREGISTRATION}'); ?></th>
	        <td id="$$$showAccount__dateOfRegistration"><?php $this->set($User->getInfo('dateOfRegistration')); ?></td>
	    </tr>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__DATEOFCHANGE}'); ?></th>
	        <td id="$$$showAccount__dateOfChange"><?php $this->set($User->getInfo('dateOfChange')); ?></td>
	    </tr>
	</table>
</div>
<script type="text/javascript">
/*
	var div_showAccount_email = document.getElementById('ts_showAccount_email');
	var div_showAccount_email_set = div_showAccount_email.firstChild.nodeValue;
	var div_showAccount_password = document.getElementById('ts_showAccount_password');
	// add elements to remove
//	current_noscript.push(document.getElementById('div_system_users_showAccount_editlink'));
	// add infobox
	var paragraph = document.createElement('p');
	var content = document.createTextNode('SYSTEM_USERS_SHOWACCOUNT_EDITPROFILEINFO');
	paragraph.appendChild(content);
	document.getElementById('div_system_user_showAccount').appendChild(paragraph);
    paragraph.style.marginTop = '20px';
	// add events
	div_showAccount_email.onclick = function(){
		if (!document.getElementById('div_showAccount_email_form')) {
			var content;
			// remove other forms
			if (current_elements['form']) {
			    system_removeElement(current_elements['form']);
                current_elements = new Array();
				div_showAccount_password.firstChild.nodeValue = '*******';
			}
			// empty
			div_showAccount_email.firstChild.nodeValue = '';
			// create form
			current_elements['form'] = document.createElement('form');
			content = document.createTextNode('');
			current_elements['form'].appendChild(content);
			div_showAccount_email.appendChild(current_elements['form']);
			current_elements['form'].method='post';
			current_elements['form'].action='?module=system_users&event=doSetEMail';
			current_elements['form'].id = 'div_showAccount_email_form';
            div_showAccount_email.onblur = function() {
            	div_showAccount_email.innerHTML = 'whats on';
				system_removeElement(current_elements['form']);
			};
			// create input
			current_elements['input'] = document.createElement('input');
			content = document.createTextNode(div_showAccount_email_set);
			current_elements['form'].appendChild(current_elements['input']);
			current_elements['input'].value = div_showAccount_email_set;
			current_elements['input'].name = 'email';
			current_elements['input'].style.width = '200px';
			// add css
			current_elements['input'].setAttribute("class", "ts_input"); //For Most Browsers
			current_elements['input'].setAttribute("className", "ts_input"); //For IE; harmless to other browsers.
			// add events
			current_elements['input'].onfocus = function(){clearInput(this, 'SYSTEM_USERS_DEFAULTINPUT_EMAIL');};
			current_elements['input'].onblur = function(){setInputDefault(this, 'SYSTEM_USERS_DEFAULTINPUT_EMAIL');};
			// create submit
			current_elements['submit'] = document.createElement('button');
			content = document.createTextNode('Submit');
			current_elements['submit'].appendChild(content);
			current_elements['form'].appendChild(current_elements['submit']);
			current_elements['submit'].setAttribute("class", "ts_submit"); //For Most Browsers
			current_elements['submit'].setAttribute("className", "ts_submit"); //For IE; harmless to other browsers.
			current_elements['submit'].onclick = function(){current_elements['form'].submit();};
            current_elements['input'].focus();
		}
	};
	div_showAccount_password.onclick = function(){
		if (!document.getElementById('div_showAccount_password_form')) {
			var content;
			// remove other forms
			if (current_elements['form']) {
				system_removeElement(current_elements['form']);
				current_elements = new Array();
				div_showAccount_email.firstChild.nodeValue = div_showAccount_email_set;
			}
			// empty
			div_showAccount_password.firstChild.nodeValue = '';
			// create form
			current_elements['form'] = document.createElement('form');
			content = document.createTextNode('');
			current_elements['form'].appendChild(content);
			div_showAccount_password.appendChild(current_elements['form']);
			current_elements['form'].method='post';
			current_elements['form'].action='?module=system_users&event=doSetPassword';
			current_elements['form'].id = 'div_showAccount_password_form';
			current_elements['form'].onblur = function() {
				alert('Save changes?');
			};
			// create input
			current_elements['input'] = document.createElement('input');
			content = document.createTextNode('');
			current_elements['input'].appendChild(content);
			current_elements['form'].appendChild(current_elements['input']);
			current_elements['input'].value = '';
			current_elements['input'].type = 'password';
			current_elements['input'].style.width = '200px';
			current_elements['input'].name = 'password';
			// add css
			current_elements['input'].setAttribute("class", "ts_input"); //For Most Browsers
			current_elements['input'].setAttribute("className", "ts_input"); //For IE; harmless to other browsers.
			// add events
			current_elements['input'].onfocus = function(){clearInput(this, 'password');};
			current_elements['input'].onblur = function(){setInputDefault(this, 'password');};
			// create submit
			current_elements['submit'] = document.createElement('button');
			content = document.createTextNode('Submit');
			current_elements['submit'].appendChild(content);
			current_elements['form'].appendChild(current_elements['submit']);
			current_elements['submit'].setAttribute("class", "ts_submit"); //For Most Browsers
			current_elements['submit'].setAttribute("className", "ts_submit"); //For IE; harmless to other browsers.
			current_elements['submit'].onclick = function(){current_elements['form'].submit();};
            current_elements['input'].focus();
		}
	};
*/
</script>