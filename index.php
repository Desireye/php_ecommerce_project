<?php 
    $db = mysqli_connect("localhost:3307", "root", "", "mall") or die(mysqli_error($db));

    $select = mysqli_query($db, "SELECT * FROM product ORDER BY date_created DESC LIMIT 4") or die(mysqli_error($db));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>ThriftAll | The Thrift store</title>
</head>
<body>
    <div class="welcome-banner">
        Welcome to <span style="font-family: Impact;">ThriftAll, Customer</span> 
    </div>

    <?php include('nav.php') ?>

    <section class="bag-banner">
        <div class="bag-banner-text">
            <h2>THRIFTALL</h2>
            <p>Gucci leather bag</p><br>
            <a href="#" class="btn">Shop Now <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </section>

    <div class="main-container">
        <a href="all_products.php" class="all">
            <div class="new">
                <h1>New Arrivals<i class="fa-solid fa-arrow-right"></i></h1>
                <div class="arrivals">
                    <?php while($result = mysqli_fetch_array($select)) { ?>
                    <div class="product">
                        <div class="image">
                            <img src="seller/img/<?php echo $result[6] ?>">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </a>

        <h1>Collections</h1>
        <div class="men">           
            <div class="men-content">
                <div class="avatar a"><div class="layer"><a href="display.php?gi=1" class="btn">Shop Now </a></div></div>
                <div class="avatar b"><div class="layer"><a href="display.php?gi=1" class="btn">Shop Now </a></div></div>
                <div class="avatar c"><div class="layer"><a href="display.php?gi=1" class="btn">Shop Now </a></div></div>
                <div class="avatar d"><div class="layer"><a href="display.php?gi=1" class="btn">Shop Now </a></div></div> 
            </div>
            <h2>Men<i class="fa-solid fa-arrow-right"></i></h2>
        </div>

        <div class="women">
            <div class="women-content">
                <div class="avatar e"><div class="layer"><a href="display.php?gi=2" class="btn">Shop Now </a></div></div>
                <div class="avatar f"><div class="layer"><a href="display.php?gi=2" class="btn">Shop Now </a></div></div>
                <div class="avatar g"><div class="layer"><a href="display.php?gi=2" class="btn">Shop Now </a></div></div>
                <div class="avatar h"><div class="layer"><a href="display.php?gi=2" class="btn">Shop Now </a></div></div>
            </div>
            <h2>Women<i class="fa-solid fa-arrow-right"></i></h2>
        </div>
        
        <div class="accessories">
            <div class="acc-content">
                <div class="avatar i"><div class="layer"><a href="display2.php?cat=Accessories" class="btn">Shop Now </a></div></div>
                <div class="avatar j"><div class="layer"><a href="display2.php?cat=Accessories" class="btn">Shop Now </a></div></div>
                <div class="avatar k"><div class="layer"><a href="display2.php?cat=Accessories" class="btn">Shop Now </a></div></div>
                <div class="avatar l"><div class="layer"><a href="display2.php?cat=Accessories" class="btn">Shop Now </a></div></div>
            </div>
            <h2>Accessories<i class="fa-solid fa-arrow-right"></i></h2>
        </div>

        <div class="footwear">
            <div class="foot-content">
                <div class="avatar m"><div class="layer"><a href="display2.php?cat=Footwear" class="btn">Shop Now </a></div></div> 
                <div class="avatar n"><div class="layer"><a href="display2.php?cat=Footwear" class="btn">Shop Now </a></div></div>
                <div class="avatar o"><div class="layer"><a href="display2.php?cat=Footwear" class="btn">Shop Now </a></div></div>
                <div class="avatar p"><div class="layer"><a href="display2.php?cat=Footwear" class="btn">Shop Now </a></div></div>  
            </div>
            <h2>Footwear<i class="fa-solid fa-arrow-right"></i></h2>
        </div>
    </div>
    
    <div class="banner2">
            <p>Are you interested in being a seller?
            <a href="seller/seller_signup.php">Click here</a> to create an account or
            <a href="seller/seller_login.php">click here</a> to login</p>
    </div>

    <?php include('footer.php') ?>
</body>
</html>