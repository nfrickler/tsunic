<!-- | TEMPLATE show form to login -->
<div id="$$$div__formLogin">
    <form action="<?php $this->setUrl('$$$doLogin'); ?>" method="post" name="$$$formLogin__form" id="$$$formLogin__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMLOGIN__LEGEND}'); ?></legend>
	    <label for="$$$formLogin__emailname"><?php $this->set('{FORMLOGIN__EMAIL}'); ?></label>
	    <input type="text" class="ts_required" name="$$$formLogin__emailname" id="$$$formLogin__emailname" value="<?php $this->setPreset('$$$formLogin_emailname', $TSunic->Temp->getCookie('$$$formLogin__emailname')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formLogin__password"><?php $this->set('{FORMLOGIN__PASSWORD}'); ?></label>
	    <input type="password" class="ts_required" name="$$$formLogin__password" id="$$$formLogin__password" />
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('{FORMLOGIN__SUBMIT}'); ?>" />
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
//    document.getElementById('$$$formLogin__emailname').focus();
</script>
