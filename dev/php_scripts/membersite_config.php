<?PHP
require_once("fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('sigfxpro.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('accounts@sigfxpro.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'sigfxpro.mysql.ukraine.com.ua',
					  /*username*/'sigfxpro_db',
					  /*password*/'CVVbxLwZ',
					  /*database name*/'sigfxpro_db',
					  /*table name*/'users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('xVs1RmsCNqVX5il');

?>
