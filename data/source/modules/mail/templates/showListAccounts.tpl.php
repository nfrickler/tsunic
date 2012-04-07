<!-- | Template: show list of mail accounts -->
<?php

// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

$mailaccounts = $this->getVar('mailaccounts');
?>
<div id="$$$div__showListAccounts">
	<?php if (count($mailaccounts) > 0) { ?>
	<table>
		<tr style="width:100%;">
			<th><?php $this->set('{SHOWLISTACCOUNTS__NAME}'); ?></th>
			<th><?php $this->set('{SHOWLISTACCOUNTS__DESCRIPTION}'); ?></th>
			<th><?php $this->set('{SHOWLISTACCOUNTS__EMAIL}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($mailaccounts as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<td>
				<a href="<?php $this->setUrl('$$$showAccount', array('id_mail__account' => $value->getInfo('id_mail__account'))); ?>">
					<?php $this->set($value->getInfo('name')); ?>
				</a>
			</td>
			<td>
				<?php $this->set($value->getInfo('description')); ?>
			</td>
			<td>
				<?php $this->set($value->getInfo('email')); ?>
			</td>
			<td>
				<a href="<?php $this->setUrl('$$$showEditAccount', array('id_mail__account' => $value->getInfo('id_mail__account')));?>">
					<img class="system_editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWLISTACCOUNTS__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('$$$showDeleteAccount', array('id_mail__account' => $value->getInfo('id_mail__account')));?>"  id="$$$showListAccounts__delete_<?php $this->set($value->getInfo('id_mail__account')); ?>">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTACCOUNTS__DELETE}'); ?>" />
				</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWLISTACCOUNTS__NOACCOUNTS}'); ?>
	</p>
	<?php } ?>
</div>

<script type="text/javascript">

	// get mailaccounts
	var $$$showListAccounts__all = new Array();
	<?php foreach ($mailaccounts as $index => $value) {
	if ($value->getInfo('id_mail__account') == 0) continue;
	echo '$$$showListAccounts__all["id_'.$value->getInfo('id_mail__account').'"] = new Array("$$$showListAccounts__delete_'.$value->getInfo('id_mail__account').'",
		"'.$value->getInfo('name').'",
		"'.$this->setUrl('$$$deleteAccount', array('id_mail__account' => $value->getInfo('id_mail__account')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showListAccounts__all) {
		function $$$showListAccounts__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = $system$showOptionbox('<?php $this->setjs('{SHOWDELETEACCOUNT__POPUP_DELETE_HEADER_JS}'); ?>',
				'<?php $this->setjs('{SHOWDELETEACCOUNT__POPUP_DELETE_CONTENT}'); ?>',
				'<?php $this->setjs('{SHOWDELETEACCOUNT__POPUP_DELETE_YES}'); ?>',
				'<?php $this->setjs('{SHOWDELETEACCOUNT__POPUP_DELETE_NO}'); ?>');

				// add yes-button-event
				allobjects['button1'].onclick = function(){

					// redirect
					location.href= button1_href;

				};

				// reset onclick
				return false;
			};

		}
		$$$showListAccounts__addEvents($$$showListAccounts__all[arr_index]);
	}
</script>
