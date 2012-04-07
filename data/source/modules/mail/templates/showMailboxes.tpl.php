<!-- | Template: show all mailboxes -->
<?php

// add javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$mailboxes = $this->getVar('mailboxes');
?>
<div id="div_mail__showMailBoxes">
	<h2><?php $this->set('{SHOWMAILBOXES__YOURMAILBOXES}'); ?></h2>

	<table cellspacing="1" cellpadding="5" border="0">
		<tr style="width:100%;">
			<th style="width:200px;"><?php $this->set('{SHOWMAILBOXES__NAME}'); ?></th>
			<th style="max-width:300px; min-width:200px;"><?php $this->set('{SHOWMAILBOXES__DESCRIPTION}'); ?></th>
			<th><?php $this->set('{SHOWMAILBOXES__MAILNUMBER}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($mailboxes as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<td>
				<a href="<?php $this->setUrl('$$$showMailbox', array('id_mail__box' => $value->getInfo('id_mail__box'))); ?>">
					<?php $this->set($value->getInfo('name')); ?>
				</a>
			</td>
			<td>
				<?php $this->set($value->getInfo('description')); ?>
			</td>
			<td style="text-align:center;">
				<?php $this->set($value->getNumber()); ?>
			</td>
			<td>
				<?php if ($value->getInfo('id_mail__box') != 0) { ?>
				<a href="<?php $this->setUrl('$$$showEditMailbox', array('id_mail__box' => $value->getInfo('id_mail__box'))); ?>">
					<img class="$system$editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWMAILBOXES__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('$$$showDeleteMailbox', array('id_mail__box' => $value->getInfo('id_mail__box'))); ?>"  id="$$$showmailboxes__delete_<?php $this->set($value->getInfo('id_mail__box')); ?>">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWMAILBOXES__DELETE}'); ?>" />
				</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddMailbox'); ?>">
			<?php $this->set('{SHOWMAILBOXES__TOCREATENEWBOX}'); ?></a>
	</p>
</div>

<script type="text/javascript">

	// get mailboxes
	var $$$showmailboxes__all = new Array();
	<?php foreach ($this->getVar('mailboxes') as $index => $value) {
		if ($value->getInfo('id_mail__box') == 0) continue;
		echo '$$$showmailboxes__all["id_'.$value->getInfo('id_mail__box').'"] = new Array("$$$showmailboxes__delete_'.$value->getInfo('id_mail__box').'",
			"'.$value->getInfo('name').'",
			"'.$this->setUrl('$$$deleteMailbox', array('id_mail__box' => $value->getInfo('id_mail__box')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showmailboxes__all) {
		function $$$showMailboxes__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = $system$showOptionbox('<?php $this->setjs('{SHOWDELETEMAILBOX__POPUP_DELETE_HEADER_JS}'); ?>',
				'<?php $this->setjs('{SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT}'); ?>',
				'<?php $this->setjs('{SHOWDELETEMAILBOX__POPUP_DELETE_YES}'); ?>',
				'<?php $this->setjs('{SHOWDELETEMAILBOX__POPUP_DELETE_NO}'); ?>');

				// add yes-button-event
				allobjects['button1'].onclick = function(){

					// redirect
					location.href= button1_href;
	
				};

				// reset onclick
				return false;
			};

		}
		$$$showMailboxes__addEvents($$$showmailboxes__all[arr_index]);
	}
</script>
