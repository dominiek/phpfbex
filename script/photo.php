<?php

  require_once("../application.php");

  function fbUploadPhoto($fb_uid, $image_path, $caption) {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;
    
    $facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
    ));
    
    $session = unserialize(file_get_contents("../".$fb_uid.".dat"));
    $facebook->setSession($session);
    $facebook->setFileUploadSupport(true);
    try {
      $picture = array(
        'source' => '@'.$image_path,
        'message' => $caption
      );
      return $facebook->api('/me/photos', 'post', $picture);
    } catch (FacebookApiException $e) {
      error_log($e);
      exit("Oops, we received a Facebook API Error.");
    }
  }
  
  $result = fbUploadPhoto(687215451, realpath('../test.jpg'), "Testis");
  print_r($result);
  
?>