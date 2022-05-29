<?php include("partials/menu.php") ?>

<!-- Menu Content Section starts -->
<div class="main-content">
    <div class="wrapper">
        <h3>Manage Admin</h3>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //Removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']); //Removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']); //Removing session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']); //Removing session message
        }
        if (isset($_SESSION['pwd-not-found'])) {
            echo $_SESSION['pwd-not-found'];
            unset($_SESSION['pwd-not-found']); //Removing session message
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']); //Removing session message
        }
        ?>

        <br><br>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            // Execute the query
            $res = mysqli_query($conn, $sql);

            $sn = 1; //Create a variable and assign the value 

            // check whether the query is executed or not
            if ($res == TRUE) {
                // Count rows to check whether we have data in database or not 
                $rows = mysqli_num_rows($res);

                //  Check the num of rows
                if ($rows > 0) {
                    // we have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // using while loop to get all the data in a database
                        // and while loop will wxecute as long we have data in a database

                        // Get individual data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $user_name = $rows['user_name'];

                        // display the values in our table 
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    // We do not have data in database

                }
            }
            ?>

        </table>
    </div>
</div>
<!-- Menu Content Section Ends -->

<?php include("partials/footer.php") ?>
</body>

</html>