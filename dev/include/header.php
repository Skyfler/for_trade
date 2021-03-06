<header>
	<nav class="closed menu clr container" id="main_menu">
		<div class="navbar_header clr">
			<h1 class="clr">
				<a href="/" class="navbar_brand flex flex-center-y">
					<img src="img/logo.png" alt="SIGFXPRO" class="responsive_img">
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
						<a href="analytics" class="flex flex-center-y"><span>Теханализ(Премиум пакет)</span></a>
					</li>
					<li class="<?= $activeMenu === 'calendar' ? 'active' : ""; ?>">
						<a href="calendar" class="flex flex-center-y"><span>Экономический календарь</span></a>
					</li>
					<li class="<?= $activeMenu === 'instruction' ? 'active' : ""; ?>">
						<a href="instruction" class="flex flex-center-y"><span>Инструкция</span></a>
					</li>
					<li class="<?= $activeMenu === 'about' ? 'active' : ""; ?>">
						<a href="about" class="flex flex-center-y"><span>О нас</span></a>
					</li>
				</ul>
				<div class="navbar_end flex flex-center-y">
					<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" class="navbar_end_btn navbar_end_btn_desktop" data-popup-action="open" data-popup-target="registration_form_popup">
						<span>Активировать</span>
						<span>торговый счет</span>
					</a>
					<a href="https://www.fortrade.com/aff/143636/fortradeccpayments/" target="_blank" class="navbar_end_btn navbar_end_btn_mobile">
						<span>Активировать</span>
						<span>премиум пакет</span>
					</a>
					<?php if ($fgmembersite->CheckLogin()) { ?>
						<form id="logout_form" method="POST" action="logout.php">
							<input type="hidden" name="logout" value="1" data-component="form-input">
							<button type="submit" class="logout">Выйти</button>
						</form>
					<?php } else { ?>
						<button class="login" id="header_login_btn" data-popup-action="open" data-popup-target="auto_registration_form_popup">Войти</button>
					<?php } ?>
				</div>
			</div>
		</div>
	</nav>
</header>
