<?php include('partials/menu.php');?>

     <!-- main content section start -->
      <div class="main-content">
        <div class="wrapper">
           <h1>Manage admin </h1>
           <br><br>

           <?php 
           if(isset($_SESSION['add']))
           {
            echo $_SESSION['add'];//display session message
            unset( $_SESSION['add']);//removing session message
           } 

           if(isset($_SESSION['delete']))
           {
            echo $_SESSION['delete'];//display session message
            unset( $_SESSION['delete']);//removing session message
           } 

           if(isset($_SESSION['update']))
           {
            echo $_SESSION['update'];//display session message
            unset( $_SESSION['update']);//removing session message
           } 
           if(isset($_SESSION['user-not-found']))
           {
            echo $_SESSION['user-not-found']; //display session message
            unset( $_SESSION['user-not-found']);//removing session message
           }
           if(isset($_SESSION['pwd-not-match']))
           {
            echo $_SESSION['pwd-not-match']; //display session message
            unset( $_SESSION['pwd-not-match']);//removing session message
           }
           if(isset($_SESSION['change-pwd']))
           {
            echo $_SESSION['change-pwd']; //display session message
            unset( $_SESSION['change-pwd']);//removing session message
           } 
           ?> <br><br><br>

           <a href="add-admin.php" class="btn-primary">ADD ADMIN</a>
           <br><br><br>

           
          <table class="tbl-full">
            <tr>
               <th>S.N</th>
               <th>Full Name</th>
               <th>User Name</th>
               <th>Action</th>
            </tr>
            <?php
            //query to get all admin 
            $sql="SELECT * FROM tbl_admin";
            //execute the query
            $res=mysqli_query($conn,$sql);
            // check whether the query is executed of not
            if($res==TRUE){

               //count row to check whether we have data in database or not
               $count= mysqli_num_rows($res);//function to get all the rows in database
               $sn=1;//Create a variable and assign the value

               //check the number of rows
               if($count>0){
                  //we have data in database
                  while($rows=mysqli_fetch_assoc($res)){
                     //using while loop to get all the data from database
                     //And while loop will run as loop as we have data in database

                     //get individual data
                     $id=$rows['id'];
                     $full_name=$rows['full_name'];
                     $username=$rows['username'];
                     //display the value in our table
                     ?>
                       <tr>
                         <td><?php echo $sn++;?></td> 
                         <td><?php echo $full_name; ?></td> 
                         <td><?php echo $username; ?></td>
                         <td>
                           <a href="<?php  echo SITEURL ?>Admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary"> Change Password</a>
                            <a href="<?php  echo SITEURL ?>Admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php  echo SITEURL ?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                         </td>
                       </tr>
                     <?php

                  }
               }else{
                   // we do not have data in database
               }
            } 
            
            ?>
            
          </table>
           <div class="clearfix"></div>
        </div>
    </div>
    <!-- main content section end -->

    <?php include('partials/footer.php') ?>