<?PHP
require_once("php_scripts/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        // $fgmembersite->RedirectToURL("reset-pwd-link-sent.html");
        echo json_encode($fgmembersite->GenerateResponceObj(true));
    } else {
        echo json_encode($fgmembersite->GenerateResponceObj(false));
    }
}

?>
