<?php

session_start();

unset($_SESSION["user_id"]);

unset($_SESSION["user_role"]);

header("location:login.php");
?>