<?php
    session_start();
    session_unset();
    session_destroy();
    // echo "<script>alert('Logout Sucess')</script>";
    header("Location: home.php");
?>