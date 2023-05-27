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
    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset ($_SESSION['order']);
    }
    ?>

    <!--Categories  section start here -->
    <section class="categories text-center">
        <div class="container">
            <h2>Explore Food</h2>
                <?php
                  //CREATE SQL query to display category from database
                  $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";


                  //Execute the query
                  $res=mysqli_query($conn,$sql);

                  //count row to check whether the category is available or not
                  $count=mysqli_num_rows($res);
                  if($count>0)
                    {
                      //category available
                      while($row=mysqli_fetch_assoc($res))
                        {
                             //get the value like id ,title,image_name
                             $id=$row['id'];
                             $title=$row['title'];
                             $image_name=$row['image_name'];
                             ?>
                        
                             <a href="<?php echo SITEURL;?>categor-food.php?category_id=<?php echo $id; ?>">
                             <div class="box-3 float-container">
                                 <?php
                                 //check whether the image is available or not
                                 if($image_name=="")
                                 {
                                     //display the message
                                     echo "<div class='error'>Image is not available.</div>";
                                }
                                 else
                                 {
                                     //Image available
                                     ?>
                                      <img src="<?php echo SITEURL;?>image/category/<?php echo $image_name;?>" alt=" " class="img-responsive img-curve ">
                                     <?php
                                 }
                            
                                 ?>
                            
                                 <h3 class="float-text text-white "><?php echo $title; ?></h3>
                             </div>
                            </a>
                            <?php

                        }
                    }
                    else
                    {
                        //category not available
                    }
            ?>
            

            <div class="clearfix "></div>
        </div>
    </section>
    <!--Categories  section end here -->

    <!--Food menu section start here -->
    <section class="food-menu text-center">
        <div class="container ">
            <h2>Food Menu</h2>
            <?php
            //Getting food data from database that are active and featured 
            //SQL query
            $sql="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //count the row
            $count=mysqli_num_rows($res);
            //check whether food available or not
            if($count>0)
            {
                //image available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all data
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //check whether image available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not available.</div>";
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
                            <p class="food-detail"><?php echo $description; ?></p><br>
                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                }
            }
            else
            {
                //image not available
                echo "<div class='error'>Food Not Found.</div>";
            }
            ?>
            
            
            
            <p class="text-center">
                <a href="#">See All Food</a>
            </p>
            <div class="clearfix "></div>
        </div>
    </section>
    <!--Food menu section end here -->

    

   <?php include('partials-front/footer.php');?>