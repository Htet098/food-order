<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add']))//checking whether the session is set of not
           {
            echo $_SESSION['add'];//display session message if set
            unset( $_SESSION['add']);//removing session message
           } 
           ?> <br><br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Fullname:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" class="inp"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username" class="inp"></td>
                </tr>
                 <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password" class="inp"></td>
                </tr> <br>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td
                    tr>
                
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>
<?php 
// process the value from from and save it in database
// check the weather the submit button is clicked or not
if (isset($_POST['submit'])){
    
// 1.get the daa from form

   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=md5($_POST['password']); // encrypt password

// 2.sql query to save data into database
   $sql="INSERT INTO tbl_admin SET 
     full_name='$full_name',
     username='$username',
     password='$password'
      ";
   // 3.Execute query and save data in database
   $res= mysqli_query($conn,$sql) or die (mysqli_error());
   //4. check whether the (query is execute) data is insert or not and display appropriate message
   if($res==TRUE){
    // echo "insert success";
    //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
    $_SESSION['add']='Admin Add Successfully';
    //redirect page to manage-admin page
    header("location:".SITEURL.'Admin/manage-admin.php');
   }else{
    // echo "insert fail";
    //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
    $_SESSION['add']='Admin Add  Fail';
    //redirect page to manage-admin page
    header("location:".SITEURL.'Admin/add-admin.php');
   
   }
};

?>