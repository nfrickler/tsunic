<!-- | subcodes -->
[sub:classes/$system$TemplateEngine.class.php:391]
$TSunic->Tmpl->activate('$$$_navigation_header', '$system$navigation_header', false, 'left_on');
[sub:classes/$usersystem$User.class.php:156]
$MyProfile = $TSunic->get('$profile$MyProfile');
$MyProfile->create();
$MyProfile->saveByTag('PROFILE__ACCOUNT', $this->id);
$MyProfile->shareWith_all(array($this->getIdGuest() => 0));
[sub:classes/$usersystem$User.class.php:214]
$MyProfile = $TSunic->get('$profile$MyProfile');
$MyProfile->create();
$MyProfile->saveByTag('PROFILE__ACCOUNT', $this->id);
$MyProfile->shareWith_all(array($this->getIdGuest() => 0));
