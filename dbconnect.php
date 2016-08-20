<?php 
//connecting the database server
  $con = mysqli_connect("localhost","root","","listing") or die("Error " . mysqli_error($link)); 
  
//check if connection is established . if not print an error message
  if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }
  
  ?>
  