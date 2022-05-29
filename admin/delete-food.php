<?php
// Include Constants page
include('../config/constants.php');
// echo "Delete Food Page";

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Process to delete 
    //   echo "Process to Delete";

    // 1. Get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove the Image if available
    // Check whether the image is available or not and Delete only if available
    if($image_name != "") {
        // IT has image and need to remove from folder
        // GEt the Image path
        $path = "../images/Food/".$image_name;

        // Remove image file from folder
        $remove = unlink($path);
        
        // Check Whether the image is removed or not
        if($remove ==  false) {
            // Failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
            // Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');

            // Stop the process of deleteing food
            die();
        }
    }
    
    
    // 3. Delete Food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed or not  
    if($res == true) {
        // Food Deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }else {
        // Failed to delete food        
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


    // 4. Redirect to manage food with session message
} else {
    //  Redirect to mange food page
    // echo "Redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
}
