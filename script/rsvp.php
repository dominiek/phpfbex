<?php

  require_once("../application.php");

  // Please note that this requires 'rsvp_event' to be added to the fb:button perms.
  // Possible values for rsvp_status: 'declined', 'maybe', 'attending'
  function fbRsvp($fb_uid, $event_id, $rsvp_status) {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;

    $facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
    ));

    $session = unserialize(file_get_contents("../".$fb_uid.".dat"));
    $facebook->setSession($session);
    try {
      return $facebook->api('/'.$event_id.'/'.$rsvp_status, 'post', array());
    } catch (FacebookApiException $e) {
      error_log($e);
      exit("Oops, we received a Facebook API Error.");
    }
  }
  
  // 234153442978 = International Day of Awesomeness
  fbRsvp(687215451, 234153442978, 'attending');

?>