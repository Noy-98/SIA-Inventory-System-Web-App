<?php

$hostName = "localhost";
$dbUser = "noy";
$dbPassword = "noy123";
$dbName = "noy_electronics_shop_db";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
};
