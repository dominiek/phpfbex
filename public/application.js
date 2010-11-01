
  function fbConnect(options) {
    if(!options) {
      options = {};
    }
    FB.login(function(response) {
      if (response.session) {
        // A user has logged in, and a new cookie has been saved
        var url = "/?action=connect";
        if(options['pair']) {
          url = "/?action=pair";
        }
        if(options['redirectBack']) {
          url += "?redirectBackTo="+encodeURI(document.location.href);
        }
        document.location.href = url;
      } else {
        // The user has logged out, and the cookie has been cleared
      }
    }, {perms:'read_stream,publish_stream,offline_access,email'});
    return false;
  }

  function fbDisconnect() {
    FB.logout(function(response) {
      // user is now logged out
      document.location.href = "/?action=logout";
    });
    return false;
  }