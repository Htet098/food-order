<?php include('partials-front/menu.php');?>

    <!-- Food search section start here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
             //GET THE SEARCH KEYWORD
             //$search=$_POST['search'];
             $search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            <h2>Food on your search
                <a href="categories.html" class="text-white">"<?php echo $search;?>"</a>
            </h2>
        </div>
    </section>
    <!-- Food search section end here -->
    <!--Food menu section start here -->
    <section class="food-menu text-center">
        <div class="container ">
            <h2>Food Menu</h2>
            <?php
           
            //sql query to get food based on search keyword
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute the query
            $res=mysqli_query($conn,$sql);
            //count the row
            $count=mysqli_num_rows($res);
            //check whether the food available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the detail
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                         <div class="food-menu-img">
                            <?php
                            //check whether the image name is available or not
                            if($image_name=="")
                            {
                                //image not available
                               echo" <div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL;?>image/food/<?php echo $image_name;?>" alt="" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                             
                         </div>
                         <div class="food-menu-desc text-left">
                             <h4><?php echo $title; ?></h4>
                             <p class="food-price"><?php echo $price; ?></p>
                             <p class="food-detail"><?php echo $description; ?></p><br>
                             <a href="order.html" class="btn btn-primary">Order Now</a>
                         </div>
                         <div class="clearfix"></div>
                    </div>
                    <?php
                }
            }
            else
            {
                //food not available
               echo "<div class='error'>Food Not Found.</div>";
            }
             ?>
            
            
            <div class="clearfix "></div>
        </div>
    </section>
    <!--Food menu section end here -->

    <?php include('partials-front/footer.php') ;?>