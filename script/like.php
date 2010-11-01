<?php
  /**
   * Current state of liking through the API: http://forum.developers.facebook.net/viewtopic.php?pid=278380
   * "Facebook does not allow liking of pages or any other objects on user's behalf. The only exception is that you can like user posts. Facebook is looking into allowing to like pages, but they didn't make any commitments. "
   * Official bug report: http://bugs.developers.facebook.net/show_bug.cgi?id=10714
   */

  require_once("../application.php");

  function fbLike($fb_uid, $postId, $streamObject) {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;
    
    $facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
    ));
    
    $session = unserialize(file_get_contents("../".$fb_uid.".dat"));
    $facebook->setSession($session);
    try {
      return $facebook->api('/'.$postId.'/likes', 'post', $streamObject);
    } catch (FacebookApiException $e) {
      error_log($e);
      if($e->getType() == 'OAuthException') {
        echo "Session needs to be deactivated\n";
      }
      exit("Oops, we received a Facebook API Error.");
    }
  }
  
  //$postId = '687215451_492435175451';
  $postId = '161861217180367';
  //$postId = '37060388813_461667408813';
  fbLike(687215451, $postId, array())
  
?>