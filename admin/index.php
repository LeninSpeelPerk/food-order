<?php include("partials/menu.php") ?>

<!-- Menu Content Section starts -->
<div class="main-content">
    <div class="wrapper">
        <h3>DASHBOARD</h3>

        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

        <div class="col-4 text-center">
            <?php
            //SQL query 
            $sql = "SELECT * FROM tbl_category";
            // Execute query
            $res = mysqli_query($conn, $sql);
            // Count rows
            $count = mysqli_num_rows($res);
            ?>
            <h3><?php echo $count; ?></h3>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <?php
            //SQL query 
            $sql2 = "SELECT * FROM tbl_food";
            // Execute query
            $res2 = mysqli_query($conn, $sql2);
            // Count rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h3><?php echo $count2; ?></h3>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">
            <?php
            //SQL query 
            $sql3 = "SELECT * FROM tbl_order";
            // Execute query
            $res3 = mysqli_query($conn, $sql3);
            // Count rows
            $count3 = mysqli_num_rows($res3);
            ?>
            <h3><?php echo $count3; ?></h3>
            <br>
            Total Orders
        </div>
        <div class="col-4 text-center">

            <?php
            // Create SQL query to get total revenue generated
            // Aggregate Function in sql
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";

            // Execute the Query
            $res4 = mysqli_query($conn, $sql4);

            // Get the value 
            $row4 = mysqli_fetch_assoc($res4);

            // Get the total revenue
            $total_revenue = $row4['Total'];

            ?>

            <h3>$<?php echo $total_revenue; ?></h3>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Menu Content Section Ends -->

<?php include("partials/footer.php") ?>