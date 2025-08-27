<?php
    include('db/db_config.php');

    session_start();

    $gendered_items = $_GET['gi'];

    $select = mysqli_query($db, "SELECT * FROM product WHERE gendered_items = '".$gendered_items."'") or die(mysqli_error($db));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include('nav.php') ?>
    <div class="display container">
        <?php while($result = mysqli_fetch_array($select)) { ?>
            <div class="product">
                <div class="image">
                    <img src="seller/img/<?php echo $result[6] ?>">
                    <span class="price badge">&#8358;<?php echo $result[5] ?></span>
                    <span class="cat badge"><a href=""><?php echo $result[2] ?></a></span>
                </div>
                <div class="desc">
                    <h4><?php echo $result[1] ?></h4>
                    <div class="desc-text">
                        <p><?php echo $result[4] ?></p>
                    </div>

                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $result[0]; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $result[1]; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $result[5]; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $result[6]; ?>">
                        <input type="hidden" name="product_stock" value="<?php echo $result[7]; ?>">

                        <div class="below">
                            <h5>Available Stock: <span><?php echo $result[7] ?></span> </h5>
                            <input type="text" name="buy" value="1" class="quantity">
                            <button type="submit" name="add" class="add-to-cart">Add to Cart</button>
                        </div>
                        </form>
                </div>
            </div>
                <?php } ?>
    </div>
    <?php include('footer.php') ?>
</body>
</html>