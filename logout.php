<?php
session_start();
unset($_SESSION['email']);
session_unset();
session_destroy();
echo "<script>window.location.href='index.php';</script>";
