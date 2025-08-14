<?php
    unset($_SESSION['seller_id']);
    unset($_SESSION['seller_name']);

    $msg = "You've been logged out";
    header("location:../index.php?msg=$msg");
?>