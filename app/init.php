<?php
  session_start();

  $_SESSION['user_id'] = 1;

  $db = new PDO('mysql:dbname=todo;host=localhost', 'root', '746497');

  if(!isset($_SESSION['user_id'])){
    die('Please sign in');

  }


 
