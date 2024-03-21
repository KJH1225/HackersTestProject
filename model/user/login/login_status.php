<?php
  session_start();
  
  if( isset( $_SESSION['loginUser'] ) ) {
    $loginStatus = true;
  }
  
  if(isset( $_SESSION['is_admin'] ) && $_SESSION['is_admin'] == 1) {
    $is_admin = true;
  }
?>