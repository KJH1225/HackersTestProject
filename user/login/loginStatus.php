<?php
  session_start();
  if( isset( $_SESSION['loginUser'] ) ) {
    $loginStatus = true;
  }
?>