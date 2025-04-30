<?php
session_start();
session_unset(); // hapus semua session
session_destroy(); // hancurkan session
header('Location: index.php'); // balik ke login
exit;
?>

<script>
  function googleLogout() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out from Google');
      window.location.href = 'index.php';  // Arahkan kembali ke login setelah logout Google
    });
  }

  googleLogout();  // Panggil fungsi logout Google
</script>

