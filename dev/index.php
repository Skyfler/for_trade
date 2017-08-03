<!doctype html>
<html lang="ru" class="page-index">
<head>
	<?php require('include/head.php'); ?>
	<title>SIGFXPRO</title>
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
		<div class="slider" id="main_slider">
			<div class="overflow_hidden_container">
				<div class="overflow_block clr flex flex-center-v">
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup="open">
							<img src="img/RU_Trade-Online_picture_970x250%20frame_0.png" alt="" class="responsive_img">
						</a>
					</div>
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup="open">
							<img src="img/RU_Trade-Online_picture_970x250%20frame_1.png" alt="" class="responsive_img">
						</a>
					</div>
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup="open">
							<img src="img/RU_Trade-Online_picture_970x250%20frame_2.png" alt="" class="responsive_img">
						</a>
					</div>
				</div>
			</div>
	   </div>
	</section>
	<section class="info_blocks_container">
		<div class="info_blocks_container_inner flex">
			<div class="info_block recomendations flex">
				<div class="info_block_inner">
					<div class="icon"><i class="fa fa-line-chart" aria-hidden="true"></i></div>
					<div class="title">Торговые сигналы в реальном времени</div>
					<div class="description">Базируются на техническом анализе и предоставляют трейдеру рекомендации для входа в рынок по тому или иному активу. Идеально подходит, как новичкам, так и трейдерам с опытом.</div>
				</div>
			</div>
			<div class="info_block risks flex">
				<div class="info_block_inner">
					<div class="icon"><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
					<div class="title">Теханализ</div>
					<div class="description">Живые графики, а так же широкий выбор  инструментов и индикаторов  для проведения анализа выбранного актива.</div>
				</div>
			</div>
			<div class="info_block analysis flex">
				<div class="info_block_inner">
					<div class="icon"><i class="fa fa-star" aria-hidden="true"></i></div>
					<div class="title">Теханализ (Премиум пакет)</div>
					<div class="description">V.I.P услуга для трейдеров, желающих получать детальную информацию о каждой сделке. Обновляется ежедневно профессиональными трейдерами.</div>
				</div>
			</div>
			<div class="info_block trade flex">
				<div class="info_block_inner">
					<div class="icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
					<div class="title">Экономический календарь</div>
					<div class="description">Показывает время выхода важных новостей и экономических показателей, а так же их силу  влияния на рынок. Необходимый инструмент для каждого трейдера.</div>
				</div>
			</div>
		</div>
	</section>
	<?php require('include/form_popup.php'); ?>
	<?php require('include/footer.php'); ?>
</body>
</html>
