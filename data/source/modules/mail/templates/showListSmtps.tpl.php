<!-- | Template: show list of SMTPs -->
<?php
// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$smtps = $this->getVar('smtps');
?>
<div id="$$$div__showListSmtps">
	<?php if (is_array($smtps) AND count($smtps) > 0) { ?>
	<table>
		<tr style="width:100%;">
			<th><?php $this->set('{SHOWLISTSMTPS__EMAILNAME}'); ?></th>
			<th><?php $this->set('{SHOWLISTSMTPS__DESCRIPTION}'); ?></th>
			<th><?php $this->set('{SHOWLISTSMTPS__AUTH}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($smtps as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<td>
				<?php $this->set($value->getInfo('emailname')); ?> &lt;<?php $this->set($value->getInfo('email')); ?>&gt;
			</td>
			<td>
				<?php $this->set($value->getInfo('description')); ?>
			</td>
			<td>
				<?php $this->set($value->getConnsecurity(false, false)); ?>
			</td>
			<td>
				<?php if ($value->getInfo('id') != 0) { ?>
				<a href="<?php $this->setUrl('$$$showEditSmtp', array('$$$id' => $value->getInfo('id')));?>">
					<img class="$system$editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWLISTSMTPS__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('$$$showDeleteSmtp', array('id' => $value->getInfo('id')));?>"  id="$$$showListSmtps__delete_<?php $this->set($value->getInfo('id')); ?>">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTSMTPS__DELETE}'); ?>" />
				</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWLISTSMTPS__NOSMTPS}'); ?>
	</p>
	<?php } ?>
</div>

<script type="text/javascript">

	// get smtps
	var $$$showListSmtps_all = new Array();
	<?php foreach ($smtps as $index => $value) {
	if ($value->getInfo('id') == 0) continue;
	echo '$$$showListSmtps_all["id_'.$value->getInfo('id').'"] = new Array("$$$showListSmtps__delete_'.$value->getInfo('id').'",
			"'.$value->getInfo('name').'",
			"'.$this->setUrl('$$$deleteSmtp', array('$$$id' => $value->getInfo('id')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showListSmtps_all) {
		function $$$showListSmtps__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = $system$showOptionbox('<?php $this->set('{SHOWDELETESMTP__POPUP_DELETE_HEADER_JS}'); ?>',
				'<?php $this->set('{SHOWDELETESMTP__POPUP_DELETE_CONTENT}'); ?>',
				'<?php $this->set('{SHOWDELETESMTP__POPUP_DELETE_YES}'); ?>',
				'<?php $this->set('{SHOWDELETESMTP__POPUP_DELETE_NO}'); ?>');

				// add yes-button-event
				allobjects['button1'].onclick = function(){

					// redirect
					location.href= button1_href;

				};

				// reset onclick
				return false;
			};

		}
		$$$showListSmtps__addEvents($$$showListSmtps_all[arr_index]);
	}
</script>
