<!-- | TEMPLATE show profile -->
<?php $Profile = $this->getVar('Profile'); ?>
<div id="$$$div__showProfile">
    <h1><?php echo $this->set('{SHOWPROFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showProfile__editlink" href="<?php $this->setUrl('$$$showEditProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TOEDITPROFILE}'); ?></a>
	<a id="$$$showProfile__deletelink" href="<?php $this->setUrl('$$$showDeleteProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TODELETEPROFILE}'); ?></a>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th style="min-width:200px;"><?php $this->set('{SHOWPROFILE__NAME}'); ?></th>
	    <td style="min-width:200px;" id="$$$showProfile__name">
		<?php $this->set($Profile->getInfo('firstname')." ".$Profile->getInfo('lastname')); ?>
	    </td>
	</tr>
    </table>
</div>
