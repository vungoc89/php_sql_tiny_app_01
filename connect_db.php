<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$host = "localhost";
$user = "root";
$password = "";
$database = "demo_db_andn";
$conn = mysqli_connect($host, $user, $password, $database);

if(mysqli_connect_errno()){
    echo "Connection failed". mysqli_connect_errno();
}
//else{
//    echo "Connection ok";
//}