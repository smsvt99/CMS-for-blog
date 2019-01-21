<?php include 'includes/admin_header.php' ?>
<?php
    if(empty($_SESSION['user_id'])){
        header("Location: ../index.php");
    }
    if (isset($_POST['edit_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_role = $_POST['user_role'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_email = $_POST['user_email'];
        $user_img = 'PLACEHOLDER';
        $randSalt = 'PLACEHOLDER';
     
     //    $user_img = $_FILES['image']['name'];
     //    $user_img_temp = $_FILES['image']['tmp_name'];
     //    move_uploaded_file($post_img_temp, "../images/{$post_img}");
     
        $query = "UPDATE users SET ";
        $query .= "user_name = '{$_POST['user_name']}', ";
        $query .= "user_password = '{$_POST['user_password']}', ";
        $query .= "user_role = '{$_POST['user_role']}', ";
        $query .= "user_first_name = '{$_POST['user_first_name']}', ";
        $query .= "user_last_name = '{$_POST['user_last_name']}', ";
        $query .= "user_email = '{$_POST['user_email']}' ";
        $query .= "WHERE user_id = {$_SESSION['user_id']}";
     
        $edit = mysqli_query($connection, $query);
        if(!$edit){
            die('query failed: ' . mysqli_error($connection));
        }
     }
?>
    <div id="wrapper">

        <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                            
                        </h1>
                        <form action="" method="POST">
<div class="form-group">
    <label for="user_name">User Name</label>
    <input type="text" value="<?php echo get_user_info_session('user_name');?>" name="user_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_password">Password</label>
    <input type="text" value="<?php echo get_user_info_session('user_password'); ?>" name="user_password" class="form-control">
</div>
<!-- <div class="form-group">
    <label for="user_img">User Image</label>
    <input type="file" name="user_img" class="form-control">
</div> -->
<div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" class="form-control">
        <option value=<?php echo get_user_info_session('user_role'); ?>><?php echo get_user_info_session('user_role'); ?></option>
        <?php if (get_user_info_session('user_role') == 'admin'){
            echo"<option value='subscriber'>subscriber</option>";
        } else {
            echo"<option value='admin'>admin</option>";
        } 
        ?>
    </select>


</div>
<div class="form-group">
    <label for="user_first_name">First Name</label>
    <input type="text" value="<?php echo get_user_info_session('user_first_name'); ?>" name="user_first_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" value="<?php echo get_user_info_session('user_last_name'); ?>" class="form-control" name="user_last_name">
</div>
<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" value="<?php echo get_user_info_session('user_email'); ?>" name="user_email" class="form-control">
</div>

<input type="submit" value="Edit User" name="edit_user" class="btn btn-primary">
</form>
                        <?php
                        // if(isset($_GET['source'])){
                        //     switch($_GET['source']){
                        //         case 'add_user';
                        //             include './includes/add_user.php';
                        //             break;
                        //         case 'edit_user';
                        //             include './includes/edit_users.php';
                        //             break;    
                                
                        //         default: 
                        //             include './includes/show_all_users.php';
                        //     }
                        // } else {
                        //     include './includes/show_all_users.php';
                        // }
                        ?>

                    </div>     
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
   
<?php include 'includes/admin_footer.php' ?>