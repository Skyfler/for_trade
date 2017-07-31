<!doctype html>
<html lang="ru" class="page-index">
<head>
	<?php require('include/head.php'); ?>
	<title>SIXPRO</title>
</head>
<body>
	<?php
		$activeMenu = 'index';
		require('include/header.php');
	?>
	<?php require('include/banner.php'); ?>
	<section class="graphs container flex">
		<div class="text_block">
			<h2 class="title">Сигналы для форекса - зачем они нужны?</h2>
			<p class="description">Наши рекомендации будут полезны для людей, у которых нет времени на анализ рынка или трейдерам, которые еще не вышли на стабильный заработок. Продуманный стратегическмй подход является залогом положительных результатов торговли на Форекс. Наш сервис создан в качестве оптимального помощника как начинающим, так и профессиональным трейдерам.</p>
		</div>
		<div class="block">
			<div class="block_inner">
				<iframe id="market_trends_widget" src="https://trading4pro.com/market-trends/?symbols=EURUSD,USDJPY,GBPUSD,XAUUSD,AUDUSD" frameborder="0" height="552" width="306"></iframe>
			</div>
		</div>
		<div class="block">
			<div class="block_inner">
				<?php require('include/chartWidget.php'); ?>
			</div>
		</div>
	</section>
	<section class="banner2 container">
		<a href="#">
			<img src="img/RU_Trade-Online_picture_970x250.gif" alt="" class="responsive_img">
		</a>
	</section>
	<section class="info_blocks_container">
		<div class="info_blocks_container_inner flex">
			<div class="info_block recomendations flex">
				<div class="info_block_inner">
					<div class="title">Прямые торговые рекомендации</div>
					<div class="description">Данные торговые рекомендации  подсказывают трейдеру важную информацию: по какому активу и с каких уровней стоит совершать операцию.</div>
				</div>
			</div>
			<div class="info_block risks flex">
				<div class="info_block_inner">
					<div class="title">Минимизация рисков</div>
					<div class="description">Главная цель трейдера - минимизировать риски. Компания Signals-fx&trade; делает все для того, чтобы ее трейдеры получали доход от совершаемых сделок.</div>
				</div>
			</div>
			<div class="info_block analysis flex">
				<div class="info_block_inner">
					<div class="title">Фундаментальный анализ рынка</div>
					<div class="description">Аналитика рынка форекс от нашего ресурса подскажет вам на какие экономические события стоит обратить внимание.</div>
				</div>
			</div>
			<div class="info_block trade flex">
				<div class="info_block_inner">
					<div class="title">Торговля для новичков на форекс</div>
					<div class="description">Вы можете воспользоваться бесплатным обучением, участвовать в вебинарах от специалистов рынка и финансовых аналитиков.</div>
				</div>
			</div>
		</div>
	</section>
	<?php require('include/footer.php'); ?>
</body>
</html>
