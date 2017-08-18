<div class="popup" id="auto_registration_form_popup">
	<?php
		$popupTarget = 'auto_registration_form_popup';
	?>
	<div class="popup_inner flex flex-center-x flex-center-y">
		<div class="tabs">
			<div class="tab_labels_container">
				<div class="tab_label selected" data-tab-target="tab_1">Регистрация</div>
				<div class="tab_label" data-tab-target="tab_2">Вход</div>
			</div>
			<div class="tab_blocks_container">
				<div class="tab_block tab_1 selected">
					<?php
						$formId = 'auto_registration_from';
						$formTitle = 'Для доступа к <b>V.I.P</b> сигналам и аналитике пройдите короткую регистрацию';
						require('registrationForm.php');
					?>
				</div>
				<div class="tab_block tab_2">
					<?php
						$formId = 'auto_autorisation_from';
						$formTitle = 'Авторизация';
						require('autorisationForm.php');
					?>
				</div>
				<div class="tab_block tab_3">
					<?php
						$formId = 'auto_forgot_password_from';
						$formTitle = 'Восстановление пароля';
						require('forgotPasswordForm.php');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
