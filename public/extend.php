<?php

function extend_token($shortlivetoken) {
	$client_id = '556202757797620';
	$client_secret = '0f6987a93555f9a9d71cdde341b57f55';
	$url = 'https://graph.facebook.com/oauth/access_token?client_id='.$client_id.'&client_secret='.$client_secret.'&grant_type=fb_exchange_token&fb_exchange_token='.$shortlivetoken.'&req_perms=publish_actions';
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
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	$data = curl_exec($ch);
	  if(curl_errno($ch)){
	   echo 'Curl error: ' . curl_error($ch) . "\n";
	   return false;
	}

	curl_close($ch);
	return $data;
}

function get_code($longlivetoken) {
	$client_secret = '0f6987a93555f9a9d71cdde341b57f55';
	$url = 'https://graph.facebook.com/oauth/client_code?access_token='.$longlivetoken.'&client_secret='.$client_secret.'&redirect_uri=http://bumiarmadaops.com/AskHelp/';
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
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	$data = curl_exec($ch);
	  if(curl_errno($ch)){
	   echo 'Curl error: ' . curl_error($ch) . "\n";
	   return false;
	}

	curl_close($ch);
	return $data;
}

function fb_post($accessToken, $message) {
    $cookie_file_path = "C:/wamp/www/crawler/bestbuy/cookie.txt";
    $url = 'https://graph.facebook.com/me/feed?';
    $data = 'method=POST&message='.$message.'&format=json&suppress_http_code=1&access_token='.$accessToken;
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
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    $data = curl_exec($ch);
    if(curl_errno($ch)){
     echo 'Curl error: ' . curl_error($ch) . "\n";
     return false;
    }
    curl_close($ch);
    return $data;
  }

$id = isset($_POST['id']) ? $_POST['id'] : "";
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
$fbid = isset($_POST['fbid']) ? $_POST['fbid'] : "";
if ($id != '') {
	$shortlivetoken = $_POST['id'];
	$long_token = extend_token($shortlivetoken);
	parse_str($long_token, $a);
	// $code = get_code($long_token);
	// echo $code;
	//echo $a['access_token'];
	fb_post($a['access_token'], "Testing daw dafsdfasdf");
}

?>