<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add Food</h3>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl_30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" required>
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food." ></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            // Create php code to display  categories from database
                            // 1. Create sql to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                            // Execeuting Query
                            $res = mysqli_query($conn, $sql);

                            // Count rows to check wheteher we have categories or not
                            $count  = mysqli_num_rows($res);

                            // If count is greater than zero, we have categories we do not have categoriies
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // Get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                //  We do not have categories
                                ?>
                                <option value="0">No category found</option>
                            <?php
                            }

                            // 2. Display on dropdown
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        // CHeck whethher the buttonis clicked or not
        if (isset($_POST['submit'])) {
            // Add the food in database
            // echo "Add Food";

            // 1.Get the data from form
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            // Check whether radio button featured and active are checked or not
            if (isset($_POST['featured'])) {
                $featured = mysqli_real_escape_string($conn, $_POST['featured']);
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = mysqli_real_escape_string($conn, $_POST['active']);
            } else {
                $active = "No";
            }

            // 2. Upload the image if selected 
            // Check whether the select image is clicked or not and upload the image only if the image is selected 
            if (isset($_FILES['image']['name'])) {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // Check whether the image is selected or not and upload image only if selected
                if ($image_name != "") {
                    // Image is selected 
                    // A. Rename the image 
                    // Get the extension of selected image (jpg, png, gif, etc.)
                    $image_info = explode('.', $image_name);
                    $ext = end($image_info);

                    // Create New Name for image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; //New image name may be "Food-Name-654.jpg";

                    // B. Upload the image 
                    // Get the source path and destination path

                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded
                    $dst = "../images/Food/" . $image_name;

                    // Finally uplad the food image
                    $upload = move_uploaded_file($src, $dst);

                    // Check whether the image uploaded or not
                    if ($upload == false) {
                        // Failed to upload the image
                        // Redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        // Stop the process
                        die();
                    }
                }
            } else {
                $image_name = "";  //setting default value as blank
            }

            // 3.Insert into database

            // Create a SQL Query to save or Add Food
            // For numberical value we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);
            // Checl whether data inserted or not

            // 4. Redirect with message to manage food page 
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Failed to insert Data 
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>