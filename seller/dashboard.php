<?php
    session_start();

    include('../auth.php');
    authenticate();
   
    $seller_id = $_SESSION['seller_id'];
    $seller_name =$_SESSION['seller_name'];

    $select = mysqli_query($db, "SELECT * FROM product WHERE seller_id = '".$seller_id."' 
                                ORDER BY date_created DESC LIMIT 6
                                ") or die(mysqli_error($db));
                               
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Dashboard</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main class="dash">
        <?php include('side-bar.php'); ?>

        <section class="main">
            <div class="menu">
                <div class="welcome">
                    <h1>Welcome, <?php echo $seller_name ?></h1>
                    <p>This is your personal space!</p>
                </div>

                <i class="fa-solid fa-cart-shopping" id="open-cart"></i>
            </div>
            <hr>

            <h2>Newly Added Products</h2>
            <div class="container">
                <?php while($r = mysqli_fetch_array($select)) { ?>
                <div class="product">
                    <div class="image">
                        <img src="img/<?php echo $r[6] ?>">
                        <span class="price badge">&#8358;<?php echo $r[5] ?></span>
                        <span class="cat badge"><a href=""><?php echo $r[2] ?></a></span>
                    </div>
                    <div class="desc">
                        <h4><?php echo $r[1] ?></h4>
                        <p><?php echo $r[4] ?></p>
                        <div class="change-btn">
                        <button class="edit btn"><a href="edit.php?id=<?php echo $r[0] ?>">Edit Product</a></button>
                        <button class="delete btn"><a href="delete.php?id=<?php echo $r[0] ?>">Remove Product</a></button>
                        </div>
                        <h5>Available Stock: <span><?php echo $r[7] ?></span> </h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
    <?php include('../footer.php') ?>
</body>
</html>


