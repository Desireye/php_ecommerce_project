<?php
    unset($_SESSION['buyer_id']);
    unset($_SESSION['buyer_email']);

    $msg = "You've been logged out";
    header("location:buyer/buyer_signup.php?msg=$msg");
?>