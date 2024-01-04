<?php
session_start();
session_unset();
session_destroy();

header("location: login.php");

exit;

require 'backend-php/db-credentials.php';
?>