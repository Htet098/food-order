<?php include('partials-front/menu.php');?>
    <!--Categories  section start here -->
    <section class="categories text-center">
        <div class="container">
            <h2>Explore Food</h2>
            <?php
            //Display all the category that are active
            //Sql query
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";

            //execute the query
            $res=mysqli_query($conn,$sql);
            //count the rows
            $count=mysqli_num_rows($res);

            //Check whether category available or not
            if($count>0){
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL;?>categor-food.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            if($image_name=="")
                            {
                                //Image not available
                                echo "<div class='error'>Image Not Found.</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name;?>" alt=" " class="img-responsive img-curve ">
                                <?php
                            }
                            
                            ?>
                        
                        <h3 class="float-text text-white "><?php echo $title;?></h3>
                        </div>
                   </a>
                    <?php
                }
            
            }
            else
            {
                //category not available
                echo "<div class='error'>Category Not Found.</div>";
            }

            ?>
            
           
            <div class="clearfix "></div>
        </div>
    </section>
    <!--Categories  section end here -->
    <?php include('partials-front/footer.php') ;?>