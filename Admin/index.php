<?php include('partials/menu.php');?>

     <!-- main content section start -->
      <div class="main-content">
        <div class="wrapper">
           <h1>Dashboard</h1>
           <br><br>
            <?php

                if(isset($_SESSION['login']))
                {
                  echo $_SESSION['login'];//display session message
                  unset($_SESSION['login']);//remove session message
                }

            ?>
           <div class="col-4 text-center">
            <?php
            //sql query
            $sql="SELECT * FROM tbl_category ";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //count the row
            $count=mysqli_num_rows($res);
            ?>
              <h2><?php echo $count;?></h2>
              <br>
              <p>Categories</p>
           </div>


           <div class="col-4 text-center">
               <?php
            //sql query
            $sql2="SELECT * FROM tbl_food ";
            //execute the query
            $res2=mysqli_query($conn,$sql2);
            //count the row
            $count2=mysqli_num_rows($res2);
            ?>
              <h2><?php echo $count2;?></h2>
              <br>
              <p>Foods</p>
           </div>


           <div class="col-4 text-center">
           <?php
            //sql query
            $sql3="SELECT * FROM tbl_order ";
            //execute the query
            $res3=mysqli_query($conn,$sql3);
            //count the row
            $count3=mysqli_num_rows($res3);
            ?>
              <h2><?php echo $count3;?></h2>
              <br>
              <p>Total Orders</p>
           </div>


           <div class="col-4 text-center">
               <?php
            //create sql query to get total revenue generate
            $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";
            //execute the query
            $res4=mysqli_query($conn,$sql4);
            //get the value
            $row4=mysqli_fetch_assoc($res4);
            //get the total revenue
            $total_revenue=$row4['Total'];
            ?>
              <h2><?php echo $total_revenue;?></h2>
              <br>
              <p>Revenue Generated</p>
           </div>
           
           <div class="clearfix"></div>
        </div>
    </div>
    <!-- main content section end -->

    <?php include('partials/footer.php') ?>