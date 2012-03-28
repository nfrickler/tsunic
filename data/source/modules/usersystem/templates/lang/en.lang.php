<!-- | -->
<?php

$lang = array(

	// userheader
	'USERHEADER__LOGGEDINAS' => 'You are logged in as #name#.',
	'USERHEADER__LOGOUT' => 'Logout',
	'USERHEADER__NOTLOGGEDIN' => 'Please log in!',

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

	// formRegistration
	'FORMREGISTRATION__LEGEND' => 'Create a new account',
	'FORMREGISTRATION__NAME' => 'Name',
	'FORMREGISTRATION__NAME_PRESET' => 'Choose a username...',
	'FORMREGISTRATION__NAME_HELP' => 'Your name on this platform.',
	'FORMREGISTRATION__EMAIL' => 'E-Mail',
	'FORMREGISTRATION__EMAIL_PRESET' => 'Type in your e-mail-address...',
	'FORMREGISTRATION__EMAIL_HELP' => 'Your e-mail-address. This e-mail-address will be unvisible for all other members by default.',
	'FORMREGISTRATION__PASSWORD' => 'Password',
	'FORMREGISTRATION__PASSWORD_HELP' => 'Type in a password for your account (at least 7 characters).',
	'FORMREGISTRATION__PASSWORDREPEAT' => 'Repeat password',
	'FORMREGISTRATION__PASSWORDREPEAT_HELP' => 'Repeat the password. This reduces the risk that you mistype the password.',
	'FORMREGISTRATION__SUBMIT' => 'Create new account',

	// do register
	'DOREGISTER__INVALIDREPEAT' => 'Password has been repeated incorrectly - please try again!',
	'DOREGISTER__SUCCESS' => 'You have successfully registered. You can log in now...',
	'DOREGISTER__ERROR' => 'Your registration has failed. Please try again!',
	'DOREGISTER__INVALIDEMAIL' => 'Invalid e-mail-address! Maybe you have already registered with this e-mail-address?',
	'DOREGISTER__INVALIDPASSWORD' => 'Invalid password! Password must have at least 7 characters.',
	'DOREGISTER__INVALIDNAME' => 'Invalid username! Maybe this name is already used by someone else...',

	/* ***************** profile ******************************* */

	// showProfile
	'SHOWPROFILE__TITLE' => 'Profile',
	'SHOWPROFILE__H1' => 'Your profile',
	'SHOWACCOUNT__TOEDITPROFILE' => 'Edit profile',
	'SHOWPROFILE__INFOTEXT' => 'This is your profile. All information of your profile will be visible for all users.',
	'SHOWPROFILE__NAME' => 'Username',

	/* ***************** account ******************************* */

	// showAccount
	'SHOWACCOUNT__TITLE' => 'Account',
	'SHOWACCOUNT__H1' => 'Your Account',
	'SHOWACCOUNT__TOEDITACCOUNT' => 'Edit account',
	'SHOWACCOUNT__TODELETEACCOUNT' => 'Delete account',
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

	// editAccount
	'EDITACCOUNT__INVALIDREPEAT' => 'Password has been repeated incorrectly! Please try again!',
	'EDITACCOUNT__SUCCESS' => 'Changes have successfully been saved.',
	'EDITACCOUNT__ERROR' => 'An error occured. Changes couldn\'t be saved.',
	'EDITACCOUNT__INVALIDEMAIL' => 'Invalid e-mail!',
	'EDITACCOUNT__INVALIDPASSWORD' => 'Invalid password (at least 7 characters)!',

	// formAccount
	'FORMACCOUNT__LEGEND' => 'Your Account',
	'FORMACCOUNT__EMAIL' => 'E-mail',
	'FORMACCOUNT__EMAIL_PRESET' => 'Your e-mail-address...',
	'FORMACCOUNT__EMAIL_HELP' => 'The e-mail-address for this account.',
	'FORMACCOUNT__PASSWORD' => 'New password',
	'FORMACCOUNT__PASSWORD_HELP' => 'Type in a new password for your account (at least 7 characters). Hold clear to keep your old password.',
	'FORMACCOUNT__PASSWORDREPEAT' => 'Repeat new password',
	'FORMACCOUNT__PASSWORDREPEAT_HELP' => 'Repeat the new password (only if you\'ve chosen a new one!). This reduces the risk that you mistype the password.',
	'FORMACCOUNT__SUBMIT' => 'Save changes',
	'FORMACCOUNT__RESET' => 'Reset',

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

	/* ***************** _system_navigation ******************** */

	'_SYSTEM_NAVIGATION__TOSHOWACCOUNT' => 'Your account',
	'_SYSTEM_NAVIGATION__TOSHOWPROFILE' => 'Your profile',
	'_SYSTEM_NAVIGATION__TODOLOGOUT' => 'Logout',
	'_SYSTEM_NAVIGATION__TOSHOWINDEX' => 'Index',
	'_HEADER_NAVIGATION__SHOWLOGIN' => 'Login',
	'_HEADER_NAVIGATION__SHOWREGISTRATION' => 'Registration'
);
?>
