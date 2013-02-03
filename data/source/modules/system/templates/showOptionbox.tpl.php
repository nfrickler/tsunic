<!-- | TEMPLATE show optionbox -->
<div id="$$$div__showOptionbox">
    <h1><?php $this->set('#headertext#'); ?></h1>
    <p style="margin-bottom:20px;" class="ts_infotext"><?php $this->set('#contenttext#'); ?></p>
    <a class="ts_submit" href="<?php echo $this->getVar('submit_href'); ?>"><?php $this->set('#submittext#'); ?></a>
    <a class="ts_cancel" href="<?php echo $this->getVar('cancel_href'); ?>"><?php $this->set('#canceltext#'); ?></a>
</div>
