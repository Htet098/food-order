<?php include('partials/menu.php');?>

     <!-- main content section start -->
      <div class="main-content">
        <div class="wrapper">
           <h1>Manage food</h1>
           <br><br>

           <?php 
           if(isset($_SESSION['add']))
           {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
           }
           if(isset($_SESSION['delete']))
           {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
           }
           if(isset($_SESSION['upload']))
           {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
           }
           if(isset($_SESSION['unauthorize']))
           {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
           }
           if(isset($_SESSION['update']))
           {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
           }
           ?>
           <br><br><br>
           <a href="<?php echo SITEURL;?>Admin/add-food.php" class="btn-primary">ADD FOOD</a>
           <br><br><br>
          <table class="tbl-full">
            <tr>
               <th>S.N</th>
               <th>Title</th>
               <th>Price</th>
               <th>Image</th>
               <th>Featured</th>
               <th>Active</th>
               <th>Action</th>
            </tr>
            <?php 
            //Create sql query to get all the food
            $sql="SELECT * FROM tbl_food ";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //Count row to check whether we have foods or not
            $count=mysqli_num_rows($res);
            //create serial number variable and set default value as 
            $sn=1;

            if($count>0)
            {
               //we have food in data
               //get food from database and display
               while($row=mysqli_fetch_assoc($res))
               {
                  //get the value from individual data
                  $id=$row['id'];
                  $title=$row['title'];
                  $price=$row['price'];
                  $image_name=$row['image_name'];
                  $featured=$row['featured'];
                  $active=$row['active'];
                  ?>
                       <tr>
                          <td><?php echo $sn++;?></td> 
                          <td><?php echo $title;?></td> 
                          <td> <?php echo $price;?></td>
                          <td><?php 
                          //check whether we have image or not
                          if($image_name=="")
                          {
                           //we do not have image,display error message
                           echo "<div class='error'>Image Not Added</div>";

                          }
                          else
                          {
                           //we have image ,Display image
                           ?>
                           <img src="<?php echo SITEURL; ?>image/food/<?php echo $image_name; ?>" width="150px">
                           <?php
                          }
                          
                          ?></td>
                          <td><?php echo $featured;?></td>
                          <td><?php echo $active;?></td>
                          <td>
                             <a href="<?php echo SITEURL; ?>Admin/update-food.php?id=<?php echo$id;?>" class="btn-secondary">Update Food</a>
                             <a href="<?php echo SITEURL; ?>Admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Food</a>
                           </td>
                       </tr> 
                  <?php
               } 
            }
            else
            {
               //food do not add in database
               echo "<tr><td colspan='7' class='error'> Food Not Add Yet.</td></tr>";
            }
            ?>
            
            
            
          </table>
           <div class="clearfix"></div>
        </div>
    </div>
    <!-- main content section end -->

    <?php include('partials/footer.php') ?>