<?php session_start(); ?>
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
	<div class="currencies">
		<iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:150px;margin-top:-42px;margin-bottom:-58px;" scrolling="no" src="https://fortrader.org/informers/getInformer?st=31&cat=9&title=undefined&mult=0.96&showGetBtn=0&w=0&disableRealTime=1&colors=titleTextColor%3D1155cc%2CtitleBackgroundColor%3Dffffff%2CsymbolTextColor%3D167ac6%2CtableTextColor%3D454545%2CprofitTextColor%3D89bb50%2CprofitBackgroundColor%3Deaf7e1%2ClossTextColor%3Dff1616%2ClossBackgroundColor%3Df6e1e1%2CborderTdColor%3D167ac6%2CtableBorderColor%3D167ac6%2CtrBackgroundColor%3Df6f6f6%2CinformerLinkTextColor%3D5e5e5e%2CinformerLinkBackgroundColor%3Df6f6f6&items=54%2C99%2C115%2C63%2C107%2C25456%2C74%2C72%2C105%2C55%2C108%2C77%2C92&columns="></iframe>
	</div>
	<section class="graphs flex">
		<div class="text_block">
			<div class="container">
				<h2 class="title">Сигналы форекс - зачем они нужны?</h2>
				<p class="description">Наши рекомендации будут полезны для людей, у которых нет времени на анализ рынка или трейдерам, которые еще не вышли на стабильный заработок. Продуманный стратегический подход является залогом положительных результатов торговли на Форекс. Наш сервис создан в качестве оптимального помощника как начинающим, так и профессиональным трейдерам.</p>
			</div>
		</div>
		<div class="block">
			<div class="block_inner">
				<iframe id="market_trends_widget" src="https://trading4pro.com/market-trends/?symbols=EURUSD,GBPUSD,AUDUSD,NZDUSD,USDCAD,USDCHF,USDJPY,EURJPY,CADCHF,EURRUB,XAUUSD,XAGUSD&height=784" frameborder="0" height="784" width="303"></iframe>
			</div>
		</div>
		<div class="block">
			<div class="block_inner">
				<?php require('include/chartWidget.php'); ?>
			</div>
		</div>
		<div class="block">
			<div class="block_inner"></div>
		</div>
	</section>
	<section class="banner2 container">
		<div class="slider" id="main_slider">
			<div class="overflow_hidden_container">
				<div class="overflow_block clr flex flex-center-v">
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup-action="open" data-popup-target="registration_form_popup">
							<img src="img/RU_Trade-Online_picture_970x250%20frame_0.png" alt="" class="responsive_img">
						</a>
					</div>
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup-action="open" data-popup-target="registration_form_popup">
							<img src="img/RU_Trade-Online_picture_970x250%20frame_1.png" alt="" class="responsive_img">
						</a>
					</div>
					<div class="slider_slide" data-component="slide">
						<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" data-popup-action="open" data-popup-target="registration_form_popup">
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
	<?php require('include/registrationForm_popup.php'); ?>
	<?php require('include/autoRegistration_popup.php'); ?>
	<?php require('include/footer.php'); ?>
</body>
</html>
