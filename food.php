<?php include('partials-front/menu.php');?>

    <!-- Food search section start here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for food">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Food search section end here -->

    <!--Food menu section start here -->
    <section class="food-menu text-center">
        <div class="container ">
            <h2>Food Menu</h2>
            <?php
            //Display food that are active
            $sql="SELECT * FROM tbl_food WHERE active='Yes'";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //count the row
            $count=mysqli_num_rows($res);
            //check whether the food are available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all data
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //check whether image available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo"<div class='error'>Image not available.</div>";
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
                echo"<div class='error'>Food Not Found.</div>";
            }
            ?>
            
           
            <div class="clearfix "></div>
        </div>
    </section>
    <!--Food menu section end here -->

    <?php include('partials-front/footer.php') ;?>