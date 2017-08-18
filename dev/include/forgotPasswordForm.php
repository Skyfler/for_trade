<form action="#" class="contact_form clr content_inner flex" method="post" id="<?= $formId; ?>">
	<button class="close" data-popup-action="close" data-popup-target="<?= $popupTarget; ?>"></button>
	<div class="waiting_block"></div>
	<div class="block_main_title"><?= $formTitle; ?></div>
	<div class="input_group input_email">
		<input type="email" placeholder="Email" required class="required" name="email" data-component="form-input">
	</div>
	<div class="input_group input_submit">
		<button type="submit" class="submit" onclick="this.form.formInputTel.setCustomValidity('');"><span>Восстановить пароль</span></button>
	</div>
</form>
