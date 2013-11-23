
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
  <div id="fb-root"></div>
  <script>
  $(function() {
    window.fbAsyncInit = function() {
    FB.init({
      appId      : '556202757797620',
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
    // for any authentication related change, such as login, logout or session refresh. This means that
    // whenever someone who was previously logged out tries to log in again, the correct case below 
    // will be handled. 
    FB.Event.subscribe('auth.authResponseChange', function(response) {
      // Here we specify what we do with the response anytime this event occurs. 
      if (response.status === 'connected') {
        // The response object is returned with a status field that lets the app know the current
        // login status of the person. In this case, we're handling the situation where they 
        // have logged in to the app.
        testAPI();
      } else if (response.status === 'not_authorized') {
        // In this case, the person is logged into Facebook, but not into the app, so we call
        // FB.login() to prompt them to do so. 
        // In real-life usage, you wouldn't want to immediately prompt someone to login 
        // like this, for two reasons:
        // (1) JavaScript created popup windows are blocked by most browsers unless they 
        // result from direct interaction from people using the app (such as a mouse click)
        // (2) it is a bad experience to be continually prompted to login upon page load.
        FB.login();
      } else {
        // In this case, the person is not logged into Facebook, so we call the login() 
        // function to prompt them to do so. Note that at this stage there is no indication
        // of whether they are logged into the app. If they aren't then they'll see the Login
        // dialog right after they log in to Facebook. 
        // The same caveats as above apply to the FB.login() call here.
        FB.login();
      }
    });
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