<?php require_once("../application.php"); ?>
<html>
  <head>
    <title>Anymeta Brick</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.json.min.js"></script>
    <script type="text/javascript" src="application.js"></script>
    <meta property="og:title" content="Synaptify Synapse"/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="http://anymeta.synaptify.com/like.php"/>
    <meta property="og:image" content="http://www.georgiapainphysicians.com/downloads/m1_slides/8.%20Synaptic%20cleft.jpg"/>
    <meta property="og:site_name" content="Synaptify"/>
    <meta property="fb:admins" content="<?= $FACEBOOK_APPLICATION_ID ?>"/>
    <meta property="og:description"
          content="This is an original Synaptify Synapse object"/>
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