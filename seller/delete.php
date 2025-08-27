<?php
    include('../db/db_config.php');;

    if(isset($_GET['id'])) {
    //     header("location:dashboard.php");
    // } else {
        $product_id = $_GET['id'];

        $delete = mysqli_query($db, "DELETE FROM product WHERE product_id = '".$product_id."'
                                ") or die(mysqli_error($db));

        $msg = "Product with ID $product_id has been deleted successfully";
        header("location:dashboard.php?msg=$msg");
    }
?>