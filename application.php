<?php

  $FACEBOOK_API_KEY = 'ed63c7a64f41d5545f69214ff2bfe395';
  $FACEBOOK_APPLICATION_ID = '168209329871693';
  $FACEBOOK_APPLICATION_SECRET = '1293b2b9820f374acd872436b5c63a48';
  
  session_start();
  
  require_once("lib/facebook/src/facebook.php");
  
  function fbConnect() {
    global $FACEBOOK_APPLICATION_ID, $FACEBOOK_APPLICATION_SECRET;
  	$facebook = new Facebook(array(
      'appId'  => $FACEBOOK_APPLICATION_ID,
      'secret' => $FACEBOOK_APPLICATION_SECRET,
      'cookie' => true
    ));
    if(!$facebook->getSession()) {
      exit("Could not authenticate!");
    }
    try {
      $me = $facebook->api('/me');
    } catch (FacebookApiException $e) {
      error_log($e);
      exit("Oops, we received a Facebook API Error. Please reload this page and try again.");
    }
    // Persist:
    file_put_contents("../".$me['id'].".dat", serialize($facebook->getSession()));
    return $me;
  }
  
  function run($action) {
    if($action == 'connect') {
      $_SESSION['me'] = fbConnect();
      header("Location: /index.php");
      exit();
    }
    if($action == 'logout') {
      $_SESSION['me'] = NULL;
      header("Location: /index.php");
      exit();
    }
    if($action == 'deauthorize') {
    	$facebook = new Facebook(array(
        'appId'  => $FACEBOOK_APPLICATION_ID,
        'secret' => $FACEBOOK_APPLICATION_SECRET
      ));
      // You need to enable OAuth 2.0 for this in the application settings!
      $data = $facebook->getSignedRequest();
      if($data) {
        exit("Deauthorizing user: ".$data['user_id']);
      }
exit(".");
    }
  }
  
  if(array_key_exists('action', $_GET)) {
    run($_GET['action']);
  }

?>