<section class="banner">
	<!--<img src="img/banner.jpg" alt="" class="responsive_img">-->
	<div class="text_block flex flex-center-y container">
		<div class="text_block_inner">
			<p class="first_line">Сделай рынок форекс доступным для себя вместе с&nbsp;нами</p>
			<p class="second_line">Зарабатывай вместе с&nbsp;профессионалами</p>
			<!--<a href="https://www.fortrade.com/ru/?B=5735&A=143636&mtId=5735" target="_blank" class="banner_btn" data-popup="open">-->
			<!--	<span>Активировать <b>торговый счет</b></span>-->
			<!--</a>-->
		</div>
		<div class="form_block flex">
			<?php
				$noTitle = true;
				$noCloseBtn = true;
				$noLogo = true;
				$noTerms = true;
				$noInstruction = true;
				$formId = 'banner_registration_from';
				require('registrationForm.php');
				$noTitle = false;
				$noCloseBtn = false;
				$noLogo = false;
				$noTerms = false;
				$noInstruction = false;
			?>
		</div>
	</div>
</section>
