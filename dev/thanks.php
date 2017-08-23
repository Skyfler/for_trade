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
<html lang="ru" class="page-thanks">
<head>
	<?php require('include/head.php'); ?>
	<title>Спасибо</title>
</head>
<body>
	<?php
		$activeMenu = '';
		require('include/header.php');
	?>
	<section class="thanks">
		<div class="text_block container">
			<p class="title">Благодарим за регистрацию!</p>
			<p>На Вашу почту выслано сообщение с подтверждением.</p>
			<p>Наши специалисты свяжутся с Вами в ближайшее время.</p>
		</div>
	</section>
	<?php
	if (!$fgmembersite->CheckLogin()) {
		require('include/registrationForm_popup.php');
		require('include/autoRegistration_popup.php');
	}
	?>
	<?php require('include/footer.php'); ?>
	<!-- Google Code for SigFXPro Conversion Page -->
	<script type="text/javascript">
	// <![CDATA[ /
	var google_conversion_id = 979850402;
	var google_conversion_language = "en";
	var google_conversion_format = "3";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "p7oPCKSJkHQQoqmd0wM";
	var google_remarketing_only = false;
	// ]]> /
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/979850402/?label=p7oPCKSJkHQQoqmd0wM&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>
	<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '332687023846395'); // Insert your pixel ID here.
fbq('track', 'PageView');
fbq('track', 'CompleteRegistration');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=332687023846395&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</body>

</html>
