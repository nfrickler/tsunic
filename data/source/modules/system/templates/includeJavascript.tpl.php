<!-- | TEMPLATE include all embedded javascript-code -->
<?php

// check, if javascript is disabled (=return)
if ($TSunic->isJavascript(true) == 'off') return;

// add javascript
$TSunic->Tmpl->addJSfunction('$$$removeElement');
$TSunic->Tmpl->addJSfunction('$$$showPopup');
$TSunic->Tmpl->addJSfunction('$$$setInputDefault');
$TSunic->Tmpl->addJSfunction('$$$clearInput');
$TSunic->Tmpl->addJSfunction('$$$resetInput');
$TSunic->Tmpl->addJSfunction('$$$showHelpbox');
$TSunic->Tmpl->addJSfunction('$$$showFormHelp');

// get js-functions and -classes for include
$js_functions = $TSunic->Tmpl->getActivatedJavascript();

foreach ($js_functions as $index => $value) {
    $path = 'javascript/'.$value.'.js';
    echo '<script type="text/javascript" src="'.$path.'"></script>';
}
?>
<script type="text/javascript">
<?php
$code = $TSunic->Tmpl->getAllJavascript();
foreach ($code as $index => $value) {
    echo base64_decode($value);
}
?>
</script>
