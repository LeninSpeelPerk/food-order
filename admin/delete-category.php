<?php 

    // Include consants file
    include('../config/constants.php');

    // echo "Delete Page";
    // Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Get the value else delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file is available 
        if($image_name != "")
        {
            // image is available. so remove it 
            $path = "../images/Category/".$image_name;
            // remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove == false) {
                // Set the session message 
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }
        // Delete data from tha database 
        // sql query Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data is delete from database or not
        if($res == true) {
            // Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            // Redirect to Manage category 
            header('location:'.SITEURL.'admin/manage-category.php');
        }else {
            // Set fail message and redirect?
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            // Redirect to Manage category 
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // Redirect to manage category page with message

    }  else {
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>