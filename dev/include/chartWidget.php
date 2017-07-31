<?php
	$secretToken = 'hJwl3tyPT78fkDbVZHhX773jDekkdjIa';
	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$userToken = '';
	for ($i = 0; $i < 32; $i++) {
		$userToken .= $chars[mt_rand(0, strlen($chars) - 1)];
	}
	@file_get_contents("https://trading4pro.com:8010/?token=$secretToken&key=$userToken");
?>
<div>
	<div id="t4p-chart-widget" data-w="400" data-h="552" data-key="<?=$userToken ?>"></div>
</div>
