
<?php
  require_once('/home/users/web/b214/ipg.bumiops/AskHelp/includes/initialize.php');

  
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
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    $data = curl_exec($ch);
    if(curl_errno($ch)){
     echo 'Curl error: ' . curl_error($ch) . "\n";
     return false;
    }
    curl_close($ch);
    return $data;
  }

  $msisdn = isset($_GET['msisdn']) ? $_GET['msisdn'] : "";
  $text = isset($_GET['text']) ? $_GET['text'] : "";
  $rrn = isset($_GET['rrn']) ? $_GET['rrn'] : "";

  if ($msisdn != "") {
    $message = new Messages();
    $message->msisdn = $msisdn;
    $message->text = $text;
    $message->rrn = $rrn;
    $message->save();
  }

?>


<!doctype html>
<html>
<head>
  <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
</head>
<body>
  <?php
      $messages = Messages::find_all();
      foreach ($messages as $msg) {
        echo $msg->text . "<br>";
      }
  ?>
  <button id="fb-login">Login &amp; Permissions</button>
  <script>
  $(function() {
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '556202757797620',
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true
      });
    };

    document.getElementById('fb-login').onclick = function() {
      var cb = function(response) {
        console.log('FB.login callback', response);
        if (response.status === 'connected') {
          testAPI();
        } else {
          console.log('User is logged out');
        }
      };
      FB.login(cb, { scope: 'publish_actions' });
    };

    // Load the SDK asynchronously
    (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
    }(document));

    // Here we run a very simple test of the Graph API after login is successful. 
    // This testAPI() function is only called in those cases. 
    function testAPI() {
      var accessToken = FB.getAuthResponse().accessToken;
      $.ajax({
        type:'POST',
        url:"extend.php",
        data:"id="+accessToken,
        dataType: "json",
        success:function(data) {
          console.log('Success Post');
        }
      });

    }
  });
  </script>
  <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
</body>
</html>