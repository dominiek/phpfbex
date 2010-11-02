<?php

  require_once("../application.php");


  /**
   * User can be a user id or the part of a name.
   * X and Y are NOT pixel coordinates, they are relative percentages.
   */
  function fbTagPhoto($fb_uid, $photo_id, $user, $percentage_x, $percentage_y) {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;
    
    $facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
    ));
    
    $session = unserialize(file_get_contents("../".$fb_uid.".dat"));
    $facebook->setSession($session);
    $facebook->setFileUploadSupport(true);
    try {
      // See: http://forum.developers.facebook.net/viewtopic.php?pid=239250
      $oldRestCall = array(
        'method' => 'photos.addTag',
        'pid' => $photo_id."",
        'x' => $percentage_x,
        'y' => $percentage_y
      );
      if(is_numeric($user)) {
        $oldRestCall['tag_uid'] = $user;
      } else {
        $oldRestCall['tag_text'] = $user;        
      }
      return $facebook->api($oldRestCall);
    } catch (FacebookApiException $e) {
      error_log($e);
      exit("Oops, we received a Facebook API Error.");
    }
  }
  //493551060451
  //7048923
  //687215451
  //2951567887357939419
  $result = fbTagPhoto(687215451, "2951567887357939419", "Arjan Scherpenisse", 50, 50);
  print_r($result);
  
?>