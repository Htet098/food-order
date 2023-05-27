<?php include('partials-front/menu.php');?>
        <?php
        if(isset($_GET['category_id']))
        {
            //category id is set and get the id
            $category_id=$_GET['category_id'];
            //GET THE category title based on category id
            $sql="SELECT title FROM tbl_category WHERE id=$category_id";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //get the value from database
            $row=mysqli_fetch_assoc($res);
            //get the title
            $category_title=$row['title'];
        }
        else
        {
            //category not passed
            //redirect to home page
            header('location:'.SITEURL);
        }
        ?>

    <!-- Food search section start here -->
    <section class="food-search text-center">
        <div class="container">
            <h2>Food on
                <a href="categories.html" class="text-white">"<?php echo $category_title;?>"</a>
            </h2>
        </div>
    </section>
    <!-- Food search section end here -->
    <!--Food menu section start here -->
    <section class="food-menu text-center">
        <div class="container ">
            <h2>Food Menu</h2>
            <?php
            //create sql query to get food based on selected category
            $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";
            //execute the query
            $res2=mysqli_query($conn,$sql2);
            //count the row
            $count2=mysqli_num_rows($res2);
            //check whether the food is available or not
            if($count2>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id=$row2['id'];
                    $title=$row2['title'];
                    $price=$row2['price'];
                    $description=$row2['description'];
                    $image_name=$row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if($image_name=="")
                            {
                                //image not available
                               echo "<div class='error'>Image Not Available.</div>";
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
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail"><?php echo $description;?></p><br>
                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php

                }
            }
            else
            {
                //food not available
                echo"<div class='error'>Food Not Available.</div>";
            }
            
            
            ?>
            
            
            <div class="clearfix "></div>
        </div>
    </section>
    <!--Food menu section end here -->

    <?php include('partials-front/footer.php') ;?>