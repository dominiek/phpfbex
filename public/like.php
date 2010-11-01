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
      FB.Event.subscribe('edge.create', function(response) {
          alert("User liked this page!");
      });
    </script>
    <fb:like href="http://<?= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ?>"></fb:like>
  </body>
</html>