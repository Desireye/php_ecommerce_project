<?php
    $db = mysqli_connect("localhost:3307", "root", "", "mall") or die(mysqli_error($db));
    
    function authenticate () {
        if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
            header("location:seller_login.php");
        }
    }
?>