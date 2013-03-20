<!-- | subcodes -->
[sub:classes/$system$TemplateEngine.class.php:377]
$TSunic->Tmpl->activate('$$$_navigation_header', '$system$navigation_header', false, 'left_on');
[sub:classes/$usersystem$User.class.php:150]
$MyProfile = $TSunic->get('$profile$MyProfile');
$MyProfile->create();
$MyProfile->saveByTag('PROFILE__ACCOUNT', $this->id);
$MyProfile->shareWith_all(array($this->getIdGuest() => 0));
[sub:classes/$usersystem$User.class.php:206]
$MyProfile = $TSunic->get('$profile$MyProfile');
$MyProfile->create();
$MyProfile->saveByTag('PROFILE__ACCOUNT', $this->id);
$MyProfile->shareWith_all(array($this->getIdGuest() => 0));
