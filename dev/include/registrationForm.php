<form action="register.php" class="contact_form" method="post" id="<?= $formId; ?>" data-after-ajax-action="https://api.affbank.net/servFortradeAff.php">
	<?php if (isset($noTitle) && $noTitle === true) {?>

	<?php } else {?>
		<div class="waiting_block"></div>
	<?php } ?>

	<div class="form_inner_container clr flex">
		<!--action="https://api.affbank.net/servFortradeAff.php"-->
		<?php if (isset($noCloseBtn) && $noCloseBtn === true) {?>

		<?php } else {?>
			<button class="close" data-popup-action="close" data-popup-target="<?= $popupTarget; ?>"></button>
		<?php } ?>
		<?php if (isset($noLogo) && $noLogo === true) {?>

		<?php } else {?>
			<img src="img/logo.png" alt="SIXPRO" class="responsive_img logo">
		<?php } ?>
		<input name="Campaign" type="hidden" required value="sigfxpro.com" data-component="form-input">
		<input name="brokerId" type="hidden" required value="32" data-component="form-input">
		<input name="source" type="hidden" required value="1" data-component="form-input">
		<input name="affiliate" type="hidden" required value="120" data-component="form-input">
		<input name="ip" id="ip" type="hidden" required value="<?= $_SERVER['REMOTE_ADDR']; ?>" data-component="form-input">

		<input type='hidden' name='submitted' id='submitted' value='1' data-component="form-input">

		<input type='text' class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' data-component="form-input">

		<?php if (isset($noTitle) && $noTitle === true) {?>

		<?php } else {?>
			<div class="waiting_block"></div>
			<div class="block_main_title"><?= $formTitle; ?></div>
		<?php } ?>
		<div class="input_group">
			<input type="text" placeholder="Имя" required class="required" name="first_name" data-component="form-input">
		</div>
		<div class="input_group">
			<input type="text" placeholder="Фамилия" required class="required" name="last_name" data-component="form-input">
		</div>
		<div class="input_group">
			<?php
				if (!isset($_SESSION['ip']) || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] || !isset($_SESSION['country'])) {
					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	//				echo 'file_get_contents(' . "https://ipinfo.io/{$_SESSION['ip']}" . ')<br>';
	//				$details = json_decode(file_get_contents("https://ipinfo.io/{$_SESSION['ip']}"));
	//				$_SESSION['country'] = $details->country;

					$curl = curl_init();

					$token = '9e2849a3bb9c0e';

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://ipinfo.io/{$_SESSION['ip']}/json?token={$token}",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
	//				  	echo "cURL Error #:" . $err;
					} else {
						// var_dump(json_decode($response));
						// echo '<br>';
						$resObj = json_decode($response);
						if (isset($resObj->country)) {
							$_SESSION['country'] = $resObj->country;
						} else {
							$_SESSION['country'] = false;
						}
					}

				}

	//			echo 'REMOTE_ADDR: ' . $_SERVER['REMOTE_ADDR'] . '<br>';
	//			echo 'ip: ' . $_SESSION['ip'] . '<br>';
	//			echo 'country: ' . $_SESSION['country'] . '<br>';
	//			var_dump($response);
	//			echo '<br>';
			?>
			<select class="required" name="codeNum" placeholder="Код страны" required data-component="form-input">
				<option value='93' <?= $_SESSION['country'] === 'AF' ? 'selected' : '';?>>+93 (Afghanistan)</option>
				<option value='355' <?= $_SESSION['country'] === 'AL' ? 'selected' : '';?>>++355 (Albania)</option>
				<option value='213' <?= $_SESSION['country'] === 'DZ' ? 'selected' : '';?>>+213 (Algeria)</option>
				<option value='1684' <?= $_SESSION['country'] === 'AS' ? 'selected' : '';?>>+1684 (American Samoa)</option>
				<option value='376' <?= $_SESSION['country'] === 'AD' ? 'selected' : '';?>>+376 (Andorra)</option>
				<option value='244' <?= $_SESSION['country'] === 'AO' ? 'selected' : '';?>>+244 (Angola)</option>
				<option value='1264' <?= $_SESSION['country'] === 'AI' ? 'selected' : '';?>>+1264 (Anguilla)</option>
				<option value='672' <?= $_SESSION['country'] === 'AQ' ? 'selected' : '';?>>+672 (Antarctica)</option>
				<option value='1268' <?= $_SESSION['country'] === 'AG' ? 'selected' : '';?>>+1268 (Antigua and Barbuda)</option>
				<option value='54' <?= $_SESSION['country'] === 'AR' ? 'selected' : '';?>>+54 (Argentina)</option>
				<option value='374' <?= $_SESSION['country'] === 'AM' ? 'selected' : '';?>>+374 (Armenia)</option>
				<option value='297' <?= $_SESSION['country'] === 'AW' ? 'selected' : '';?>>+297 (Aruba)</option>
				<option value='61' <?= $_SESSION['country'] === 'AU' ? 'selected' : '';?>>+61 (Australia)</option>
				<option value='43' <?= $_SESSION['country'] === 'AT' ? 'selected' : '';?>>+43 (Austria)</option>
				<option value='994' <?= $_SESSION['country'] === 'AZ' ? 'selected' : '';?>>+994 (Azerbaijan)</option>
				<option value='1242' <?= $_SESSION['country'] === 'BS' ? 'selected' : '';?>>+1242 (Bahamas)</option>
				<option value='973' <?= $_SESSION['country'] === 'BH' ? 'selected' : '';?>>+973 (Bahrain)</option>
				<option value='880' <?= $_SESSION['country'] === 'BD' ? 'selected' : '';?>>+880 (Bangladesh)</option>
				<option value='1246' <?= $_SESSION['country'] === 'BB' ? 'selected' : '';?>>+1246 (Barbados)</option>
				<option value='375' <?= $_SESSION['country'] === 'BY' ? 'selected' : '';?>>+375 (Belarus)</option>
				<option value='32' <?= $_SESSION['country'] === 'BE' ? 'selected' : '';?>>+32 (Belgium)</option>
				<option value='501' <?= $_SESSION['country'] === 'BZ' ? 'selected' : '';?>>+501 (Belize)</option>
				<option value='229' <?= $_SESSION['country'] === 'BJ' ? 'selected' : '';?>>+229 (Benin)</option>
				<option value='1441' <?= $_SESSION['country'] === 'BM' ? 'selected' : '';?>>+1441 (Bermuda)</option>
				<option value='975' <?= $_SESSION['country'] === 'BT' ? 'selected' : '';?>>+975 (Bhutan)</option>
				<option value='591' <?= $_SESSION['country'] === 'BO' ? 'selected' : '';?>>+591 (Bolivia)</option>
				<option value='387' <?= $_SESSION['country'] === 'BA' ? 'selected' : '';?>>+387 (Bosnia and Herzegovina)</option>
				<option value='267' <?= $_SESSION['country'] === 'BW' ? 'selected' : '';?>>+267 (Botswana)</option>
				<option value='55' <?= $_SESSION['country'] === 'BR' ? 'selected' : '';?>>+55 (Brazil)</option>
				<option value='246' <?= $_SESSION['country'] === 'IO' ? 'selected' : '';?>>+246 (British Indian Ocean Territory)</option>
				<option value='673' <?= $_SESSION['country'] === 'BN' ? 'selected' : '';?>>+673 (Brunei Darussalam)</option>
				<option value='359' <?= $_SESSION['country'] === 'BG' ? 'selected' : '';?>>+359 (Bulgaria)</option>
				<option value='226' <?= $_SESSION['country'] === 'BF' ? 'selected' : '';?>>+226 (Burkina Faso)</option>
				<option value='257' <?= $_SESSION['country'] === 'BI' ? 'selected' : '';?>>+257 (Burundi)</option>
				<option value='855' <?= $_SESSION['country'] === 'KH' ? 'selected' : '';?>>+855 (Cambodia)</option>
				<option value='237' <?= $_SESSION['country'] === 'CM' ? 'selected' : '';?>>+237 (Cameroon)</option>
				<option value='1' <?= $_SESSION['country'] === 'CA' ? 'selected' : '';?>>+1 (Canada)</option>
				<option value='238' <?= $_SESSION['country'] === 'CV' ? 'selected' : '';?>>+238 (Cape Verde)</option>
				<option value='1345' <?= $_SESSION['country'] === 'KY' ? 'selected' : '';?>>+1345 (Cayman Islands)</option>
				<option value='236' <?= $_SESSION['country'] === 'CF' ? 'selected' : '';?>>+236 (Central African Republic)</option>
				<option value='235' <?= $_SESSION['country'] === 'TD' ? 'selected' : '';?>>+235 (Chad)</option>
				<option value='56' <?= $_SESSION['country'] === 'CL' ? 'selected' : '';?>>+56 (Chile)</option>
				<option value='86' <?= $_SESSION['country'] === 'CN' ? 'selected' : '';?>>+86 (China)</option>
				<option value='61' <?= $_SESSION['country'] === 'CX' ? 'selected' : '';?>>+61 (Christmas Island)</option>
				<option value='61' <?= $_SESSION['country'] === 'CC' ? 'selected' : '';?>>+61 (Cocos (Keeling) Islands)</option>
				<option value='57' <?= $_SESSION['country'] === 'CO' ? 'selected' : '';?>>+57 (Colombia)</option>
				<option value='269' <?= $_SESSION['country'] === 'KM' ? 'selected' : '';?>>+269 (Comoros)</option>
				<option value='242' <?= $_SESSION['country'] === 'CG' ? 'selected' : '';?>>+242 (Congo)</option>
				<option value='243' <?= $_SESSION['country'] === 'CD' ? 'selected' : '';?>>+243 (Congo, the DR)</option>
				<option value='682' <?= $_SESSION['country'] === 'CK' ? 'selected' : '';?>>+682 (Cook Islands)</option>
				<option value='506' <?= $_SESSION['country'] === 'CR' ? 'selected' : '';?>>+506 (Costa Rica)</option>
				<option value='385' <?= $_SESSION['country'] === 'HR' ? 'selected' : '';?>>+385 (Croatia)</option>
				<option value='53' <?= $_SESSION['country'] === 'CU' ? 'selected' : '';?>>+53 (Cuba)</option>
				<option value='357' <?= $_SESSION['country'] === 'CY' ? 'selected' : '';?>>+357 (Cyprus)</option>
				<option value='420' <?= $_SESSION['country'] === 'CZ' ? 'selected' : '';?>>+420 (Czech Republic)</option>
				<option value='45' <?= $_SESSION['country'] === 'DK' ? 'selected' : '';?>>+45 (Denmark)</option>
				<option value='253' <?= $_SESSION['country'] === 'DJ' ? 'selected' : '';?>>+253 (Djibouti)</option>
				<option value='1767' <?= $_SESSION['country'] === 'DM' ? 'selected' : '';?>>+1767 (Dominica)</option>
				<option value='1809' <?= $_SESSION['country'] === 'DO' ? 'selected' : '';?>>+1809 (Dominican Republic)</option>
				<option value='593' <?= $_SESSION['country'] === 'EC' ? 'selected' : '';?>>+593 (Ecuador)</option>
				<option value='20' <?= $_SESSION['country'] === 'EG' ? 'selected' : '';?>>+20 (Egypt)</option>
				<option value='503' <?= $_SESSION['country'] === 'SV' ? 'selected' : '';?>>+503 (El Salvador)</option>
				<option value='240' <?= $_SESSION['country'] === 'GQ' ? 'selected' : '';?>>+240 (Equatorial Guinea)</option>
				<option value='291' <?= $_SESSION['country'] === 'ER' ? 'selected' : '';?>>+291 (Eritrea)</option>
				<option value='372' <?= $_SESSION['country'] === 'EE' ? 'selected' : '';?>>+372 (Estonia)</option>
				<option value='251' <?= $_SESSION['country'] === 'ET' ? 'selected' : '';?>>+251 (Ethiopia)</option>
				<option value='500' <?= $_SESSION['country'] === 'FK' ? 'selected' : '';?>>+500 (Falkland Islands (Malvinas))</option>
				<option value='298' <?= $_SESSION['country'] === 'FO' ? 'selected' : '';?>>+298 (Faroe Islands)</option>
				<option value='679' <?= $_SESSION['country'] === 'FJ' ? 'selected' : '';?>>+679 (Fiji)</option>
				<option value='358' <?= $_SESSION['country'] === 'FI' ? 'selected' : '';?>>+358 (Finland)</option>
				<option value='33' <?= $_SESSION['country'] === 'FR' ? 'selected' : '';?>>+33 (France)</option>
				<option value='689' <?= $_SESSION['country'] === 'PF' ? 'selected' : '';?>>+689 (French Polynesia)</option>
				<option value='241' <?= $_SESSION['country'] === 'GA' ? 'selected' : '';?>>+241 (Gabon)</option>
				<option value='220' <?= $_SESSION['country'] === 'GM' ? 'selected' : '';?>>+220 (Gambia)</option>
				<option value='995' <?= $_SESSION['country'] === 'GE' ? 'selected' : '';?>>+995 (Georgia)</option>
				<option value='49' <?= $_SESSION['country'] === 'DE' ? 'selected' : '';?>>+49 (Germany)</option>
				<option value='233' <?= $_SESSION['country'] === 'GH' ? 'selected' : '';?>>+233 (Ghana)</option>
				<option value='350' <?= $_SESSION['country'] === 'GI' ? 'selected' : '';?>>+350 (Gibraltar)</option>
				<option value='30' <?= $_SESSION['country'] === 'GR' ? 'selected' : '';?>>+30 (Greece)</option>
				<option value='2991' <?= $_SESSION['country'] === 'GL' ? 'selected' : '';?>>+2991 (Greenland)</option>
				<option value='1473' <?= $_SESSION['country'] === 'GD' ? 'selected' : '';?>>+1473 (Grenada)</option>
				<option value='590' <?= $_SESSION['country'] === 'GP' ? 'selected' : '';?>>+590 (Guadeloupe)</option>
				<option value='1671' <?= $_SESSION['country'] === 'GU' ? 'selected' : '';?>>+1671 (Guam)</option>
				<option value='502' <?= $_SESSION['country'] === 'GT' ? 'selected' : '';?>>+502 (Guatemala)</option>
				<option value='224' <?= $_SESSION['country'] === 'GN' ? 'selected' : '';?>>+224 (Guinea)</option>
				<option value='245' <?= $_SESSION['country'] === 'GW' ? 'selected' : '';?>>+245 (Guinea-Bissau)</option>
				<option value='592' <?= $_SESSION['country'] === 'GY' ? 'selected' : '';?>>+592 (Guyana)</option>
				<option value='509' <?= $_SESSION['country'] === 'HT' ? 'selected' : '';?>>+509 (Haiti)</option>
				<option value='379' <?= $_SESSION['country'] === 'VA' ? 'selected' : '';?>>+379 (Holy See (Vatican City State))</option>
				<option value='504' <?= $_SESSION['country'] === 'HN' ? 'selected' : '';?>>+504 (Honduras)</option>
				<option value='852' <?= $_SESSION['country'] === 'HK' ? 'selected' : '';?>>+852 (Hong Kong)</option>
				<option value='36' <?= $_SESSION['country'] === 'HU' ? 'selected' : '';?>>+36 (Hungary)</option>
				<option value='354' <?= $_SESSION['country'] === 'IS' ? 'selected' : '';?>>+354 (Iceland)</option>
				<option value='91' <?= $_SESSION['country'] === 'IN' ? 'selected' : '';?>>+91 (India)</option>
				<option value='62' <?= $_SESSION['country'] === 'ID' ? 'selected' : '';?>>+62 (Indonesia)</option>
				<option value='98' <?= $_SESSION['country'] === 'IR' ? 'selected' : '';?>>+98 (Iran, Islamic Republic of)</option>
				<option value='964' <?= $_SESSION['country'] === 'IQ' ? 'selected' : '';?>>+964 (Iraq)</option>
				<option value='353' <?= $_SESSION['country'] === 'IE' ? 'selected' : '';?>>+353 (Ireland)</option>
				<option value='972' <?= $_SESSION['country'] === 'IL' ? 'selected' : '';?>>+972 (Israel)</option>
				<option value='39' <?= $_SESSION['country'] === 'IT' ? 'selected' : '';?>>+39 (Italy)</option>
				<option value='1876' <?= $_SESSION['country'] === 'JM' ? 'selected' : '';?>>+1876 (Jamaica)</option>
				<option value='81' <?= $_SESSION['country'] === 'JP' ? 'selected' : '';?>>+81 (Japan)</option>
				<option value='962' <?= $_SESSION['country'] === 'JO' ? 'selected' : '';?>>+962 (Jordan)</option>
				<option value='7' <?= $_SESSION['country'] === 'KZ' ? 'selected' : '';?>>+7 (Kazakhstan)</option>
				<option value='254' <?= $_SESSION['country'] === 'KE' ? 'selected' : '';?>>+254 (Kenya)</option>
				<option value='686' <?= $_SESSION['country'] === 'KI' ? 'selected' : '';?>>+686 (Kiribati)</option>
				<option value='850' <?= $_SESSION['country'] === 'KP' ? 'selected' : '';?>>+850 (Korea, Democratic Republic)</option>
				<option value='82' <?= $_SESSION['country'] === 'KR' ? 'selected' : '';?>>+82 (Korea, Republic of)</option>
				<option value='965' <?= $_SESSION['country'] === 'KW' ? 'selected' : '';?>>+965 (Kuwait)</option>
				<option value='996' <?= $_SESSION['country'] === 'KG' ? 'selected' : '';?>>+996 (Kyrgyzstan)</option>
				<option value='856' <?= $_SESSION['country'] === 'LA' ? 'selected' : '';?>>+856 (Lao People's Democratic Republic)</option>
				<option value='371' <?= $_SESSION['country'] === 'LV' ? 'selected' : '';?>>+371 (Latvia)</option>
				<option value='961' <?= $_SESSION['country'] === 'LB' ? 'selected' : '';?>>+961 (Lebanon)</option>
				<option value='266' <?= $_SESSION['country'] === 'LS' ? 'selected' : '';?>>+266 (Lesotho)</option>
				<option value='231' <?= $_SESSION['country'] === 'LR' ? 'selected' : '';?>>+231 (Liberia)</option>
				<option value='218' <?= $_SESSION['country'] === 'LY' ? 'selected' : '';?>>+218 (Libyan Arab Jamahiriya)</option>
				<option value='423' <?= $_SESSION['country'] === 'LI' ? 'selected' : '';?>>+423 (Liechtenstein)</option>
				<option value='370' <?= $_SESSION['country'] === 'LT' ? 'selected' : '';?>>+370 (Lithuania)</option>
				<option value='352' <?= $_SESSION['country'] === 'LU' ? 'selected' : '';?>>+352 (Luxembourg)</option>
				<option value='853' <?= $_SESSION['country'] === 'MO' ? 'selected' : '';?>>+853 (Macao)</option>
				<option value='389' <?= $_SESSION['country'] === 'MK' ? 'selected' : '';?>>+389 (Macedonia)</option>
				<option value='261' <?= $_SESSION['country'] === 'MG' ? 'selected' : '';?>>+261 (Madagascar)</option>
				<option value='265' <?= $_SESSION['country'] === 'MW' ? 'selected' : '';?>>+265 (Malawi)</option>
				<option value='60' <?= $_SESSION['country'] === 'MY' ? 'selected' : '';?>>+60 (Malaysia)</option>
				<option value='960' <?= $_SESSION['country'] === 'MV' ? 'selected' : '';?>>+960 (Maldives)</option>
				<option value='223' <?= $_SESSION['country'] === 'ML' ? 'selected' : '';?>>+223 (Mali)</option>
				<option value='356' <?= $_SESSION['country'] === 'MT' ? 'selected' : '';?>>+356 (Malta)</option>
				<option value='692' <?= $_SESSION['country'] === 'MH' ? 'selected' : '';?>>+692 (Marshall Islands)</option>
				<option value='596' <?= $_SESSION['country'] === 'MQ' ? 'selected' : '';?>>+596 (Martinique)</option>
				<option value='222' <?= $_SESSION['country'] === 'MR' ? 'selected' : '';?>>+222 (Mauritania)</option>
				<option value='2302' <?= $_SESSION['country'] === 'MU' ? 'selected' : '';?>>+2302 (Mauritius)</option>
				<option value='262' <?= $_SESSION['country'] === 'YT' ? 'selected' : '';?>>+262 (Mayotte)</option>
				<option value='52' <?= $_SESSION['country'] === 'MX' ? 'selected' : '';?>>+52 (Mexico)</option>
				<option value='691' <?= $_SESSION['country'] === 'FM' ? 'selected' : '';?>>+691 (Micronesia, Federated States of)</option>
				<option value='373' <?= $_SESSION['country'] === 'MD' ? 'selected' : '';?>>+373 (Moldova, Republic of)</option>
				<option value='37797' <?= $_SESSION['country'] === 'MC' ? 'selected' : '';?>>+37797 (Monaco)</option>
				<option value='976' <?= $_SESSION['country'] === 'MN' ? 'selected' : '';?>>+976 (Mongolia)</option>
				<option value='1664' <?= $_SESSION['country'] === 'MS' ? 'selected' : '';?>>+1664 (Montserrat)</option>
				<option value='212' <?= $_SESSION['country'] === 'MA' ? 'selected' : '';?>>+212 (Morocco)</option>
				<option value='258' <?= $_SESSION['country'] === 'MZ' ? 'selected' : '';?>>+258 (Mozambique)</option>
				<option value='95' <?= $_SESSION['country'] === 'MM' ? 'selected' : '';?>>+95 (Myanmar)</option>
				<option value='264' <?= $_SESSION['country'] === 'NA' ? 'selected' : '';?>>+264 (Namibia)</option>
				<option value='674' <?= $_SESSION['country'] === 'NR' ? 'selected' : '';?>>+674 (Nauru)</option>
				<option value='977' <?= $_SESSION['country'] === 'NP' ? 'selected' : '';?>>+977 (Nepal)</option>
				<option value='31' <?= $_SESSION['country'] === 'NL' ? 'selected' : '';?>>+31 (Netherlands)</option>
				<option value='599' <?= $_SESSION['country'] === 'AN' ? 'selected' : '';?>>+599 (Netherlands Antilles)</option>
				<option value='687' <?= $_SESSION['country'] === 'NC' ? 'selected' : '';?>>+687 (New Caledonia)</option>
				<option value='64' <?= $_SESSION['country'] === 'NZ' ? 'selected' : '';?>>+64 (New Zealand)</option>
				<option value='505' <?= $_SESSION['country'] === 'NI' ? 'selected' : '';?>>+505 (Nicaragua)</option>
				<option value='227' <?= $_SESSION['country'] === 'NE' ? 'selected' : '';?>>+227 (Niger)</option>
				<option value='234' <?= $_SESSION['country'] === 'NG' ? 'selected' : '';?>>+234 (Nigeria)</option>
				<option value='683' <?= $_SESSION['country'] === 'NU' ? 'selected' : '';?>>+683 (Niue)</option>
				<option value='672' <?= $_SESSION['country'] === 'NF' ? 'selected' : '';?>>+672 (Norfolk Island)</option>
				<option value='1670' <?= $_SESSION['country'] === 'MP' ? 'selected' : '';?>>+1670 (Northern Mariana Islands)</option>
				<option value='47' <?= $_SESSION['country'] === 'NO' ? 'selected' : '';?>>+47 (Norway)</option>
				<option value='968' <?= $_SESSION['country'] === 'OM' ? 'selected' : '';?>>+968 (Oman)</option>
				<option value='92' <?= $_SESSION['country'] === 'PK' ? 'selected' : '';?>>+92 (Pakistan)</option>
				<option value='680' <?= $_SESSION['country'] === 'PW' ? 'selected' : '';?>>+680 (Palau)</option>
				<option value='970' <?= $_SESSION['country'] === 'PS' ? 'selected' : '';?>>+970 (Palestinian Territory)</option>
				<option value='507' <?= $_SESSION['country'] === 'PA' ? 'selected' : '';?>>+507 (Panama)</option>
				<option value='675' <?= $_SESSION['country'] === 'PG' ? 'selected' : '';?>>+675 (Papua New Guinea)</option>
				<option value='595' <?= $_SESSION['country'] === 'PY' ? 'selected' : '';?>>+595 (Paraguay)</option>
				<option value='51' <?= $_SESSION['country'] === 'PE' ? 'selected' : '';?>>+51 (Peru)</option>
				<option value='63' <?= $_SESSION['country'] === 'PH' ? 'selected' : '';?>>+63 (Philippine)</option>
				<option value='870' <?= $_SESSION['country'] === 'PN' ? 'selected' : '';?>>+870 (Pitcairn)</option>
				<option value='48' <?= $_SESSION['country'] === 'PL' ? 'selected' : '';?>>+48 (Poland)</option>
				<option value='351' <?= $_SESSION['country'] === 'PT' ? 'selected' : '';?>>+351 (Portugal)</option>
				<option value='1' <?= $_SESSION['country'] === 'PR' ? 'selected' : '';?>>+1 (Puerto Rico)</option>
				<option value='974' <?= $_SESSION['country'] === 'QA' ? 'selected' : '';?>>+974 (Qatar)</option>
				<option value='40' <?= $_SESSION['country'] === 'RO' ? 'selected' : '';?>>+40 (Romania)</option>
				<option value='250' <?= $_SESSION['country'] === 'RW' ? 'selected' : '';?>>+250 (Rwanda)</option>
				<option value='290' <?= $_SESSION['country'] === 'SH' ? 'selected' : '';?>>+290 (Saint Helena)</option>
				<option value='1869' <?= $_SESSION['country'] === 'KN' ? 'selected' : '';?>>+1869 (Saint Kitts and Nevis)</option>
				<option value='1758' <?= $_SESSION['country'] === 'LC' ? 'selected' : '';?>>+1758 (Saint Lucia)</option>
				<option value='508' <?= $_SESSION['country'] === 'PM' ? 'selected' : '';?>>+508 (Saint Pierre and Miquelon)</option>
				<option value='1784' <?= $_SESSION['country'] === 'VC' ? 'selected' : '';?>>+1784 (Saint Vincent and the Grenadines)</option>
				<option value='685' <?= $_SESSION['country'] === 'AS' ? 'selected' : '';?>>+685 (Samoa)</option>
				<option value='378' <?= $_SESSION['country'] === 'SM' ? 'selected' : '';?>>+378 (San Marino)</option>
				<option value='239' <?= $_SESSION['country'] === 'ST' ? 'selected' : '';?>>+239 (Sao Tome and Principe)</option>
				<option value='966' <?= $_SESSION['country'] === 'SA' ? 'selected' : '';?>>+966 (Saudi Arabia)</option>
				<option value='221' <?= $_SESSION['country'] === 'SN' ? 'selected' : '';?>>+221 (Senegal)</option>
				<option value='381' <?= $_SESSION['country'] === 'RS' ? 'selected' : '';?>>+381 (Serbia)</option>
				<option value='248' <?= $_SESSION['country'] === 'SC' ? 'selected' : '';?>>+248 (Seychelles)</option>
				<option value='232' <?= $_SESSION['country'] === 'SL' ? 'selected' : '';?>>+232 (Sierra Leone)</option>
				<option value='65' <?= $_SESSION['country'] === 'SG' ? 'selected' : '';?>>+65 (Singapore)</option>
				<option value='421' <?= $_SESSION['country'] === 'SK' ? 'selected' : '';?>>+421 (Slovakia)</option>
				<option value='386' <?= $_SESSION['country'] === 'SI' ? 'selected' : '';?>>+386 (Slovenia)</option>
				<option value='677' <?= $_SESSION['country'] === 'SB' ? 'selected' : '';?>>+677 (Solomon Islands)</option>
				<option value='252' <?= $_SESSION['country'] === 'SO' ? 'selected' : '';?>>+252 (Somalia)</option>
				<option value='27' <?= $_SESSION['country'] === 'ZA' ? 'selected' : '';?>>+27 (South Africa)</option>
				<option value='500' <?= $_SESSION['country'] === 'GS' ? 'selected' : '';?>>+500 (South Georgia and the SSI)</option>
				<option value='34' <?= $_SESSION['country'] === 'ES' ? 'selected' : '';?>>+34 (Spain)</option>
				<option value='94' <?= $_SESSION['country'] === 'LK' ? 'selected' : '';?>>+94 (Sri Lanka)</option>
				<option value='249' <?= $_SESSION['country'] === 'SS' ? 'selected' : '';?>>+249 (Sudan)</option>
				<option value='597' <?= $_SESSION['country'] === 'SR' ? 'selected' : '';?>>+597 (Suriname)</option>
				<option value='47' <?= $_SESSION['country'] === 'SJ' ? 'selected' : '';?>>+47 (Svalbard and Jan Mayen)</option>
				<option value='268' <?= $_SESSION['country'] === 'SZ' ? 'selected' : '';?>>+268 (Swaziland)</option>
				<option value='46' <?= $_SESSION['country'] === 'SE' ? 'selected' : '';?>>+46 (Sweden)</option>
				<option value='41' <?= $_SESSION['country'] === 'CH' ? 'selected' : '';?>>+41 (Switzerland)</option>
				<option value='963' <?= $_SESSION['country'] === 'SY' ? 'selected' : '';?>>+963 (Syrian Arab Republic)</option>
				<option value='886' <?= $_SESSION['country'] === 'TW' ? 'selected' : '';?>>+886 (Taiwan, Province of China)</option>
				<option value='992' <?= $_SESSION['country'] === 'TJ' ? 'selected' : '';?>>+992 (Tajikistan)</option>
				<option value='255' <?= $_SESSION['country'] === 'TZ' ? 'selected' : '';?>>+255 (Tanzania, United Republic of)</option>
				<option value='66' <?= $_SESSION['country'] === 'TH' ? 'selected' : '';?>>+66 (Thailand)</option>
				<option value='670' <?= $_SESSION['country'] === 'TL' ? 'selected' : '';?>>+670 (Timor-Leste)</option>
				<option value='228' <?= $_SESSION['country'] === 'TG' ? 'selected' : '';?>>+228 (Togo)</option>
				<option value='690' <?= $_SESSION['country'] === 'TK' ? 'selected' : '';?>>+690 (Tokelau)</option>
				<option value='676' <?= $_SESSION['country'] === 'TO' ? 'selected' : '';?>>+676 (Tonga)</option>
				<option value='1868' <?= $_SESSION['country'] === 'TT' ? 'selected' : '';?>>+1868 (Trinidad and Tobago)</option>
				<option value='216' <?= $_SESSION['country'] === 'TN' ? 'selected' : '';?>>+216 (Tunisia)</option>
				<option value='90' <?= $_SESSION['country'] === 'TR' ? 'selected' : '';?>>+90 (Turkey)</option>
				<option value='993' <?= $_SESSION['country'] === 'TM' ? 'selected' : '';?>>+993 (Turkmenistan)</option>
				<option value='1649' <?= $_SESSION['country'] === 'TC' ? 'selected' : '';?>>+1649 (Turks and Caicos Islands)</option>
				<option value='688' <?= $_SESSION['country'] === 'TV' ? 'selected' : '';?>>+688 (Tuvalu)</option>
				<option value='256' <?= $_SESSION['country'] === 'UG' ? 'selected' : '';?>>+256 (Uganda)</option>
				<option value='380' <?= $_SESSION['country'] === 'UA' ? 'selected' : '';?>>+380 (Ukraine)</option>
				<option value='971' <?= $_SESSION['country'] === 'AE' ? 'selected' : '';?>>+971 (United Arab Emirates)</option>
				<option value='44' <?= $_SESSION['country'] === 'GB' ? 'selected' : '';?>>+44 (United Kingdom)</option>
				<option value='1' <?= $_SESSION['country'] === 'US' ? 'selected' : '';?>>+1 (United States)</option>
				<option value='598' <?= $_SESSION['country'] === 'UY' ? 'selected' : '';?>>+598 (Uruguay)</option>
				<option value='998' <?= $_SESSION['country'] === 'UZ' ? 'selected' : '';?>>+998 (Uzbekistan)</option>
				<option value='678' <?= $_SESSION['country'] === 'VU' ? 'selected' : '';?>>+678 (Vanuatu)</option>
				<option value='58' <?= $_SESSION['country'] === 'VE' ? 'selected' : '';?>>+58 (Venezuela)</option>
				<option value='84' <?= $_SESSION['country'] === 'VN' ? 'selected' : '';?>>+84 (Vietnam)</option>
				<option value='1284' <?= $_SESSION['country'] === 'VG' ? 'selected' : '';?>>+1284 (Virgin Islands, British)</option>
				<option value='1340' <?= $_SESSION['country'] === 'VI' ? 'selected' : '';?>>+1340 (Virgin Islands, U.s.)</option>
				<option value='681' <?= $_SESSION['country'] === 'WF' ? 'selected' : '';?>>+681 (Wallis and Futuna)</option>
				<option value='212' <?= $_SESSION['country'] === 'EH' ? 'selected' : '';?>>+212 (Western Sahara)</option>
				<option value='967' <?= $_SESSION['country'] === 'YE' ? 'selected' : '';?>>+967 (Yemen)</option>
				<option value='260' <?= $_SESSION['country'] === 'ZM' ? 'selected' : '';?>>+260 (Zambia)</option>
				<option value='263' <?= $_SESSION['country'] === 'ZW' ? 'selected' : '';?>>+263 (Zimbabwe)</option>
				<option value='381' <?= $_SESSION['country'] === 'XK' ? 'selected' : '';?>>+381 (Kosovo)</option>
				<option value='382' <?= $_SESSION['country'] === 'ME' ? 'selected' : '';?>>+382 (Montenegro)</option>
				<option value='358' <?= $_SESSION['country'] === 'AX' ? 'selected' : '';?>>+358 (Aland Islands)</option>
				<option value='7' <?= $_SESSION['country'] === 'RU' ? 'selected' : '';?>>+7 (Russian Federation)</option>
			</select>
		</div>
		<div class="input_group">
			<input type="tel" placeholder="Телефон" id="formInputTel" required class="required" name="phonenum" data-component="form-input" pattern="[0-9]*"
			oninvalid="this.validity.patternMismatch ? setCustomValidity('В этом поле введенными данными могут быть только цифры') : '';"
			oninput="setCustomValidity('');">
		</div>
		<div class="input_group input_email">
			<input type="email" placeholder="Email" required class="required" name="email" data-component="form-input">
		</div>
		<!--<div class="input_group">-->
		<!--	<input type="password" placeholder="Password" required class="required" name="password" data-component="form-input">-->
		<!--</div>-->
		<div class="input_group input_submit">
			<button type="submit" class="submit" onclick="this.form.formInputTel.setCustomValidity('');"><span>Отправить</span></button>
		</div>
		<?php if (isset($noTerms) && $noTerms === true) {?>

		<?php } else {?>
			<div class="input_group info_group">
				<div class="terms_info">Нажимая кнопку “ОТПРАВИТЬ” Вы подтверждаете , что согласны с правилами и условиями<!--<a href="#"></a>--> пользования сайтом Sigfxpro.com</div>
			</div>
		<?php } ?>
		<?php if (isset($noInstruction) && $noInstruction === true) {?>

		<?php } else {?>
			<div class="input_group info_group">
				<div class="instruction_info">Рекомендуем ознакомиться с <a href="instruction">инструкцией</a>.</div>
			</div>
		<?php } ?>
		</div>
</form>
<?php if (!isset($beforeRegistrationSubmitFunction)) {?>
	<script>
		function beforeRegistrationSubmit() {
			try {
				fbq('track', 'CompleteRegistration');
			} catch (e) {
				console.log(e);
			}
			try {
				yaCounter45573387.reachGoal('LEAD');
			} catch (e) {
				console.log(e);
			}
		}
	</script>
<?php $beforeRegistrationSubmitFunction = true; } ?>
