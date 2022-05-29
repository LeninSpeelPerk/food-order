<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="login">
        <h3 class="text-center">Login</h3>
        <br><br>

        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }            
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

        ?>

        <br><br>

        <!-- Login Form Starts here -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>
        <!-- Login Form Ends here -->

        <p  class="text-center">Created By - <a href="www.leninspeelperk.com">Lenin Speel Perk</a></p>
    </div>

</body>

</html>

<?php 

    // CHeck whether the submit button is clicked or not
    if(isset($_POST['submit'])) {
        //  Process for login
        // 1.Get the data from login form

        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn , $_POST['username']);
        $password = mysqli_real_escape_string($conn , md5($_POST['password']));

        // 2.SQL to check whether the user with username and password exit or not 
        $sql = "SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'";

        // 3. Execute the query 
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exist or not 
        $count = mysqli_num_rows($res);

        if($count == 1) {
            // User Available
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check the user is logged in or not and logout will unset it

            // redirect to home page / dashboard
            header('location:'.SITEURL.'admin/');
        }else{
            // User not Available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // redirect to home page / dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>