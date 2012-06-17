<!-- | TEMPLATE delete account? -->
<?php

// get data
$User = $this->getVar('User');
?>
<div id="$$$div__showdeleteAccount">
    <h1><?php $this->set('{SHOWDELETEACCOUNT__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWDELETEACCOUNT__INFOTEXT}'); ?>
    </p>
    <form action="<?php $this->setUrl('$$$deleteAccount'); ?>" method="post" name="$$$showDeleteAccount__form" id="$$$showDeleteAccount__form" class="ts_form">
	<fieldset>
	    <legend><?php echo $this->set('{SHOWDELETEACCOUNT__LEGEND}'); ?></legend>
	    <label for="$$$showDeleteAccount__password"><?php echo $this->set('{SHOWDELETEACCOUNT__PASSWORD}'); ?></label>
	    <input type="password" name="$$$showDeleteAccount__password" id="$$$showDeleteAccount__password" class="ts_input" />
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php echo $this->set('{SHOWDELETEACCOUNT__SUBMIT}'); ?>" />
    </form>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('$$$showAccount'); ?>">
	    <?php $this->set('{SHOWDELETEACCOUNT__TOSHOWACCOUNT}'); ?></a>
    </p>
</div>
<script type="text/javascript">

    // set default values
    $system$setInputDefault(document.getElementById('$$$showDeleteAccount__password'), '*******');

    // add events
    document.getElementById('$$$showDeleteAccount__password').onfocus = function(){$system$clearInput(this, '*******');};
    document.getElementById('$$$showDeleteAccount__password').onblur = function(){$system$setInputDefault(this, '*******');};

    // focus on password
    document.getElementById('$$$showDeleteAccount__password').focus();
</script>
