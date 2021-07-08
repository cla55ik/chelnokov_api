<?php

require 'connect.php';

$projects = mysqli_query($connect, "SELECT * FROM `projects`");

print_r($projects);

$method = $_SERVER['REQUEST_METHOD'];
