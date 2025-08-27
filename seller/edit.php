<?php
    include('../db/db_config.php');

     session_start();

     $seller_id = $_SESSION['seller_id'];
     $seller_name =$_SESSION['seller_name'];

     $cat = array("Shirts", "Bottoms", "Accessories", "Footwear", "Combo");
 
     $select = mysqli_query($db, "SELECT * FROM product WHERE product_id = '".$_GET['id']."' 
                                 ") or die(mysqli_error($db));
 
    $r = mysqli_fetch_array($select);
    $product_id = $_GET['id'];

    if(isset($_POST['edit'])){
        $err = array();

        $extension = array("image/png", "image/jpg", "image/jpeg", "image/webp");
        $default_size = 2097152;
  
        if(empty($_POST['pname'])) {
            $err['pname'] = "Enter your Product Name";
        } else {
            $pname = mysqli_real_escape_string($db, $_POST['pname']);
        }
        if(empty($_POST['desc'])) {
            $err['desc'] = "Enter Product Description";
        } else {
            $desc = mysqli_real_escape_string($db, $_POST['desc']);
        }
        if(empty($_POST['cat'])) {
            $err['cat'] = "Select Product Category";
        } else {
            $cat = mysqli_real_escape_string($db, $_POST['cat']);
        }
        if(empty($_POST['stock'])) {
            $err['stock'] = "How much stock is available?";
        } else {
            $stock = mysqli_real_escape_string($db, $_POST['stock']);
        }
        if(empty($_POST['sex'])) {
            $er['sex'] = "Who is this item for?";
        } else {
            $sex = mysqli_real_escape_string($db, $_POST['sex']);
        }
        if(empty($_POST['price'])) {
            $er['price'] = "Enter Price";
        } else {
            $price = mysqli_real_escape_string($db, $_POST['price']);
        }
        if(!in_array($_FILES['upload']['type'], $extension)) {
            $er['img'] = "This file is not acceptable";
        } elseif ($_FILES['upload']['size'] > $default_size) {
            $er['imgg'] = "Image file is too large. Maximum allowed size is".$default_size;
        } else {
            $filename = $_FILES['upload']['name'];
            $destination = "img/".$filename;

            if(!move_uploaded_file($_FILES['upload']['tmp_name'], $destination)) {
                $er['imggg'] = "File Not Successfully Added";
            }
        }


        if(empty($err)) {
            $insert = mysqli_query($db, "UPDATE product SET product_name = '".$pname."',
                                                            description = '".$desc."',
                                                            category = '".$cat."',
                                                            stock_available = '".$stock."',
                                                            gendered_items = '".$sex."',
                                                            price = '".$price."',
                                                            product_image = '".$filename."'
                                                            WHERE product_id= '".$product_id."'")
                    or die(mysqli_error($db));
        $msg = "Product has successfully been edited";
        header("location:dashboard.php?msg=$msg");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Edit Product</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="dash">
    <?php include('side-bar.php'); ?>

    <section class="main">       
        <form action="" method="post">
            <p>Product Name <br> <input type="text" name="pname"  value="<?php echo $r[1] ?>">
            <span class="error"><?php if(isset($er['pname'])) echo $er['pname'] ?></span></p>
        
            <p>Description <br> <textarea name="desc" cols="30" rows="10"><?php echo $r[4] ?></textarea>
            <span class="error"><?php if(isset($er['desc'])) echo $er['desc'] ?></span></p>

            <p>Category <br> <select name="cat" id=""> <option value="" name="">Select Category</option> 
                <?php foreach($cat as $cat) { ?>
                    <option value="<?php echo $cat ?>" <?php if(isset($cat) && $cat = $r[2]) 'selected="selected"' ?>><?php echo $cat ?></option>
                <?php } ?>
                </select>
                <span class="error"><?php if(isset($er['cat'])) echo $er['cat'] ?></span>
            </p>

            <p>Is the item targeted towards: <br> Men <input type="radio" name="sex" value="1" <?php if(isset($sex) && $sex = $r[3]) echo 'checked="checked"'?>>
                                                    Women <input type="radio" name="sex" value="2" <?php if(isset($sex) && $sex = $r[3]) echo 'checked="checked"' ?>>
                                                    Neutral <input type="radio" name="sex" value="3" <?php if(isset($sex) && $sex = $r[3]) echo 'checked="checked"' ?>>
                <span class="error"><?php if(isset($er['sex'])) echo $er['sex'] ?></span>
            </p>

            <p>Price <br> <input type="number" name="price" value="<?php echo $r[5] ?>">
            <span class="error"><?php if(isset($er['price'])) echo $er['price'] ?></span></p>

            <p>Product Image <br> <input type="file" name="upload">
                    <span class="error"><?php if(isset($er['img'])) echo $er['img'] ?></span>
                    <span class="error"><?php if(isset($er['imgg'])) echo $er['imgg'] ?></span>
                    <span class="error"><?php if(isset($er['imggg'])) echo $er['imggg'] ?></span>
            </p>

            <p>Stock <br> <input type="text" name="stock"  value="<?php echo $r[7] ?>">
            <span class="error"><?php if(isset($er['stock'])) echo $er['stock'] ?></span></p>

            <input type="submit" name="edit" value="Edit">
        </form>
    </section>
</body>
</html>
