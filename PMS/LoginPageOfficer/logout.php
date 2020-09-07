<?php
ob_start();
session_start();
// remove all session variables
session_unset();
unset($_SESSION['loggedinofficer']);

// destroy the session
session_destroy();
echo '<script type="text/javascript">window.location="http://localhost/PMS/"; </script>';
