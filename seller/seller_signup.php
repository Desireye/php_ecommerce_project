<?php
    include('../db/db_config.php');

    session_start();

    if(isset($_POST['signup'])) {
        $err = array();

        if(empty($_POST['fn'])) {
            $err['fn'] = "Please enter your first name";
        } else {
           $fn = mysqli_real_escape_string($db, $_POST['fn']);
        }
        if(empty($_POST['ln'])) {
            $err['ln'] = "Please enter your last name";
        } else {
           $ln = mysqli_real_escape_string($db, $_POST['ln']);
        }
        if(empty($_POST['email'])) {
            $err['email'] = "Please enter your email address";
        } else {
           $email = mysqli_real_escape_string($db, $_POST['email']);
        }
        if(empty($_POST['address'])) {
            $err['address'] = "Please enter your address";
        } else {
           $address = mysqli_real_escape_string($db, $_POST['address']);
        }
        if(empty($_POST['payment'])) {
            $err['payment'] = "Please enter your preferred payment method";
        } else {
           $payment = mysqli_real_escape_string($db, $_POST['payment']);
        }
        if(empty($_POST['card_num'])) {
            $err['card'] = "Please enter your card number";
        } else {
           $card_number = mysqli_real_escape_string($db, $_POST['card_num']);
        }
        if(empty($_POST['password'])) {
            $err['password'] = "Please enter your password";
        } else {
           $password = mysqli_real_escape_string($db, $_POST['password']);
        }

        if(empty($err)) {
            $insert = mysqli_query($db, "INSERT INTO seller VALUES(NULL,
                                                                '".$fn."',
                                                                '".$ln."',
                                                                '".$email."',
                                                                '".$address."',
                                                                '".$payment."',
                                                                '".$card_number."',
                                                                '".$password."'
                                                                )") or die (mysqli_error($db));
            echo "<h4 style:\"color: white\">Success!</h4>";
            header("location:seller_login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Merchant Sign Up</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="banner">   
    <div class="signup seller2">
        <h3>Sign Up to become a Thrifters merchant!</h3>
        <form action="" method="post" class="buyer">
            <p><input type="text" placeholder="First Name" name="fn" value="<?php if(isset($fn)) echo $fn ?>">
            <span class="error"><?php if(isset($err['fn'])) echo $err['fn'] ?></span></p>

            <p><input type="text" placeholder="Last Name" name="ln" value="<?php if(isset($ln)) echo $ln ?>">
            <span class="error"><?php if(isset($err['ln'])) echo $err['ln'] ?></span></p>

            <p><input type="email" placeholder="E-mail" name="email" value="<?php if(isset($email)) echo $email ?>">
            <span class="error"><?php if(isset($err['email'])) echo $err['email'] ?></span></p>

            <p><textarea name="address" placeholder="Address" cols="30" rows="3"><?php if(isset($address)) echo $address ?></textarea>
            <span class="error"><?php if(isset($err['address'])) echo $err['address'] ?></span></p>

            <p class="radio">Preferred Payment Method: <br> Card <input type="radio" name="payment" value="Card" <?php if(isset($payment) && $payment == "Card") echo 'checked="checked"' ?>>
                                    <br> Wire Transfer <input type="radio" name="payment" value="Transfer" <?php if(isset($payment) && $payment == "Transfer") echo 'checked="checked"'?>>
                                    <br> Crypto Currency <input type="radio" name="payment" value="Crypto" <?php if(isset($payment) && $payment == "Crypto") echo 'checked="checked"'?>>
            <span class="error"><?php if(isset($err['payment'])) echo $err['payment'] ?></span></p>

            <p><input type="number" placeholder="Card Number" name="card_num" value="<?php if(isset($card_number)) echo $card_number ?>">
            <span class="error"><?php if(isset($err['card'])) echo $err['card'] ?></span></p>

            <p><input type="password" placeholder="Password" name="password" value="<?php if(isset($password)) echo $password ?>">
            <span class="error"><?php if(isset($err['password'])) echo $err['password'] ?></span></p>

            <input type="submit" name="signup" value="Sign Up">
            <h5>Already have an account? <a href="seller_login.php">Log In</a></h5>
        </form>
</div>
</body>
</html>
