<!-- | TEMPLATE show form to edit profile -->
<?php $Profile = $this->getVar('Profile'); ?>
<div id="$$$div__showEditProfile">
    <h1><?php $this->set('{SHOWEDITPROFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showEditProfile__editlink" href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{SHOWEDITPROFILE__TOSHOWTAGS}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITPROFILE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formProfile', array(
	'Profile' => $Profile,
	'submit_link' => '$$$editProfile',
	'submit_text' => '{SHOWEDITPROFILE__SUBMIT}',
	'reset_text' => '{SHOWEDITPROFILE__CANCEL}'
    )); ?>
</div>
