<?php
require_once("php_scripts/membersite_config.php");

if(isset($_GET['code']))
{
    if($fgmembersite->ConfirmUser())
    {
        $fgmembersite->RedirectToURL('//' . $fgmembersite->sitename);
        // echo json_encode($fgmembersite->GenerateResponceObj(true));
    } else {
        // echo json_encode($fgmembersite->GenerateResponceObj(false));
    }
}

?>

<!doctype html>
<html lang="ru" class="page-registration_confirmation">
<head>
	<?php require('include/head.php'); ?>
	<title>Подтверждение регистрации</title>
</head>
<body>
	<?php
		$activeMenu = '';
		require('include/header.php');
	?>
	<section class="registration_confirmation">
		<div class="text_block container flex flex-center-x">
		    <form action="<?php echo $fgmembersite->GetSelfScript(); ?>" class="contact_form" method="get">
            	<div class="form_inner_container clr flex">
            		<div class="block_main_title">Введите код подтверждения</div>
            		<div class="input_group">
            			<input type="text" placeholder="Код подтверждения" name="code" required class="required" id="code" maxlength="50" data-component="form-input">
            		</div>
            		<div class="input_group input_submit">
            			<button type="submit" class="submit"><span>Подтвердить</span></button>
            		</div>
            	</div>
            </form>
		</div>
	</section>
	<?php
	if (!$fgmembersite->CheckLogin()) {
		require('include/registrationForm_popup.php');
		require('include/autoRegistration_popup.php');
	}
	?>
	<?php require('include/footer.php'); ?>
</body>
</html>
