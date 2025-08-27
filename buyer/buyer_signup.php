<?php
    include('../db/db_config.php');

    $pay = array("Cash", "Bank Transfer", "Debit Transfer", "Crypto Currency");

    if(isset($_POST['submit'])) {
        if(empty($_POST['fn'])) {
            $er['fn'] = "Enter your First Name";
        } else {
            $fname = mysqli_real_escape_string($db, $_POST['fn']);
        }
        if(empty($_POST['ln'])) {
            $er['ln'] = "Enter your Last Name";
        } else {
            $lname = mysqli_real_escape_string($db, $_POST['ln']);
        }
        if(empty($_POST['email'])) {
            $er['email'] = "Enter your E-mail";
        } else {
            $email = mysqli_real_escape_string($db, $_POST['email']);
        }
        if(empty($_POST['address'])) {
            $er['address'] = "Enter your Address";
        } else {
            $address = mysqli_real_escape_string($db, $_POST['address']);
        }
        if(empty($_POST['pnumber'])) {
            $er['pnumber'] = "Enter your Phone Number";
        } else {
            $phone_number = mysqli_real_escape_string($db, $_POST['pnumber']);
        }
        if(empty($_POST['pword'])) {
            $er['pword'] = "Enter your Password";
        } else {
            $pword = mysqli_real_escape_string($db, $_POST['pword']);
        }
        if(empty($_POST['pmethod'])) {
            $er['pmethod'] = "Select your Payment Method";
        } else {
            $payment_method = mysqli_real_escape_string($db, $_POST['pmethod']);
        }
        if(empty($_POST['acc_num'])) {
            $er['acc_num'] = "Enter your Account Number";
        } else {
            $account_number = mysqli_real_escape_string($db, $_POST['acc_num']);
        }

        
        if(empty($er)) {

            $select = mysqli_query($db, "SELECT * FROM buyer WHERE email = '".$email."'")
            or die(mysqli_error($db));

            if(mysqli_num_rows($select) > 0) {
                $msg = "This email address is in use. Please provide another";
                header("location:buyer_login.php?msg=$msg");
            } else {
                $insert = mysqli_query($db, "INSERT INTO buyer VALUES(NULL,
                                                                  '".$fname."',
                                                                  '".$lname."',
                                                                  '".$email."',
                                                                  '".$address."',
                                                                  '".$phone_number."',
                                                                  '".$pword."',
                                                                '".$payment_method."',
                                                                '".$account_number."'
                                                                   )")
              or die(mysqli_error($db));
              echo "<h4>Registration Successful. Proceed to Login</h4>";    
              header("location:../index.php");
              }

        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Sign Up</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="banner">
    <div class="signup">
        <h3>Customer Registration Form</h3>
        <p>Please fill the form fields below</p>

        <form action="" method="post" class="buyer">

            <p><input type="text" name="fn" placeholder="First Name" value="<?php if(isset($fn)) echo $fn ?>">
            <span class="error"><?php if(isset($er['fn'])) echo $er['fn'] ?></span></p>

            <p><input type="text" name="ln" placeholder="Last Name" <?php if(isset($ln)) echo $ln ?>>
            <span class="error"><?php if(isset($er['ln'])) echo $er['ln'] ?></span></p>

            <p><input type="email" name="email" placeholder="E-mail"  <?php if(isset($email)) echo $email ?>>
            <span class="error"><?php if(isset($er['email'])) echo $er['email'] ?></span></p>
                
            <p><input type="tel" name="pnumber" placeholder="Phone Number" <?php if(isset($phone_number)) echo $phone_number ?>> 
            <span class="error"><?php if(isset($er['pnumber'])) echo $er['pnumber'] ?></span></p> 
                
            <p><input type="password" name="pword" placeholder="Password" <?php if(isset($pword)) echo $pword ?>>
            <span class="error"><?php if(isset($er['pword'])) echo $er['pword'] ?></span></p>
                
            <p><select name="pmethod"> <option value="">Select Payment Method</option>
                <?php foreach($pay as $pay) { ?>
                    <option value="<?php echo $pay ?>" <?php if(isset($payment_method) && $payment_method == $pay) echo 'selected="selected"' ?>><?php echo $pay ?></option>
                <?php } ?>
                </select>
                <span class="error"><?php if(isset($er['pmethod'])) echo $er['pmethod'] ?></span>
            </p>
                
            <p><input type="number" name="acc_num" placeholder="Account Number" <?php if(isset($account_number)) echo $account_number ?>>
            <span class="error"><?php if(isset($er['acc_num'])) echo $er['acc_num'] ?></span></p>
                      
            <p><textarea name="address" placeholder="Address" cols="30" rows="5"><?php if(isset($address)) echo $address ?></textarea>
            <span class="error"><?php if(isset($er['address'])) echo $er['address'] ?></span></p>

            <input type="submit" name="submit" value="Sign Up">

            <h5>Already have an account? <a href="buyer_login.php">Log In</a></h5>
        </form>
    </div>
    <div class="banner2">
            <p>Are you interested in being a seller?
            <a href="../seller/seller_signup.php">Click here</a> to create an account or
            <a href="../seller/seller_login.php">click here</a> to login</p>
    </div>
</body>
</html>