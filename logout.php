<?php

require './helpers/functions.php';
session_start();
session_destroy();
header("Location: login.php");
?>