<?php

  require_once("../application.php");

  /**
   * One remaining issue is figuring out the 'pid' (picture id), that the Old REST API wants
   * As far as I know, you can NOT get this from the Graph API.
   */

  /**
   * User can be a user id or a name (will not auto-link to user)
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
  
  $result = fbTagPhoto(687215451, "2951567887357939419", 687215451, 50, 50);
  print_r($result);
  
?>