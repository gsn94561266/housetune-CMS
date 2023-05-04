<?php
session_start();
unset($_SESSION["user"]);
header("location: ../background-login.php");
?>