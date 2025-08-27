<?php
    include('db/db_config.php');
    
    function authenticate () {
        if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
            header("location:seller_login.php");
        }
    }
?>