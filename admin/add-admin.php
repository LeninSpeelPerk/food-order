<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add Admin</h3>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username" required></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your password" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php
// process the value from form and save it in database
//  check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    //  Button Clicked 
    // echo "Button Clicked";

    // 1.Get the data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password'])); //Password Encryption md5

    // 2.sql query to save the data into database
    $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$password'
            ";

    // Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // 4.check whether the query is executed datais inserted or not and display appropriate message;
    if($res == TRUE){
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";

        // Redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

    }else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";

        // Redirect page to Add admin
        header("location:".SITEURL.'admin/add-admin.php');

    }
}
?>