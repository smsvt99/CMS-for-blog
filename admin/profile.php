<?php include 'includes/admin_header.php' ?>
<?php
    if(empty($_SESSION['user_id'])){
        header("Location: ../index.php");
    }
    if (isset($_POST['edit_user'])){
        $user_name = escape($_POST['user_name']);
        // $user_password = escape($_POST['user_password']);
        // $user_role = escape($_POST['user_role']);
        $user_first_name = escape($_POST['user_first_name']);
        $user_last_name = escape($_POST['user_last_name']);
        $user_email = escape($_POST['user_email']);
        // $user_img = 'PLACEHOLDER';
        // $randSalt = 'PLACEHOLDER';
     
     //    $user_img = $_FILES['image']['name'];
     //    $user_img_temp = $_FILES['image']['tmp_name'];
     //    move_uploaded_file($post_img_temp, "../images/{$post_img}");
     
        $query = "UPDATE users SET ";
        $query .= "user_name = '{$_POST['user_name']}', ";
        // $query .= "user_password = '{$_POST['user_password']}', ";
        // $query .= "user_role = '{$_POST['user_role']}', ";
        $query .= "user_first_name = '{$_POST['user_first_name']}', ";
        $query .= "user_last_name = '{$_POST['user_last_name']}', ";
        $query .= "user_email = '{$_POST['user_email']}' ";
        $query .= "WHERE user_id = {$_SESSION['user_id']}";
     
        $edit = mysqli_query($connection, $query);
        if(!$edit){
            die('query failed: ' . mysqli_error($connection));
        }
        $_SESSION['username'] = $user_name;
        $_SESSION['first_name'] = $user_first_name;
        $_SESSION['last_name'] = $user_last_name;
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
                            My Profile
                            <small><?php display_name(); ?></small>
                            
                        </h1>
                        <form action="" method="POST">
<div class="form-group">
    <label for="user_name">User Name</label>
    <input type="text" value="<?php echo get_user_info_session('user_name');?>" name="user_name" class="form-control">
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

                    </div>     
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
   
<?php include 'includes/admin_footer.php' ?>