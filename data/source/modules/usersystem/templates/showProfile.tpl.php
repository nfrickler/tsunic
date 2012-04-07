<!-- | TEMPLATE show profile -->
<?php
// get data
$User = $this->getVar('User');
?>
<div id="$$$div__showProfile">
	<h1><?php echo $this->set('{SHOWPROFILE__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<!-- | <a id="$$$showAccount_editlink" href="<?php $this->setUrl('$$$showEditProfile'); ?>">
			<?php $this->set('{SHOWACCOUNT__TOEDITPROFILE}'); ?>
		</a> 
		-->
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWPROFILE__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
		<tr>
			<th style="min-width:200px;"><?php echo $this->set('{SHOWPROFILE__NAME}'); ?></th>
			<td style="min-width:200px;" id="$$$showProfile__name"><?php $this->set($User->getInfo('name')); ?></td>
		</tr>
	</table>
</div>
