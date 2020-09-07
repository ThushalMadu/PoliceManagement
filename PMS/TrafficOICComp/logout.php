<?php

ob_start();
session_start();

unset($_SESSION['loggedintraffic']);
session_destroy();
echo '<script type="text/javascript">window.location="login.php"; </script>';
