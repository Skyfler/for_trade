<form action="login.php" class="contact_form" method="post" id="<?= $formId; ?>">
	<div class="waiting_block"></div>
	<div class="form_inner_container clr flex">
		<button class="close" data-popup-action="close" data-popup-target="<?= $popupTarget; ?>"></button>

		<input type='hidden' name='submitted' id='submitted' value='1' data-component="form-input">

		<div class="block_main_title"><?= $formTitle; ?></div>
		<div class="input_group input_email">
			<input type="email" placeholder="Email" required class="required" name="email" data-component="form-input">
		</div>
		<div class="input_group input_password">
			<input type="password" placeholder="Password" required class="required" name="password" data-component="form-input">
		</div>
		<div class="input_group input_submit">
			<button type="submit" class="submit" onclick="this.form.email.setCustomValidity('');"><span>Войти</span></button>
		</div>
		<div class="input_group">
			<button class="tab_label" data-tab-target="tab_3">Восстановление пароля</button>
		</div>
	<!--
		<div class="input_group info_group">
			Нажимая кнопку “ОТПРАВИТЬ” Вы подтверждаете , что согласны с правилами и условиями<a href="#"></a> пользования сайтом Sigfxpro.com
		</div>
	-->
	</div>
</form>
