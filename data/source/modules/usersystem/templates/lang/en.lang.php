<!-- | language file english -->
<?php
$lang = array(

	// special
	'ISROOTPASSWORD__FAILED' => 'Please set a password for the administrator account "root" before creating new user!',

	// access
	'ACCESS__DELETEALLUSERS' => 'Delete all users',
	'ACCESS__DELETEALLUSERS_DESCRIPTION' => 'This allows to delete every user on this system.',
	'ACCESS__EDITALLACCESS' => 'Edit all access',
	'ACCESS__EDITALLACCESS_DESCRIPTION' => 'Allows to edit all access for all users.',
	'ACCESS__EDITALLUSERS' => 'Edit all users',
	'ACCESS__EDITALLUSERS_DESCRIPTION' => 'This allows to edit all usrs.',
	'ACCESS__LISTALLUSERS' => 'List all users',
	'ACCESS__LISTALLUSERS_DESCRIPTION' => 'Allows to show full list of users on this system.',
	'ACCESS__SEEALLACCESS' => 'See all access',
	'ACCESS__SEEALLACCESS_DESCRIPTION' => 'Enables to see all access of all users on this system.',
	'ACCESS__SEEALLDATA' => 'Adminview on data',
	'ACCESS__SEEALLDATA_DESCRIPTION' => 'Enables to see all personal data of users.',
	'ACCESS__SEEOWNACCESS' => 'See own access',
	'ACCESS__SEEOWNACCESS_DESCRIPTION' => 'Allows user to see its own access values.',

	// userheader
	'USERHEADER__LOGGEDINAS' => 'You are logged in as #name#.',
	'USERHEADER__LOGOUT' => 'Logout',
	'USERHEADER__NOTLOGGEDIN' => 'Please log in to use more functions of TSunic!',

	// showIndex
	'SHOWINDEX__TITLE' => 'Index',
	'SHOWINDEX__H1' => 'Welcome!',
	'SHOWINDEX__INFOTEXT' => 'Welcome on this system! Please log in to enter the system... If you don\'t have an account on this system yet, please create a new one by filling in the form at the bottom of this page.',
	'SHOWINDEX__LOGIN_H1' => 'Login (to your account)',
	'SHOWINDEX__REGISTER_H1' => 'Register (a new account)',
	'SHOWINDEX__REGISTER_INFOTEXT' => 'Please fill in this form, to create your own, new account. Only one account per user!',
	'SHOWINDEX__RESET_H1' => 'Reset cookies',
	'SHOWINDEX__RESET_INFOTEXT' => 'If you have logged in on an computer being used also by other people, you should reset the cookies for enhanced safety; e.g. this will clear the e-mail/username in the login-form.',
	'SHOWINDEX__REGISTER_LINK' => 'Reset cookies of this page',

	/* *************** login and registration ****************** */

	// showLogin
	'SHOWLOGIN__TITLE' => 'Login',
	'SHOWLOGIN__H1' => 'Login (to your account)',
	'SHOWLOGIN__INFOTEXT' => 'Fill in your login-data to enter the system. If you don\'t have an account yet, please register a new one!',
	'SHOWLOGIN__RESET_H1' => 'Reset cookies',
	'SHOWLOGIN__RESET_INFOTEXT' => 'If you have logged in on an computer being used also by other people, you should reset the cookies for enhanced safety; e.g. this will clear the e-mail/username in the login-form by going to the registration-page.',
	'SHOWLOGIN__RESET_LINK' => 'Reset cookies of this page',

	// formLogin
	'FORMLOGIN__LEGEND' => 'Your login-data',
	'FORMLOGIN__EMAIL' => 'E-mail or username',
	'FORMLOGIN__EMAIL_PRESET' => 'Your e-mail or username...',
	'FORMLOGIN__EMAIL_HELP' => 'Fill in your e-mail-address or username.',
	'FORMLOGIN__PASSWORD' => 'Password',
	'FORMLOGIN__PASSWORD_HELP' => 'Fill in your password.',
	'FORMLOGIN__SUBMIT' => 'Login now',

	// doLogin
	'DOLOGIN__SUCCESS' => 'Your login has been successful.',
	'DOLOGIN__FAILED' => 'Login failed. Either e-mail/username or password has been incorrect.',

	// doLogout
	'DOLOGOUT__SUCCESS' => 'Your logout has been successful.',

	// showRegistration
	'SHOWREGISTRATION__TITLE' => 'Registration',
	'SHOWREGISTRATION__H1' => 'Registration (a new account)',
	'SHOWREGISTRATION__INFOTEXT' => 'Please fill in this form, to create your own, new account. Only one account per user!',
	'SHOWREGISTRATION__SUBMIT' => 'Create new account',
	'SHOWREGISTRATION__RESET' => 'Reset',

	// do register
	'DOREGISTER__INVALIDREPEAT' => 'Password has been repeated incorrectly - please try again!',
	'DOREGISTER__SUCCESS' => 'You have successfully registered. You can log in now...',
	'DOREGISTER__ERROR' => 'Your registration has failed. Please try again!',
	'DOREGISTER__INVALIDEMAIL' => 'Invalid e-mail-address! Maybe you have already registered with this e-mail-address?',
	'DOREGISTER__INVALIDPASSWORD' => 'Invalid password! Password must have at least 7 characters.',
	'DOREGISTER__INVALIDNAME' => 'Invalid username! Maybe this name is already used by someone else...',

	/* ***************** config ******************************* */

	// showConfig
	'SHOWCONFIG__TITLE' => 'Configuration',
	'SHOWCONFIG__H1' => 'Configuration',
	'SHOWCONFIG__INFOTEXT' => 'Here you can configure your account.',
	'SHOWCONFIG__NAME' => 'Name',
	'SHOWCONFIG__VALUE' => 'Value',
	'SHOWCONFIG__DEFAULT' => 'Default',
	'SHOWCONFIG__DESCRIPTION' => 'Description',
	'SHOWCONFIG__USEDEFAULT' => 'Use default',
	'SHOWCONFIG__SUBMIT' => 'Save',
	'SHOWCONFIG__RESET' => 'Reset',

	// setConfig
	'SETCONFIG__ERROR' => 'An error occurred while saving one option.',
	'SETCONFIG__SUCCESS' => 'Config saved.',

	/* ***************** access ******************************* */

	// showAccess
	'SHOWACCESS__TITLE' => 'Access',
	'SHOWACCESS__H1' => 'Access',
	'SHOWACCESS__TOACCESSGROUPS' => 'Edit accessgroups',
	'SHOWACCESS__INFOTEXT' => 'Here you can administrate the access of accounts.',
	'SHOWACCESS__H_ACCESSOF' => 'Show access of #name#',
	'SHOWACCESS__NAME' => 'Name',
	'SHOWACCESS__VALUE' => 'Access?',
	'SHOWACCESS__BYGROUPS' => 'Default by groups',
	'SHOWACCESS__BYPARENT' => 'Default by parent groups',
	'SHOWACCESS__DESCRIPTION' => 'Description',
	'SHOWACCESS__USEDEFAULT' => 'Use default',
	'SHOWACCESS__YES' => 'Yes',
	'SHOWACCESS__NO' => 'No',
	'SHOWACCESS__SUBMIT' => 'Save',
	'SHOWACCESS__RESET' => 'Reset',

	'SETACCESS__SUCCESS' => 'Value have been saved.',
	'SETACCESS__ERROR' => 'An error occurred while saving value!',

	/* ***************** accessgroups *************************** */

	'SHOWACCESSGROUPS__TITLE' => 'Accessgroups',
	'SHOWACCESSGROUPS__H1' => 'Accessgroups',
	'SHOWACCESSGROUPS__INFOTEXT' => 'This page lists all available accessgroups. You can add a new one or edit/delete existing ones.',

	// showAccessgroup
	'SHOWACCESSGROUP__TITLE' => 'Berechtigungsgruppe',
	'SHOWACCESSGROUP__H1' => 'Berechtigungsgruppe #name#',
	'SHOWACCESSGROUP__TODELETEACCESSGROUP' => 'Berechtigungsgruppe löschen',
	'SHOWACCESSGROUP__TOSHOWACCESSGROUPMEMBERS' => 'Mitglieder verwalten',
	'SHOWACCESSGROUP__INFOTEXT' => 'Hier kannst du die Berechtigungsgruppe bearbeiten.',
	'SHOWACCESSGROUP__SUBMIT' => 'Änderungen speichern',
	'SHOWACCESSGROUP__CANCEL' => 'Abbrechen',

	// showCreateAccessgroup
	'SHOWCREATEACCESSGROUP__TITLE' => 'Neue Berechtigungsgruppe',
	'SHOWCREATEACCESSGROUP__H1' => 'Neue Berechtigungsgruppe',
	'SHOWCREATEACCESSGROUP__INFOTEXT' => 'Fülle das Formular aus, um eine neue Berechtigungsgruppe zu erstellen.',
	'SHOWACCESSGROUP__SUBMIT' => 'Gruppe erstellen',
	'SHOWACCESSGROUP__CANCEL' => 'Abbrechen',

	// editAccessgroup
	'EDITACCESSGROUP__INVALIDNAME' => 'Ungültiger Name!',
	'EDITACCESSGROUP__INVALIDPARENT' => 'Ungültige übergeordnete Gruppe!',
	'EDITACCESSGROUP__SUCCESS' => 'Änderungen wurden gespeichert!',
	'EDITACCESSGROUP__ERROR' => 'Es ist ein Fehler ist aufgetreten!',

	// createAccessgroup
	'CREATEACCESSGROUP__INVALIDNAME' => 'Ungültiger Name!',
	'CREATEACCESSGROUP__INVALIDPARENT' => 'Ungültige übergeordnete Gruppe!',
	'CREATEACCESSGROUP__SUCCESS' => 'Die Berechtigungsgruppe wurde erstellt.',
	'CREATEACCESSGROUP__ERROR' => 'Es ist ein Fehler ist aufgetreten!',

	// formAccessgroup
	'FORMACCESSGROUP__NAME' => 'Name',
	'FORMACCESSGROUP__NAME_PRESET' => 'Name der Berechtigungsgruppe',
	'FORMACCESSGROUP__LEGEND' => 'Berechtigungsgruppe',
	'FORMACCESSGROUP__NAME_HELP' => 'Lege einen Namen für die Berechtigungsgruppe fest.',
	'FORMACCESSGROUP__PARENT' => 'Übergeordnete Gruppe',
	'FORMACCESSGROUP__PARENT_HELP' => 'Wähle eine übergeordnete Gruppe. Von dieser übergeordneten Gruppe wird diese Gruppe die Berechtigungen erben.',

	/* showDeleteAccessgroup */
	'SHOWDELETEACCESSGROUP__TITLE' => 'Berechtigungsgruppe löschen',
	'SHOWDELETEACCESSGROUP__H1' => 'Berechtigungsgruppe #name# löschen?',
	'SHOWDELETEACCESSGROUP__INFOTEXT' => 'Willst du diese Berechtigungsgruppe wirklich löschen?',
	'SHOWDELETEACCESSGROUP__SUBMIT' => 'Ja, löschen.',
	'SHOWDELETEACCESSGROUP__CANCEL' => 'Nein, abbrechen.',

	// deleteAccessgroup
	'DELETEACCESSGROUP__SUCCESS' => 'Berechtigungsgruppe wurde gelöscht.',
	'DELETEACCESSGROUP__ERROR' => 'Gruppe konnte nicht gelöscht werden.',

	/* ***************** account ******************************* */

	// showAccount
	'SHOWACCOUNT__TITLE' => 'Account',
	'SHOWACCOUNT__H1' => 'Your Account',
	'SHOWACCOUNT__TOEDITACCOUNT' => 'Edit account',
	'SHOWACCOUNT__TODELETEACCOUNT' => 'Delete account',
	'SHOWACCOUNT__NAME' => 'Name',
	'SHOWACCOUNT__EMAIL' => 'E-mail',
	'SHOWACCOUNT__PASSWORD' => 'Password',
	'SHOWACCOUNT__DATEOFREGISTRATION' => 'Date of registration',
	'SHOWACCOUNT__DATEOFCHANGE' => 'Last change of data',
	'SHOWACCOUNT__INFOTEXT' => 'Your account contains mainly the data for your login. All this data will be not visible for other members by default. You can make them visible by editing their accessability.',

	// showEditAccount
	'SHOWEDITACCOUNT__TITLE' => 'Edit account',
	'SHOWEDITACCOUNT__H1' => 'Edit account',
	'SHOWEDITACCOUNT__INFOTEXT' => 'By changing values in this form you can edit your account-data.',
	'SHOWEDITACCOUNT__TOSHOWACCOUNT' => 'Back to account',
	'SHOWEDITACCOUNT__SUBMIT' => 'Save changes',
	'SHOWEDITACCOUNT__RESET' => 'Reset',

	// editAccount
	'EDITACCOUNT__INVALIDREPEAT' => 'Password has been repeated incorrectly! Please try again!',
	'EDITACCOUNT__SUCCESS' => 'Changes have successfully been saved.',
	'EDITACCOUNT__ERROR' => 'An error occured. Changes couldn\'t be saved.',
	'EDITACCOUNT__INVALIDNAME' => 'Invalid name!',
	'EDITACCOUNT__INVALIDEMAIL' => 'Invalid e-mail!',
	'EDITACCOUNT__INVALIDPASSWORD' => 'Invalid password (at least 7 characters)!',

	// formAccount
	'FORMACCOUNT__LEGEND' => 'Your Account',
	'FORMACCOUNT__NAME' => 'Username',
	'FORMACCOUNT__NAME_PRESET' => 'Your username',
	'FORMACCOUNT__NAME_HELP' => 'Enter the username you would like to have.',
	'FORMACCOUNT__EMAIL' => 'E-mail',
	'FORMACCOUNT__EMAIL_PRESET' => 'Your e-mail-address...',
	'FORMACCOUNT__EMAIL_HELP' => 'The e-mail-address for this account.',
	'FORMACCOUNT__PASSWORD' => 'New password',
	'FORMACCOUNT__PASSWORD_HELP' => 'Type in a new password for your account (at least 7 characters). Hold clear to keep your old password.',
	'FORMACCOUNT__PASSWORDREPEAT' => 'Repeat new password',
	'FORMACCOUNT__PASSWORDREPEAT_HELP' => 'Repeat the new password (only if you\'ve chosen a new one!). This reduces the risk that you mistype the password.',

	// showDeleteAccount
	'SHOWDELETEACCOUNT__TITLE' => 'Delete account',
	'SHOWDELETEACCOUNT__H1' => 'Delete account?',
	'SHOWDELETEACCOUNT__INFOTEXT' => 'Do you really want to delete your account? All data will be lost completely. There is no way to get them back!',
	'SHOWDELETEACCOUNT__LEGEND' => 'Please confirm this action with your password!',
	'SHOWDELETEACCOUNT__PASSWORD' => 'Password',
	'SHOWDELETEACCOUNT__SUBMIT' => 'Delete account',
	'SHOWDELETEACCOUNT__TOSHOWACCOUNT' => 'Back to your account',

	// deleteAccount
	'DELETEACCOUNT__ERROR' => 'An error occurred! Try again?',
	'DELETEACCOUNT__SUCCESS' => 'Your account has been successfully deleted.',
	'DELETEACCOUNT__WRONGPASSWORD' => 'Wrong password! Try again?',

	/* ***************** showUserlist ****************** */

	'SHOWUSERLIST__TITLE' => 'Userlist',
	'SHOWUSERLIST__H1' => 'Userlist',
	'SHOWUSERLIST__INFOTEXT' => 'This is a list of all users on this system.',
	'SHOWUSERLIST__ID' => 'ID',
	'SHOWUSERLIST__NAME' => 'Name',
	'SHOWUSERLIST__EMAIL' => 'E-mail',
	'SHOWUSERLIST__DATEOFREGISTRATION' => 'Registration',
	'SHOWUSERLIST__DATEOFLASTLOGIN' => 'Last login',
	'SHOWUSERLIST__ACTION' => 'Action',
	'SHOWUSERLIST__DELETEUSER' => 'Delete',

	/* **************** showDeleteUser ***************** */
	'SHOWDELETEUSER__TITLE' => 'Delete user',
	'SHOWDELETEUSER__H1' => 'Delete user #name# (#email#)',
	'SHOWDELETEUSER__INFOTEXT' => 'Are you sure, you want to delete this user? This will DESTROY the user and all its data!',
	'SHOWDELETEUSER__OK' => 'Yes, delete user',
	'SHOWDELETEUSER__CANCEL' => 'No, cancel',

	/* ***************** deleteUser ******************** */

	'DELETEUSER__ERROR' => 'User could not be deleted!',
	'DELETEUSER__SUCCESS' => 'User deleted.',

	/* ***************** navigation ******************** */

	'_SYSTEM_NAVIGATION__TOSHOWACCOUNT' => 'Your account',
	'_SYSTEM_NAVIGATION__TOSHOWCONFIG' => 'Configuration',
	'_SYSTEM_NAVIGATION__TOSHOWACCESS' => 'Access',
	'_SYSTEM_NAVIGATION__TOSHOWUSERLIST' => 'User list',
	'_SYSTEM_NAVIGATION__TODOLOGOUT' => 'Logout',
	'_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Index',
	'_HEADER_NAVIGATION__SHOWLOGIN' => 'Login',
	'_HEADER_NAVIGATION__SHOWREGISTRATION' => 'Registration'
);
?>
