<?php
      $hostname_MyConnectionPHP = "localhost";
      $database_MyConnectionPHP = "miniproject";
      $username_MyConnectionPHP = "root";
      $password_MyConnectionPHP = "";
      $connections = mysql_connect($hostname_MyConnectionPHP, $username_MyConnectionPHP, $password_MyConnectionPHP) or die ( "Unabale to connect to the database" );
?>