<!-- | language file english -->
<?php
$lang = array(

	// errors
	'ERROR__PLEASELOGIN' => 'Please log in!',
	'ERROR__UNKNOWNERROR' => 'An error occurred!',
	'ERROR__LOGINERROR' => 'An error occurred while logging in!',
	'ERROR__INITDATABASE' => 'An error occurred while initializing your database!',
	'ERROR__CLASSMODULE__PREPARSE' => 'PreParsing failed!',
	'ERROR__CLASSSTYLE__PREPARSE' => 'PreParsing failed!',

	// info
	'INFO__SAVED' => 'Saved successfully.',
	'INFO__INITDATABASE' => 'Database has been initialized successfully.',
	'INFO__SETPASSWORD' => 'Please choose a password for the software-backend first!',

	// class
	'MODULE__CLASS__STATUS_ERROR' => 'Error',
	'MODULE__CLASS__STATUS_UNINSTALLED' => 'Uninstalled',
	'MODULE__CLASS__STATUS_UPDATEWAITING' => 'Update is waiting...',
	'MODULE__CLASS__STATUS_INSTALLED' => 'Installed',
	'MODULE__CLASS__STATUS_AVAILABLE' => 'Available',
	'MODULE__CLASS__STATUS_PREPARSINGERROR' => 'PreParser-Error',
	'MODULE__CLASS__STATUS_PARSED' => 'Used',
	'STYLE__CLASS__STATUS_ERROR' => 'Error',
	'STYLE__CLASS__STATUS_AVAILABLE' => 'Available',
	'STYLE__CLASS__STATUS_PREPARSINGERROR' => 'PreParser-Error',
	'STYLE__CLASS__STATUS_PARSED' => 'Used',
	'STYLE__CLASS__STATUS_DEFAULT' => 'Default',

	// showLogin
	'SHOWLOGIN__TITLE' => 'Login',
	'SHOWLOGIN__H1' => 'TS_Admin | Login',
	'SHOWLOGIN__INFOTEXT' => 'Please enter the backend-password to enter the administration backend!',
	'SHOWLOGIN__LEGEND' => 'Please enter password...',
	'SHOWLOGIN__PASSWORD' => 'Backend password',
	'SHOWLOGIN__SUBMIT' => 'Log in',

	// setLogin
	'SHOWSETLOGIN__TITLE' => 'Set password',
	'SHOWSETLOGIN__H1' => 'TS_Admin | Set password',
	'SHOWSETLOGIN__INFOTEXT' => 'Please set a new password for the administration backend. This password can be changed within the backend as often as you like.',
	'SHOWSETLOGIN__LEGEND' => 'Please enter a new password',
	'SHOWSETLOGIN__PASSWORD' => 'Backend password',
	'SHOWSETLOGIN__SUBMIT' => 'Save password',

	// showIndex
	'SHOWINDEX__TITLE' => 'Index',
	'SHOWINDEX__H1' => 'TS_Admin | Index',
	'SHOWINDEX__INFOTEXT' => 'You are in the administration-backend of TSunic. This backend enables you to administrate TSunic easily.',
	'SHOWINDEX__H2_INDEX' => 'This backend enables you to...',
	'SHOWINDEX__DT_MODULES' => 'Administrate modules',
	'SHOWINDEX__DD_MODULES' => 'Manage all modules of TSunic and parse the software.',
	'SHOWINDEX__DT_CONFIG' => 'Change configuration',
	'SHOWINDEX__DD_CONFIG' => 'Change basic configuration of TSunic.',
	'SHOWINDEX__DT_TOOLS' => 'Optimize the software',
	'SHOWINDEX__DD_TOOLS' => 'Use usefull tools to optimize your installation',
	'SHOWINDEX__DT_SETLOGIN' => 'Change password',
	'SHOWINDEX__DD_SETLOGIN' => 'Change password for administration backend.',
	'SHOWINDEX__DT_SYSTEMCHECK' => 'Check system',
	'SHOWINDEX__DD_SYSTEMCHECK' => 'Check environment of the system.',

	// showModules
	'SHOWMODULES__TITLE' => 'Modules',
	'SHOWMODULES__H1' => 'TS_Admin | Administrate modules',
	'SHOWMODULES__INFOTEXT' => 'Here you can install/update/uninstall/remove modules. Moreover you can build the runtime-environment of TSunic.',
	'SHOWMODULES__MODNAME' => 'Name of module',
	'SHOWMODULES__VERSION' => 'Version',
	'SHOWMODULES__MODDESCRIPTION' => 'Description',
	'SHOWMODULES__STATUS' => 'Status',
	'SHOWMODULES__AUTHOR' => 'Author',
	'SHOWMODULES__RENDER' => '(Re)Build TSunic',
	'SHOWMODULES__SUBMIT' => 'Save changes',
	'SHOWMODULES__RESET' => 'Reset',
	'SHOWMODULES__ID' => 'ID',
	'SHOWMODULES__ACTION' => 'Action',
	'SHOWMODULES__ACTION_DELETE' => 'Delete',
	'SHOWMODULES__ACTION_UNINSTALL' => 'Uninstall',
	'SHOWMODULES__ACTION_INSTALL' => 'Install',
	'SHOWMODULES__ACTION_UPDATE' => 'Update',

	// installModule
	'ERROR__INSTALLMODULE' => 'An error occurred!',
	'INFO__INSTALLMODULE' => 'Module installed.',

	// updateModule
	'ERROR__UPDATEMODULE' => 'An error occurred!',
	'INFO__UPDATEMODULE' => 'Module updated.',

	// uninstallModule
	'ERROR__UNINSTALLMODULE' => 'An error occurred!',
	'INFO__UNINSTALLMODULE' => 'Module uninstalled.',

	// deleteModule
	'ERROR__DELETEMODULE' => 'An error occurred!',
	'INFO__DELETEMODULE' => 'Module removed.',

	// setModules
	'INFO__SETMODULES_SUCCESS' => 'Changes saved.',

	// render
	'INFO__RENDER_SUCCESS' => 'Parsing finished successfully.',
	'ERROR__RENDER' => 'An error occurred while parsing the software!',

	// showStyles
	'SHOWSTYLES__TITLE' => 'Styles',
	'SHOWSTYLES__H1' => 'TS_Admin | Administrate styles',
	'SHOWSTYLES__INFOTEXT' => 'All styles on one page. Here you can administrate all styles in your style-directory.',
	'SHOWSTYLES__MODNAME' => 'Name of style',
	'SHOWSTYLES__VERSION' => 'Version',
	'SHOWSTYLES__MODDESCRIPTION' => 'Description',
	'SHOWSTYLES__STATUS' => 'Status',
	'SHOWSTYLES__AUTHOR' => 'Author',
	'SHOWSTYLES__SUBMIT' => 'Save changes',
	'SHOWSTYLES__RESET' => 'Reset',
	'SHOWSTYLES__ID' => 'ID',
	'SHOWSTYLES__ACTION' => 'Action',
	'SHOWSTYLES__ACTION_DELETE' => 'Delete',
	'SHOWSTYLES__ACTION_SETDEFAULT' => 'As default',

	// setStyles
	'INFO__SETSTYLES_SUCCESS' => 'Changes saved.',

	// setDefaultStyle
	'ERROR__SETDEFAULTSTYLE' => 'Saving the default caused an error.',
	'INFO__SETDEFAULTSTYLE' => 'Default has been saved.',

	// deleteStyle
	'ERROR__DELETESTYLE' => 'An error occurred!',
	'INFO__DELETESTYLE' => 'Style removed.',

	// showTools
	'SHOWTOOLS__TITLE' => 'Optimize',
	'SHOWTOOLS__H1' => 'TS_Admin | Optimize',
	'SHOWTOOLS__INFOTEXT' => 'This tools can help you to optimize your TSunic installation.',
	'SHOWTOOLS__DT_INITDATABASE' => 'Initialize database',
	'SHOWTOOLS__DD_INITDATABASE' => 'Before using TSunic some tables needs to be created in you database. Normally they should be created automatically, but this tool gives you more information about it.',
	'SHOWTOOLS__DT_RESETALL' => 'Reset TSunic',
	'SHOWTOOLS__DD_RESETALL' => 'This tool enables you to reset TSunic completely. All data of your current installation will be lost afterwards!',

	// showInitDatabase
	'SHOWINITDATABASE__TITLE' => 'Initialize database',
	'SHOWINITDATABASE__H1' => 'TS_Admin | Initialize database',
	'SHOWINITDATABASE__INFOTEXT' => 'To manage the modules and styles TSunic needs some tables in your database. Accessing this page, TSunic will try to create them.',
	'SHOWINITDATABASE__DONE' => 'The required tables are available.',
	'SHOWINITDATABASE__ERROR' => 'Tables aren\'t existing!',
	'SHOWINITDATABASE__ERROR_LINK' => 'Retry initialization',

	// showResetAll
	'SHOWRESETALL__TITLE' => 'Reset all',
	'SHOWRESETALL__H1' => 'TS_Admin | Reset all',
	'SHOWRESETALL__INFOTEXT' => 'This tool enables you to reset TSunic conpletely. All data of your current installation will be lost and can not be recovered!',
	'SHOWRESETALL__WARNING' => 'With clicking on "SHOWRESETALL__RESETALL" all data will be destroyed!!!',
	'SHOWRESETALL__RESETALL' => 'Reset TSunic now',

	// resetAll
	'INFO__ALLRESET_SUCCESS' => 'TSunic has been resetted successfully.',

	// showConfig
	'SHOWCONFIG__TITLE' => 'Edit configuration',
	'SHOWCONFIG__H1' => 'TS_Admin | Edit configuration',
	'SHOWCONFIG__INFOTEXT' => 'Change the configuration of TSunic easily via this formular.',
	'SHOWCONFIG__LEGEND_DATABASE' => 'Database',
	'SHOWCONFIG__DB_CLASS' => 'Database type',
	'SHOWCONFIG__DB_CLASS_INFO' => 'Choose a database-type for TSunic.',
	'SHOWCONFIG__DB_HOST' => 'Host',
	'SHOWCONFIG__DB_HOST_INFO' => 'Host of your database.',
	'SHOWCONFIG__DB_USER' => 'User',
	'SHOWCONFIG__DB_USER_INFO' => 'User of your database.',
	'SHOWCONFIG__DB_PASS' => 'Password',
	'SHOWCONFIG__DB_PASS_INFO' => 'Password of your database.',
	'SHOWCONFIG__DB_DATABASE' => 'Database',
	'SHOWCONFIG__DB_DATABASE_INFO' => 'Name of database to be used by TSunic.',
	'SHOWCONFIG__PREFFIX' => 'Preffix',
	'SHOWCONFIG__PREFFIX_INFO' => 'This preffix will be attached to all tables in your database used by TSunic. Do not change this setting on a running system!',
	'SHOWCONFIG__LEGEND_ENCRYPTION' => 'Encryption',
	'SHOWCONFIG__ENCRYPTION_CLASS' => 'Encryption type',
	'SHOWCONFIG__ENCRYPTION_CLASS_INFO' => 'Choose an encryption type. Do not change this password on a running system, causing serious damage to your data.',
	'SHOWCONFIG__ENCRYPTION_ALGORITHM' => 'Algorithm',
	'SHOWCONFIG__ENCRYPTION_ALGORITHM_INFO' => 'Choose an encryption algorithm. Do not change this password on a running system, causing serious damage to your data.',
	'SHOWCONFIG__ENCRYPTION_MODE' => 'Mode',
	'SHOWCONFIG__ENCRYPTION_MODE_INFO' => 'Choose an encryption mode. Do not change this password on a running system, causing serious damage to your data.',
	'SHOWCONFIG__SYSTEM_SECRET' => 'System secret',
	'SHOWCONFIG__SYSTEM_SECRET_INFO' => 'This is a secret password probably unique to every system that is used for encryption. Do not change this password on a running system, causing serious damage to your data.',
	'SHOWCONFIG__LEGEND_OTHERS' => 'Other settings',
	'SHOWCONFIG__DEFAULT_LANGUAGE' => 'Default language',
	'SHOWCONFIG__DEFAULT_LANGUAGE_INFO' => 'Choose a default language.',
	'SHOWCONFIG__SYSTEM_EMAIL' => 'System e-mail',
	'SHOWCONFIG__SYSTEM_EMAIL_INFO' => 'This is the sender attached to e-mails sent by php\'s mail-function.',
	'SHOWCONFIG__SUBMIT' => 'Save configuration',
	'SHOWCONFIG__RESET' => 'Reset',
	'SHOWCONFIG__DEBUG_MODE' => 'Debug mode',
	'SHOWCONFIG__DEBUG_MODE_INFO' => '"Yes" means that the parser will not compress files, what simplifies debugging.',
	'SHOWCONFIG__NO' => 'No',
	'SHOWCONFIG__YES' => 'Yes',
	'SHOWCONFIG__EMAIL_ENABLED' => 'E-mail activated?',
	'SHOWCONFIG__EMAIL_ENABLED_INFO' => 'With this setting disabled TSunic will not send e-mails via php\'s mail-function.',

	'SHOWCONFIG__LEGEND_PATHS' => 'Directories',
	'SHOWCONFIG__DIR_ADMIN' => 'admin directory',
	'SHOWCONFIG__DIR_ADMIN_INFO' => 'Absolute path to admin directory of TSunic. Only administrator needs web access to this directory.',
	'SHOWCONFIG__DIR_DATA' => 'data directory',
	'SHOWCONFIG__DIR_DATA_INFO' => 'Absolute path to data directory of TSunic. Only webserver needs access to this directory.',
	'SHOWCONFIG__DIR_RUNTIME' => 'runtime directory',
	'SHOWCONFIG__DIR_RUNTIME_INFO' => 'Absolute path to runtime directory of TSunic. This is the public directory.',

	'SHOWCONFIG__SYSTEM_ONLINE' => 'System online?',
	'SHOWCONFIG__SYSTEM_ONLINE_INFO' => 'Switch to "No", if you want to take the system offline. This configuration is also used during parsing the software.',
	'SHOWCONFIG__ALLOW_REGISTRATION' => 'Allow registration?',
	'SHOWCONFIG__ALLOW_REGISTRATION_INFO' => 'Deactivate this option to disallow new users to register. Already registered users can still login normally.',

	// showSystemCheck
	'SHOWSYSTEMCHECK__TITLE' => 'Check system',
	'SHOWSYSTEMCHECK__H1' => 'TS_Admin | Check system',
	'SHOWSYSTEMCHECK__INFOTEXT' => 'Is TSunic likely to run on this system properly? Check it now!',
	'SHOWSYSTEMCHECK__FOLDER_RUNTIME' => 'Write access for folder "runtime"?',
	'SHOWSYSTEMCHECK__FOLDER_RUNTIME_INFO' => 'This folder contains the runtime-environment and will be created by parsing the software in the backend. TSunic needs to have write access to this folder so please set file options in your ftp-browser to 755!',
	'SHOWSYSTEMCHECK__PHPVERSION' => 'PHP version',
	'SHOWSYSTEMCHECK__PHPVERSION_INFO' => 'To work properly, TSunic needs at least PHP version 5.3.',
	'SHOWSYSTEMCHECK__IMAPFUNCTIONS' => 'IMAP-Functions available?',
	'SHOWSYSTEMCHECK__IMAPFUNCTIONS_INFO' => 'TSunic can enable you to access your mails via IMAP or POP3. Therefore, the IMAP-Functions have to be installed on the server. Nevertheless, TSunic will work properly also without these functions.',
	'SHOWSYSTEMCHECK__FOLDER_DATA' => 'Write access for folder "data"?',
	'SHOWSYSTEMCHECK__FOLDER_DATA_INFO' => 'This folder contains all data, which do not require web-access. TSunic needs write access to this folder so please set file options in your ftp-browser to 755!',

	// pagenotfound
	'PAGENOTFOUND__TITLE' => 'Page not found',
	'PAGENOTFOUND__H1' => 'Page not found!',
	'PAGENOTFOUND__INFOTEXT' => 'The requested page has not been found!',

	// html
	'HTML__INSTALLATIONPROGRESS' => 'Installation progress',
	'HTML__INDEX' => 'Index',
	'HTML__MODULES' => 'Modules',
	'HTML__CONFIG' => 'Configuration',
	'HTML__STYLES' => 'Styles',
	'HTML__TOOL' => 'Tools',
	'HTML__LOGOUT' => 'Logout',
	'HTML__LOGIN' => 'Login',
	'HTML__INSTALLATION_NEXT' => 'Resume installation'
);
?>
