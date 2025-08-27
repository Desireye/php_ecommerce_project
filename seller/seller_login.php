<?php
   session_start();
   include('../db/db_config.php');

    if(isset($_POST['login'])) {
        if(empty($_POST['email'])) {
            $err['email'] = "Please enter your email";
        } else {
           $email = mysqli_real_escape_string($db, $_POST['email']);
        }
        if(empty($_POST['password'])) {
            $err['password'] = "Please enter your password";
        } else {
           $password = mysqli_real_escape_string($db, $_POST['password']);
        }

        if(empty($err)) {
            //echo "<h4 style:\"color: white\">Success!</h4>";
             $select = mysqli_query($db, "SELECT * FROM seller WHERE email = '".$email."'
                                                         AND password = '".$password."'
                                                             ") or die(mysqli_error($db));
            
            if(mysqli_num_rows($select) == 1) {
                $r = mysqli_fetch_array($select);
                $_SESSION['seller_id'] = $r[0];
                $_SESSION['seller_name'] = $r[1];

                header("location:dashboard.php");
            } else{
                $msg = "Invalid e-mail and/or password. Please try again";
                header("location:seller_login.php?msg=$msg");
            }
        } 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftAll | Merchant Log In</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="banner">
    <div class="login seller">
        <h3>Welcome Back!</h3>
        <form action="" method="post">
            <p><input type="email" placeholder="E-mail" name="email" value="<?php if(isset($email)) echo $email ?>">
            <span class="error"><?php if(isset($err['email'])) echo $err['email'] ?></span></p>

            <p><input type="password" placeholder="Password" name="password">
            <span class="error"><?php if(isset($err['password'])) echo $err['password'] ?></span></p>

            <input type="submit" name="login" value="Log In">
        </form>
        <h5>Don't have an account? <a href="seller_signup.php">Sign Up!</a></h5>
    </div>
</body>
</html>