<?php   
    $db = mysqli_connect("localhost:3307", "root", "", "mall") or die(mysqli_error($db));

    session_start();

    $seller_id = $_SESSION['seller_id'];
    $seller_name =$_SESSION['seller_name'];

    $select = mysqli_query($db, "SELECT * FROM product WHERE seller_id = '".$seller_id."'")
                 or die(mysqli_error($db));

    $cat = array("Shirts", "Bottoms", "Accessories", "Footwear", "Combo");

    if(isset($_POST['filter'])) {

        if(empty($_POST['category'])) {
            $er['cat'] = "Select a Category";
        } else {
            $category = mysqli_real_escape_string($db, $_POST['category']);
        }

        $select = mysqli_query($db, "SELECT * FROM product WHERE category = '".$category."'
                                        AND seller_id = '".$seller_id."'")
                 or die(mysqli_error($db));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | View Product</title>
    
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <main class="dash">
        <?php include('side-bar.php'); ?>

        <section class="main">
            <div class="category">
                <form action="" method="post">
                    <select name="category"> <option value="">Select Category</option>
                    <?php foreach($cat as $cat) { ?>
                        <option value="<?php echo $cat ?>"><?php echo $cat ?></option>
                    <?php } ?>
                    </select>
                    <input type="submit" name="filter" value="Filter">
                </form>
            </div>

            <div class="view container">
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