<?PHP
require_once("php_scripts/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        // $fgmembersite->RedirectToURL("login-home.php");
        echo json_encode($fgmembersite->GenerateResponceObj(true));
    } else {
        echo json_encode($fgmembersite->GenerateResponceObj(false));
    }
}

?>
