<!-- | Template: show list of serverboxes -->
<?php
// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$serverboxes = $this->getVar('serverboxes');
$selectable = $this->getVar('selectable');
?>
<div id="$$$div__showListServerboxes">
	<?php if (is_array($serverboxes) AND count($serverboxes) > 0) { ?>
	<table>
		<tr style="width:100%;">
			<?php if (!empty($selectable)) { ?>
			<th width="20">&nbsp;</th>
			<?php } ?>
			<th><?php $this->set('{SHOWLISTSERVERBOXES__NAME}'); ?></th>
			<th><?php $this->set('{SHOWLISTSERVERBOXES__FKMAILBOX}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($serverboxes as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<?php if (!empty($selectable)) { ?>
			<td>
				<input type="checkbox" id="<?php echo $selectable.$value->getInfo('id'); ?>" name="<?php echo $selectable.'_'.$value->getInfo('id'); ?>" <?php if ($value->getInfo('isActive') == 1) echo 'checked="checked"'; ?> />
			</td>
			<?php } ?>
			<td>
				<strong><?php $this->set($value->getInfo('name')); ?></strong>
			</td>
			<td>
				<?php $this->set($value->getInfo('Mailbox')->getInfo('name')); ?>
			</td>
			<td>
				<a href="<?php $this->setUrl('$$$showEditServerbox', array('$$$id' => $value->getInfo('id')));?>">
					<img class="$system$editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWLISTSERVERBOXES__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('$$$showDeleteServerbox', array('$$$id' => $value->getInfo('id')));?>"  id="$$$showListServerbox__delete_<?php $this->set($value->getInfo('id')); ?>">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTSERVERBOXES__DELETE}'); ?>" />
				</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWLISTSERVERBOXES__NOSERVER}'); ?>
	</p>
	<?php } ?>
</div>

<script type="text/javascript">

	// get imaps
	var $$$showListServerboxes__all = new Array();
	<?php foreach ($serverboxes as $index => $Value) {
	echo '$$$showListServerboxes__all["id_'.$Value->getInfo('id').'"] = new Array("$$$showListServerbox__delete_'.$Value->getInfo('id').'",
			"'.$Value->getInfo('name').'",
			"'.$this->setUrl('$$$deleteServerbox', array('$$$id' => $Value->getInfo('id')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showListServerboxes__all) {
		function $$$showListServerboxes__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = $system$showOptionbox('<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_HEADER_JS}'); ?>',
				'<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT}'); ?>',
				'<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_YES}'); ?>',
				'<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_NO}'); ?>');

				// add no-button-event
				allobjects['button2'].onclick = function(){
					// remove background
					$system$removeElement(allobjects['background']);

					// remove popup
					$system$removeElement(allobjects['popup']);
				};

				// add yes-button-event
				allobjects['button1'].onclick = function(){

					// redirect
					location.href= button1_href;
				};

				// reset onclick
				return false;
			};

		}
		$$$showListServerboxes__addEvents($$$showListServerboxes__all[arr_index]);
	}

</script>
