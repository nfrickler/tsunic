<!-- | TEMPLATE show form to edit profile -->
<?php $Profile = $this->getVar('Profile'); ?>
<div id="$$$div__showEditProfile">
    <h1><?php $this->set('{SHOWEDITPROFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITPROFILE__TOSHOWPROFILE}'); ?></a>
	<a href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{SHOWEDITPROFILE__TOSHOWTAGS}'); ?></a>
	<a href="<?php $this->setUrl('$bp$showAddTag', array('fk_obj' => $Profile->getInfo('id'), 'backlink' => base64_encode($this->setUrl('$$$showEditProfile', array('$$$id' => $Profile->getInfo('id')), false, false)))); ?>">
	    <?php $this->set('{SHOWEDITPROFILE__TOADDTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITPROFILE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formProfile', array(
	'Profile' => $Profile,
	'preset_dateofbirth' => $this->getVar('preset_dateofbirth'),
	'submit_link' => '$$$editProfile',
	'submit_text' => '{SHOWEDITPROFILE__SUBMIT}',
	'reset_text' => '{SHOWEDITPROFILE__CANCEL}'
    )); ?>
</div>
