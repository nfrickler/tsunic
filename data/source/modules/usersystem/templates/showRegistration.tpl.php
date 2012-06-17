<!-- | TEMPLATE show registration -->
<div id="$$$div__showRegistration">
    <h1><?php echo $this->set('{SHOWREGISTRATION__H1}'); ?></h1>
    <p class="ts_infotext"><?php echo $this->set('{SHOWREGISTRATION__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formAccount', array(
	'User' => $this->getVar('User'),
	'submit_link' => '$$$doRegister',
	'submit_text' => '{SHOWREGISTRATION__SUBMIT}',
	'password_required' => true
    )); ?>
</div>
