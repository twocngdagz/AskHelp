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
        sendPost();
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
  function sendPost() {
    var accessToken = FB.getAuthResponse().accessToken;
    FB.api('/me', function(response) {
      var first_name = response.first_name;
      var last_name = response.last_name;
      var user_name = response.username;
      var fb_id = response.id;
      $.ajax({
        type:'POST',
        url:"create_user",
        data:{ id: accessToken, firstname: first_name, lastname: last_name, fbid: fb_id, username: user_name },
        success:function(data) {
          console.log('Success Post');
        }
      });
    });
  }
});