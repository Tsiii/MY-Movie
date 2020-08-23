<?php

$db = mysqli_connect("localhost","root","","moviefinder");

if (!$db) {
  die("Connection failed DB: " . mysqli_connect_error());
}