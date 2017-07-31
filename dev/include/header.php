<header>
	<nav class="closed menu clr container" id="main_menu">
		<div class="navbar_header clr">
			<h1 class="clr">
				<a href="/" class="navbar_brand flex flex-center-y">
					<img src="img/logo.png" alt="SIXPRO" class="responsive_img">
				</a>
			</h1>
			<button class="dropdown_toggle" data-component="dropdown_toggle">
				<span class="icon_bar"></span>
				<span class="icon_bar"></span>
				<span class="icon_bar"></span>
			</button>
		</div>
		<div class="dropdown_container clr">
			<div class="dropdown_bar clr">
				<ul class="menu_bar clr">
					<li class="<?= $activeMenu === 'index' ? 'active' : ""; ?>">
						<a href="/" class="flex flex-center-y"><span>Главная</span></a>
					</li>
					<li class="desktop-hidden <?= $activeMenu === 'analytics' ? 'active' : ""; ?>">
						<a href="analytics.php" class="flex flex-center-y"><span>Аналитика (Премиум пакет)</span></a>
					</li>
					<li class="<?= $activeMenu === 'calendar' ? 'active' : ""; ?>">
						<a href="calendar.php" class="flex flex-center-y"><span>Экономический календарь</span></a>
					</li>
					<li class="<?= $activeMenu === 'instruction' ? 'active' : ""; ?>">
						<a href="instruction.php" class="flex flex-center-y"><span>Инструкция</span></a>
					</li>
					<li class="<?= $activeMenu === 'about' ? 'active' : ""; ?>">
						<a href="about.php" class="flex flex-center-y"><span>О нас</span></a>
					</li>
				</ul>
				<div class="navbar_end flex flex-center-y">
					<a href="https://www.fortrade.com/aff/143636/fortradeccpayments/" class="navbar_end_btn">
						<span>Активировать</span>
						<span>Премиум пакет</span>
					</a>
				</div>
			</div>
		</div>
	</nav>
</header>