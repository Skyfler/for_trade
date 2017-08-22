<?php
require_once("php_scripts/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
	  $value = 'false';
} else {
	  $value = 'true';
}

setcookie("DoNotShowRegistrationPopup", $value);
?>

<!doctype html>
<html lang="ru" class="page-reset_link_sent">
<head>
	<?php require('include/head.php'); ?>
	<title>Ссылка для сброса пароля отправлена</title>
</head>
<body>
	<?php
		$activeMenu = '';
		require('include/header.php');
	?>
	<section class="reset_link_sent">
		<div class="text_block container">
			<p class="title">Ссылка для сброса пароля отправлена.</p>
			<p>На Вашу почту выслано сообщение с сылкой для сброса пароля.</p>
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
