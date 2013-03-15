<!-- | TEMPLATE show list of all myprofiles -->
<div id="$$$div__showMyProfiles">
    <h1><?php $this->set('{SHOWMYPROFILES__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWMYPROFILES__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$showListProfiles', array(
	'profiles' => $this->getVar('profiles'),
    )); ?>
</div>
