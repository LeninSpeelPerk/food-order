<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Update Admin</h3>

        <br><br>

        <?php
        // 1.get the id of selected admin
        $id = $_GET['id'];

        // 2.Create sql query to get the details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query is executed or not
        if ($res == true) {
            // check whether the data is available or not
            $rows = mysqli_num_rows($res);
            // check whether we have admin data or not 
            if ($rows == 1) {
                // GET the details 
                // echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $user_name = $row['user_name'];
            } else {
                // redirect to manage admin page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $user_name ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

// Check whether the Submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "Button Clicked";
    // Get all the values from the form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];

    // Create a sql query to update admin
    $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                user_name = '$user_name' 
                WHERE id='$id'
        ";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not 
    if($res == true) {
        // Query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";

        // Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        // Failed to update admin
        $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";

        // Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>

<?php include('partials/footer.php'); ?>