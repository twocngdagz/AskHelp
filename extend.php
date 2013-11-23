<?php

function extend_token($shortlivetoken) {
	$client_id = '556202757797620';
	$client_secret = '0f6987a93555f9a9d71cdde341b57f55';
	$url = 'https://graph.facebook.com/oauth/access_token?client_id='.$client_id.'&client_secret='.$client_secret.'&grant_type=fb_exchange_token&fb_exchange_token='.$shortlivetoken;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_ENCODING, 'identity');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/-.facebook.crt");
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	$data = curl_exec($ch);
	  if(curl_errno($ch)){
	   echo 'Curl error: ' . curl_error($ch) . "\n";
	   return false;
	}

	curl_close($ch);
	return $data;
}

$id = isset($_POST['id']) ? $_POST['id'] : "";
if ($id != '') {
	$shortlivetoken = $_POST['id'];
	echo extend_token($shortlivetoken);
}

?>