<!-- | TEMPLATE show form to create new profile -->
<div id="$$$div__showCreateProfile">
    <h1><?php $this->set('{SHOWCREATEPROFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showCreateProfile__createlink" href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{SHOWCREATEPROFILE__TOSHOWTAGS}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEPROFILE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formProfile', array(
	'Profile' => $this->getVar('Profile'),
	'submit_link' => '$$$createProfile',
	'submit_text' => '{SHOWCREATEPROFILE__SUBMIT}',
	'reset_text' => '{SHOWCREATEPROFILE__CANCEL}'
    )); ?>
</div>
