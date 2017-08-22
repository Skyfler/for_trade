<?php
require_once("php_scripts/membersite_config.php");

if($fgmembersite->ResetPassword())
{
    $success = true;
} else {
    $success = false;
}

if(!$fgmembersite->CheckLogin())
{
	  $value = 'false';
} else {
	  $value = 'true';
}

setcookie("DoNotShowRegistrationPopup", $value);
?>

<!doctype html>
<html lang="ru" class="page-password_reset">
<head>
	<?php require('include/head.php'); ?>
	<title>Сброс пароля</title>
</head>
<body>
	<?php
		$activeMenu = '';
		require('include/header.php');
	?>
	<section class="password_reset">
		<div class="text_block container">
		    <?php if ($success) { ?>
			    <p class="title">Пароль успешно сброшен</p>
			    <p>Ваш новый пароль выслан вам на почту.</p>
			<?php } else { ?>
			    <p class="title">Ошибка</p>
			    <?php for ($i = 0, $errors = $fgmembersite->GetErrorMessageArr(), $length = count($errors); $i < $length; $i++) { ?>
			        <p><?= $errors[$i]->error; ?></p>
			    <?php } ?>
			<?php } ?>
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
