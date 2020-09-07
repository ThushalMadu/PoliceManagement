<?php

ob_start();
session_start();

unset($_SESSION['email']);
unset($_SESSION['loggedindriver']);
session_destroy();
echo '<script type="text/javascript">window.location="index.php"; </script>';
