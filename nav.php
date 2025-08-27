<?php 
    include('db/db_config.php'); 
?>

<nav class="links">
        <h1><a href="index.php">THRIFTALL</a></h1>
        <ul>
            <li><a href="all_products.php">New Arrivals</a></li>
            <li><a href="display.php?gi=1">Men <i class="fas fa-chevron-down"></i></a> 
                <ul class="dropdown">
                    <li><a href="display.phpgi=1">Clothing</a></li>
                    <li><a href="#">Slides</a></li>
                    <li><a href="#">Bags</a></li>
                    <li><a href="#">Accessories</a></li>
                </ul>
            </li>           
            <li><a href="display.php?gi=2">Women<i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="#">Tops</a></li>
                    <li><a href="#">Shorts&Skirts</a></li>
                    <li><a href="#">Dresses</a></li>
                    <li><a href="#">Bags</a></li>
                </ul>
            </li>
            <li><a href="display2.php?cat=Accessories">Accessories</a></li>
            <li><a href="display2.php?cat=Footwear">Footwear</a></li>
            <li><a href="all_products.php">THRIFTALL.com</a></li>
        </ul>
        <div class="nav-btn">
            <a href="buyer/buyer_login.php">Login</a>
            <a href="buyer/buyer_signup.php">Sign Up</a>
            <a href="logoutb.php">Log Out</a>
        </div>
    </nav>