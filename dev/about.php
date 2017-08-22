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
	<title>О нас</title>
</head>
<body>
	<?php
		$activeMenu = 'about';
		require('include/header.php');
	?>
	<section class="about container flex">
		<div class="block">
			<p class="title">Professional Forex Signals</p>
			<p class="sub_title">Sigfxpro</p>
			<p>Зарабатывайте с легкостью на финансовом рынке с помощью бесплатных сигналов Форекс и аналитики в реальном времени от Sigfxpro.com. Лучшие торговые рекомендации в графической форме от профессиональных трейдеров.</p>
			<p>Sigfxpro.com – это уникальная концепция, максимально адаптированная как для новичков, так и для трейдеров с опытом.</p>
			<p>Наши сигналы показывают истинное направление инструмента, используя в алгоритме сантимент рынка и торговлю в тренде с крупными игроками. Комбинация интеллекта  компьютера и опыта аналитиков – лучшее  решение для любого трейдера.</p>
			<p>Простая регистрация и бесплатный доступ к сигналам помогут  вам зарабатывать с любого устройства, максимально оптимизировав качество торговли:</p>
			<ul>
				<li>Профессиональные сигналы в режиме онлайн</li>
				<li>Ежедневная аналитика от трейдеров</li>
				<li>Экономический календарь</li>
				<li>Инструменты: Форекс, металлы, CFD-контракты</li>
				<li>Графики в режиме реального времени с инструментами для теханализа</li>
				<li>Бонусные программы от брокеров  в бегущей ленте и другие актуальные новости</li>
			</ul>
			<p class="title">Наши контакты</p>
			<p class="sub_title">Email</p>
			<p><a href="mailto:info@sigfxpro.com">info@sigfxpro.com</a></p>
		</div>
		<div class="block">
			<p class="title">FAQs - Часто задаваемые вопросы</p>
			<!--<p class="sub_title">Email</p>-->
			<div class="dropdown_group">
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Зачем проходить регистрацию на сайте, если сигналы в свободном доступе?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>После прохождения регистрации с вами свяжется наш представитель и откроет доступ в личный кабинет, где у вас появится возможность получать V.I.P сигналы с аналикой и детальным объяснением каждой позиции.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Чем ваши сигналы лучше других?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>В отличие от многих сигнальных систем на рынке, наши сигналы разработаны трейдерами, а не генерируются рандомально. Все построено на технических индикаторах и комплексных алгоритмах. Более того, помимо автоматических сигналов у вас есть возможность получать V.I.P сигналы от настоящих трейдеров, которые добавляются ежедневно вручную.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">В чем разница между бесплатными сигналами и V.I.P сигналами?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Автоматические сигналы с левой стороны экрана являются техническим алгоритмом, а общие сигналы в ленте новостей выдаются в базовом формате. В личном кабинете вы будете получать живые детальные рекомендации от профессиональных трейдеров, а также специальные промо-акции и другие "вкусности", предназначенные лишь для зарегестрированных пользователей.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Дают ли сигналы 100% прибыльных сделок?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>В мире не существует систем, дающих 100% выигрышных сделок. Это все обман. Наш алгоритм сигналов выдает очень выскоий коэффициент прибильных позиций, а аналитика и рекомендации трейдеров – еще более высокий. Но это никогда не доходит до 100%.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Как использовать сигналы?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Автоматические сигналы не требуют никакого понимания рынка. Вы выбираете инструмент, на котором показан наиболее сильный сигнал, и открываете сделку. Для использования сигналов в новостной ленте, наведите курсор на сигнал и кликните “ADD”. Сигнал отобразится на графике с небольшим объяснением и направлением входа. Для более детальной информации пройдите в закладку "Инструкция".</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Какой минимальный депозит необходим для использования сигналов?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Минимальный депозит – ноль, как и прибыль с него. Отталкивайтесь от своих возможностей, потребностей и целей. Ваш средний доход в месяц может составлять от 5% до 30-40% и более. С депозита в 100$ вы можете зарабатывать пару десятков долларов; с депозита в 10,000$ прибыль составит несколько тысяч.</p>
							<p>Мы рекомендуем отрывать счета от 500$ и выше, но и с меньшими суммами вы сможете работать.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Как открыть сделку?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Если у вас нет торгового счета, то кликните на баннер внизу или на окошко "Активировать счет". После заполнения формы вы будете перенаправлены на сайт одного из наших брокеров-партнеров, где сможете открыть как демо, так и реальный счет для торговли.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Нужно ли входить во все сделки по всем сигналам?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Нет. Мы рекомендуем заходить лишь в те инструменты, по которым вы видите наиболее сильные сигналы: Strong Sell, Strong Buy. Для любителей агрессивной торговли также подойдут сигналы: Sell, Buy. По количеству сделок ограничений нет. Для контроля риска вашего портфеля мы советуем не рисковать более 2% от вашего счета по каждой отдельной сделке.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Почему я обязан отркыть счет именно у того брокера, с которым вы работаете?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Вы можете работать с любым брокером, поскольку сигналы бесплатные. Но все же для доступа к V.I.P вам необходимо открыть счет именно у того брокера, с которым работаем мы. Наши трейдеры и аналитики тратят свое время на построение сигналов для вас. Поэтому с нашей стороны легитимно давать доступ к этим сигналам лишь тем, кто сотрудничает с нами полностью. Мы работаем лишь с теми брокерами, которые проверены временем и которые дадут вам вывести любую прибыль, вне зависимости от ее размера. Более того, наши сигналы проверялись на котировках именно этих компаний и именно у них вы можете получить наиболее высокий коэффициент доходности.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Почему сигналы бесплатные? В чем ваш интерес?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Мы предоставляем вам качественные и профессиональные сигналы, которые позволят вам достойно зарабатывать на рынке. И, естественно, это стоит денег. Нашим доходом является часть спреда, котоую нам платит брокер-партнер с каждой вашей сделки. Другими словами, за ваши сигналы платит брокер, а не вы. Поэтому мы заинтересованы в вашем максимальном доходе и увеличении торгового оборота, а не в потере вашего депозита.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">Могу ли я потерять все свои деньги?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Торговля на финансовых рынках всегда несет определенный риск. Но при правильном управлении рисками и положительном математичеком ожидании шанс потерять весь депозит крайне мал. Для более углубленного понимания процесса и контроля рисков мы рекомендуем работать с нашими трейдерами, которые проведут с вами обучающий курс.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">У меня не работают сигналы/график/лента новостей. Что делать?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>В случае технической проблемы сразу сообщите о ней в чат. Наша техподдержка постарается решить все в кратчайшие сроки.</p>
						</div>
					</div>
				</div>
				<div class="closed droppownGroupItem">
					<p class="navbar_header sub_title">
						<span data-component="dropdown_toggle">На каких устройствах я могу использовать ваши сигналы?</span>
					</p>
					<div class="dropdown_container">
						<div class="dropdown_bar">
							<p>Вы можете воспользоваться нашими сигналами на любом устройстве. Тем, кто предпочитает работать с мобильных телефонов, мы рекомендуем установить мобильную апликацию из PlayMarket, пройдя по этой ссылке: <a href="https://play.google.com/store/apps/details?id=com.sigfxpro.sf&hl=RU">https://play.google.com/store/apps/details?id=com.sigfxpro.sf&hl=RU</a></p>
						</div>
					</div>
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
