<?php
session_destroy();
setcookie("SESSION_ID",null,time()+1,'/');
header('location:../index.html');
?>