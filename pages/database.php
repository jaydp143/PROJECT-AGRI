<?php
  $host = 'localhost';
  $user = 'root';
  $password = '123456';
  $database = 'agri_db';

  $connection = mysqli_connect($host, $user, $password, $database);

  if (mysqli_connect_error()) {
    echo 'error';
  }
?>