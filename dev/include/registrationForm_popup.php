<div class="popup" id="registration_form_popup">
	<?php
		$popupTarget = 'registration_form_popup';
	?>
	<div class="popup_inner flex flex-center-x flex-center-y">
		<?php
			$formId = 'registration_from';
			$formTitle = 'Заполните форму';
			require('registrationForm.php');
		?>
	</div>
</div>
