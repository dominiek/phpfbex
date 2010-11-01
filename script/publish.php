<?php

  require_once("../application.php");

  function fbPublish($fb_uid, $streamObject) {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;
    
    $facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
    ));
    
    $session = unserialize(file_get_contents("../".$fb_uid.".dat"));
    $facebook->setSession($session);
    try {
      return $facebook->api('/me/feed', 'post', $streamObject);
    } catch (FacebookApiException $e) {
      error_log($e);
      if($e->getType() == 'OAuthException') {
        echo "Session needs to be deactivated\n";
      }
      exit("Oops, we received a Facebook API Error.");
    }
  }
  
  fbPublish(687215451, array('message' => 'test 1 2 3'))
  
?>