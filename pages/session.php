<?php 
  session_start();

  function pathTo($destination) {
    echo "<script>window.location.href = './$destination.php'</script>";
  }

  if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
    /* Set status to invalid */
    $_SESSION['status'] = 'invalid';
    $_SESSION['error'] = 'Please fill up all fields'; 
    /* Unset user data */
    unset($_SESSION['username']);
    /* Redirect to login page */
    pathTo('index');
  }
?>