<?php
require_once("php_scripts/membersite_config.php");

if(isset($_POST['submitted']))
{
    if($fgmembersite->RegisterUser())
    {
        // $fgmembersite->RedirectToURL("thank-you.html");
        echo json_encode($fgmembersite->GenerateResponceObj(true));
    } else {
        echo json_encode($fgmembersite->GenerateResponceObj(false));
    }

    exit;
}

// echo 'not submitted!';

// exit;

?>
