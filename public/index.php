<?php require_once("../application.php"); ?>
<html>
  <head>
    <title>Anymeta Login</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.json.min.js"></script>
    <script type="text/javascript" src="application.js"></script>
  </head>
  
  <body>
    <div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
    <script type="text/javascript">
      FB.init({appId: '<?= $FACEBOOK_APPLICATION_ID ?>', status: true, cookie: true, xfbml: true});
      FB.Event.subscribe('auth.sessionChange', function(response) {
          if (response.session) {
            // A user has logged in, and a new cookie has been saved
            
            // Option 1: Cookie
            //document.location.href = '/?action=connect';
            
            // Option2: Session in Request
            $.post("/?action=connect", {session: $.toJSON(response.session)}, function() {
              document.location.href = '/';
            });
            
          } else {
            // The user has logged out, and the cookie has been cleared
            document.location.href = '/?action=logout';
          }
        });
    </script>
    <?php if(array_key_exists('me', $_SESSION) && $_SESSION['me']) { ?>
      <h1>Hi there, <?= $_SESSION['me']['name'] ?>!</h1>
      <p><a href="#" onclick="return fbDisconnect();">Logout</a>
      <!-- <?php print_r($_SESSION['me']); ?> -->
    <?php } else { ?>
      <h1>Hi there, Stranger!</h1>
      <p>
        <!--<a href="#" onclick="return fbConnect();">Login</a>-->
        <fb:login-button perms="read_stream,publish_stream,offline_access,email"></fb:login-button>
      </p>
    <?php } ?>
  </body>
</html>