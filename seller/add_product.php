<?php
    $db = mysqli_connect("localhost:3307", "root", "", "mall") or die(mysqli_error($db));
    
    session_start();
    $seller_id = $_SESSION['seller_id'];

    $cat = array("Shirts", "Bottoms", "Accessories", "Footwear", "Combo");

    if(isset($_POST['upload'])) {
        $er = array();
        $extension = array("image/png", "image/jpg", "image/jpeg", "image/webp");
        $default_size = 2097152;

        if(empty($_POST['pname'])) {
            $er['pname'] = "Enter your Product Name";
        } else {
            $pname = mysqli_real_escape_string($db, $_POST['pname']);
        }
        if(empty($_POST['cat'])) {
            $er['cat'] = "Select Product Category";
        } else {
            $category = mysqli_real_escape_string($db, $_POST['cat']);
        }
        if(empty($_POST['sex'])) {
            $er['sex'] = "Who is this item for?";
        } else {
            $sex = mysqli_real_escape_string($db, $_POST['sex']);
        }
        if(empty($_POST['desc'])) {
            $er['desc'] = "Enter Product Description";
        } else {
            $description = mysqli_real_escape_string($db, $_POST['desc']);
        }
        if(empty($_POST['price'])) {
            $er['price'] = "Enter Price";
        } else {
            $price = mysqli_real_escape_string($db, $_POST['price']);
        }
        if(empty($_POST['stock'])) {
            $er['stock'] = "How much stock is available?";
        } else {
            $stock = mysqli_real_escape_string($db, $_POST['stock']);
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
            
        if(empty($er)) {  
            $insert = mysqli_query($db, "INSERT INTO product VALUES(NULL,
                                                              '".$pname."',
                                                              '".$category."',
                                                              '".$sex."',
                                                              '".$description."',
                                                              '".$price."',
                                                              '".$filename."',
                                                              '".$stock."',
                                                              NOW(),
                                                              '".$seller_id."'
                                                               )") or die(mysqli_error($db));

          echo "<h4 style=\"color: green; text-align: center\">Upload Successful!</h4>";
        $msg = "Product has been successfully added to the marketplace!";
        header("location:dashboard.php?msg=$msg");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Add Product</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <main class="dash">
        <?php include('side-bar.php'); ?>

        <section class="main">
            <form action="" method="post" enctype="multipart/form-data" class="add-product">
                <h2>Add New Products!</h2>

                <p><input type="text" placeholder="Product Name" name="pname" value="<?php if(isset($pname)) echo $pname ?>">
                <span class="error"><?php if(isset($er['pname'])) echo $er['pname'] ?></span></p>

                <p><select name="cat" id=""> <option value="" name="">Select Category</option> 
                    <?php foreach($cat as $cat) { ?>
                        <option value="<?php echo $cat ?>" <?php if(isset($category) && $category == $cat) echo 'selected="selected"' ?>><?php echo $cat ?></option>
                    <?php } ?>
                    </select>
                    <span class="error"><?php if(isset($er['cat'])) echo $er['cat'] ?>
                </p>

                <p>Is the item targeted towards: Men <input type="radio" name="sex" value="1" <?php if(isset($sex) && $sex = "1") echo 'checked="checked"'?>>
                                                Women <input type="radio" name="sex" value="2" <?php if(isset($sex) && $sex = "2") echo 'checked="checked"' ?>>
                                                Neutral <input type="radio" name="sex" value="3" <?php if(isset($sex) && $sex = "3") echo 'checked="checked"' ?>>
                    <span class="error"><?php if(isset($er['sex'])) echo $er['sex'] ?></span>
                </p>

                <p><textarea name="desc" placeholder="Description" cols="30" rows="10"><?php if(isset($description)) echo $description ?></textarea>
                <span class="error"><?php if(isset($er['desc'])) echo $er['desc'] ?></span></p>

                <p><input type="number" placeholder="Price" name="price" value="<?php if(isset($price)) echo $price ?>">
                <span class="error"><?php if(isset($er['price'])) echo $er['price'] ?></span></p>

                <p>Product Image <input type="file" name="upload">
                <span class="error"><?php if(isset($er['img'])) echo $er['img'] ?></span>
                <span class="error"><?php if(isset($er['imgg'])) echo $er['imgg'] ?></span>
                <span class="error"><?php if(isset($er['imggg'])) echo $er['imggg'] ?></span>
                </p>
            
                <p><input type="number"  placeholder="Stock Available" name="stock" value="<?php if(isset($stock)) echo $stock ?>">
                <span class="error"><?php if(isset($er['stock'])) echo $er['stock'] ?></span>
                </p>

                <input type="submit" name="upload" value="Click to Upload">
            </form>
        </section>
    </main>
    <?php include('../footer.php') ?>
</body>
</html>