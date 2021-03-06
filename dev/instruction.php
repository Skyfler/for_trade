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
<html lang="ru" class="page-instruction">
<head>
	<?php require('include/head.php'); ?>
	<title>Инструкция</title>
</head>
<body>
	<?php
		$activeMenu = 'instruction';
		require('include/header.php');
	?>
	<section class="instruction container">
		<div class="instruction_block">
			<div class="title">Работа с приложением - БЛОК “ИНСТРУКЦИЯ”</div>
			<div class="instruction_item">
				<div class="sub_title">СИГНАЛЫ</div>
				<div class="text">
					<p>В главном разделе вы найдете торговые сигналы в реальном времени (на базе индикаторов RSI, Stochastic, EMA) на различных инструментах и тайм-фреймах. BUY, STRONG BUY, SELL, STRONG SELL –варианты наиболее сильных сигналов для входа в сделки, а также сигнал NEUTRAL, при котором вход в сделку нежелателен.В главном разделе вы найдете торговые сигналы в реальном времени (на базе индикаторов RSI, Stochastic, EMA) на различных инструментах и тайм-фреймах. BUY, STRONG BUY, SELL, STRONG SELL –варианты наиболее сильных сигналов для входа в сделки, а также сигнал NEUTRAL, при котором вход в сделку нежелателен.<img src="img/instr_1.png" alt="" class="responsive_img"></p>
					<p>Система идеально подходит как для неопытных участников рынка, так и для опытных трейдеров и людей, не имеющих свободного времени для изучения аналитики.</p>
				</div>
			</div>
			<div class="instruction_item">
				<div class="sub_title">ТЕХАНАЛИЗ</div>
				<div class="text">
					<p>В разделе Теханализ (премиум-пакет) вы найдете графики в реальном времени. В наличии широкий выбор инструментов для самостоятельного теханализа, а также ежедневная аналитика, доступная при активации премиум-пакета. Полученные после активации логин и пароль дают вход в личный кабинет, открывая доступ к VIP-сигналам в виде детального теханализа, обновляемого ежедневно.<img src="img/instr_2.png" alt="" class="responsive_img"></p>
					<p>В вертикальной ленте справа постоянно обновляются горячие новости, бонусные акции наших брокеров-партнеров и другая актуальная информация.</p>
					<p><b>Но это еще не все!</b></p>
					<p>Кликнув на любой из VIP- сигналов, вы сразу же увидите его на графике с полным объяснением данной сделки (включая фундаментальный и технический анализ) и направлением входа!</p>
					<p>Sigfxpro.com, сочитая в себе:</p>
					<ul>
						<li>сигналы в режиме реального времени</li>
						<li>графики для полноценного теханализа</li>
						<li>аналитику трейдеров</li>
						<li>живую ленту с новостями и бонусными акциями</li>
					</ul>
					<p>сэкономит вам массу времени и значительно повысит успешность вашей торговли. Скачайте Sigfxpro.com бесплатно и получите полный пакет услуг на одном устройстве!</p>
				</div>
			</div>
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
