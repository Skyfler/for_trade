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
<html lang="ru" class="page-analytics">
<head>
	<?php require('include/head.php'); ?>
	<title>Аналитика</title>
</head>
<body>
	<?php
		$activeMenu = 'analytics';
		require('include/header.php');
	?>
	<section class="analytics container">
		<h2 class="title">Графики форекс в реальном времени</h2>
		<?php require('include/chartWidget.php'); ?>
		<div class="text_block">
			<p>Живой график форекс – это графическое отображение активов, помоающее трейдеру оценивать ситуацию на рынках при торговле.</p>
			<p>Актив - это любой инструмент, участвующий в торговле. Валютные пары, сырье, драгоценные металы, акции компаний или фондовые индексы.
			<br>Для отображения цены актива используется три вида графиков: линейны, японские свечи и бары.</p>
			<p>Таймфрейм показывает изменение актива за определенный промежуток вермени, от одной минуты до конца месяца.
			<br>Кроме этого вы можете подключить к графику индикаторы и графические модели, использующиеся в составе торговых стратегий, которые дают торговые сигналы.</p>
		</div>
	</section>
	<?php
	if (!$fgmembersite->CheckLogin()) {
		require('include/banner.php');
		require('include/registrationForm_popup.php');
		require('include/autoRegistration_popup.php');
	}
	?>
	<?php require('include/footer.php'); ?>
</body>
</html>
