<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "paguyuban_ta";
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_database) or die("Connection failed: " . mysqli_connect_error());
date_default_timezone_set("Asia/Jakarta");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */