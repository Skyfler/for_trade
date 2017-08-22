<?PHP
require_once("php_scripts/membersite_config.php");

$fgmembersite->LogOut();
echo json_encode($fgmembersite->GenerateResponceObj(true));
?>
