<!doctype html>
<html lang="ru" class="page-calendar">
<head>
	<?php require('include/head.php'); ?>
	<title>Экономический календарь</title>
</head>
<body>
	<?php
		$activeMenu = 'calendar';
		require('include/header.php');
	?>
	<section class="calendar container">
		<h2 class="title">Экономический календарь <!--<a href="#" class="rss"></a>--></h2>
		<div class="calendar_container">
			<!-- Economic Calendar Widget BEGIN -->
			<script id="economicCalendarWidget" type="text/javascript" src="https://c.mql5.com/js/widgets/calendar/widget.v1.js"></script>
			<script type="text/javascript">
				new economicCalendar({ width: "100%", height: "100%", mode: 2 });
			</script>
			<!-- Economic Calendar Widget END -->
		</div>
		<div class="info_block">
			<span class="icon_sqare red"></span> красный цвет означает сильное колебание рынка в следствие выхода данной новости<br>
			<span class="icon_sqare orange"></span> желтый цвет говорит о том,что  вляние новости на рынок ожидается  умеренным<br>
			<span class="icon_sqare grey"></span> серый цвет является показателем того, что новость, практически не влияет на цены активов
		</div>
		<div class="text_block">
			<h2 class="sub_title">Что дает экономический календарь?</h2>
			<p class="description">Цель календаря помочь трейдеру в построении прогнозов и принятии торговых решений. Любой финансовый актив реагирует на выходящую экономическую новость. Реакция цены и волатильность инструмента зависят в той или иной степени от значимости данной новости.<br><br>
			Календарь- своего рода хронологическй сборник экономических событий. В нем по датам и времени собраны актуальные новости, отчеты банков, изменения экономических показателей и т.д. По календарю с легкостью можно понять силу влияния новости на актив, показатели данной новости в прошлом, прогнозы на будущее,а также фактический результат. Зная дату выхода публикации и видя результаты прошлых и текущих показателей, трейдеры сравнивают эти данные с будущими прогнозами и строят свою личную стратегию для входа в рынок.<br><br>
			Для того, чтобы понять насколько важна новость и как сильно она може повлиять на цены активов существуют определенные метки,которые служат индикаторами.</p>
		</div>
	</section>
	<?php require('include/banner.php'); ?>
	<?php require('include/form_popup.php'); ?>
	<?php require('include/footer.php'); ?>
</body>
</html>
