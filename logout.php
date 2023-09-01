<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to a login or home page
header("Location: elogin.html"); // Replace with the appropriate URL
exit();
?>