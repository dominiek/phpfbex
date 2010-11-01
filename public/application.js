
  function fbPair(options) {
    alert("Pairing!");
    return false;
  }

  function fbDisconnect() {
    FB.logout(function(response) {
      // user is now logged out
      document.location.href = "/?action=logout";
    });
    return false;
  }