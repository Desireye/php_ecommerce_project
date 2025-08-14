<?php
    session_start();
    $db = mysqli_connect("localhost:3307", "root", "", "mall") or die(mysqli_error($db));

    if(isset($_POST['submit'])) {

        if(empty($_POST['email'])) {
            $er['email'] = "Enter your E-mail"; 
            } else {
                $email = mysqli_real_escape_string($db, $_POST['email']);
            }
            if(empty($_POST['pword'])) {
                $er['pword'] = "Enter your Password";
            } else {
                $pword = mysqli_real_escape_string($db, $_POST['pword']);
            }
           
        if(empty($er)) {
            $select = mysqli_query($db, "SELECT * FROM buyer WHERE email = '".$email."' 
                                                    AND password = '".$pword."'")
                                                    or die(mysqli_error($db));

            if(mysqli_num_rows($select) == 1) {
                $r = mysqli_fetch_array($select);
                $_SESSION['buyer_id'] = $r[0];
                $_SESSION['buyer_email'] = $r[3];

                header("location:../index.php");
            } else {
                    $msg = "Invalid Username and/or Password";
                    header("location:buyer_login.php?msg=$msg");
                }
         }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Log In</title>
    <link rel="stylesheet" href="../styles/style.css">
    
</head>
<body class="banner">
        <div class="login buyer2">
            <h3>Welcome back, Dear Customer!</h3>
            <p>Please enter your E-mail and Password</p>

            <form action="" method="post">
                <p> <input type="email" name="email" placeholder="Email">
                <span class="error"><?php if(isset($er['email'])) echo $er['email'] ?></span></p>

                <p> <input type="password" name="pword" placeholder="Password">
                <span class="error"><?php if(isset($er['pword'])) echo $er['pword'] ?></span></p>

                <input type="submit" name="submit" value="Click to Login">

                <h5>Don't have an account? <a href="buyer_signup.php">Sign Up!</a></h5>
            </form>
        </div>
    <div class="banner2">
        <p>Are you interested in being a seller?
        <a href="../seller/seller_signup.php">Click here</a> to create an account or
        <a href="../seller/seller_login.php">click here</a> to login</p>
    </div>
</body>
</html>