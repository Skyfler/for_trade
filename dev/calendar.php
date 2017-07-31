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
		<h2 class="title">Экономический календарь <a href="#" class="rss"></a></h2>
		<div class="calendar_container">
			<!-- Economic Calendar Widget BEGIN -->
			<script id="economicCalendarWidget" type="text/javascript" src="https://c.mql5.com/js/widgets/calendar/widget.v1.js"></script>
			<script type="text/javascript">
				new economicCalendar({ width: "100%", height: "100%", mode: 2 });
			</script>
			<!-- Economic Calendar Widget END -->
		</div>
		<div class="text_block">
			<h2 class="sub_title">Что дает экономический календарь?</h2>
			<p class="description">В Экономическом календаре вы сможете получить динамическую таблицу развития нужной валюты, привязку к главным точкам ее падения или роста (дата, когда валюта начала критически снижать/повышать себестоимость). Каленарь поможет отследить тенденцию развития нужной валютной пары, а затем делать покупки на будущее. Также вданном разделе Genius Trading есть конверторы валют, которые позволяют быстро сделать подсчеты с расширенными опциями (автоматический пересчет стоимость валют с использованием свежих данных ЦБУ).</p>
		</div>
	</section>
	<?php require('include/banner.php'); ?>
	<?php require('include/footer.php'); ?>
</body>
</html>
