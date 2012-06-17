<!-- | template to show login page -->
<?php
// deny direct access
defined('TS_INIT') OR die('Access denied!');
?>
<h1><?php $this->set('SHOWLOGIN__H1'); ?></h1>
<p>
    <?php $this->set('SHOWLOGIN__INFOTEXT'); ?>
</p>
<form action="?event=doLogin" method="post" class="ts_form">
    <fieldset>
	<legend><?php echo $this->set('SHOWLOGIN__LEGEND'); ?></legend>
	<label for="pass"><?php echo $this->set('SHOWLOGIN__PASSWORD'); ?></label>
	<input type="password" name="pass" id="pass" />
	<div style="clear:both;"></div>
    </fieldset>
    <input type="submit" class="ts_submit" value="<?php echo $this->set('SHOWLOGIN__SUBMIT'); ?>" />
</form>
