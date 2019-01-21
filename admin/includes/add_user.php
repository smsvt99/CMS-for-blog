<?php 
if (isset($_POST['create_user'])){
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

   $query = "INSERT INTO users(randSalt, user_img, user_name, user_password, user_role, user_first_name, user_email, user_last_name) VALUES('{$randSalt}', '{$user_img}', '{$user_name}', '{$user_password}', '{$user_role}', '{$user_first_name}', '{$user_email}', '{$user_last_name}')" ;
   
   $insert_post = mysqli_query($connection, $query);
   if(!$insert_post){
       die('query failed: ' . mysqli_error($connection));
   }
   echo "user successfully created! <a href=users.php>See All Users</a>";
}
// header('location: posts.php');
?>

<form action="" method="POST">
<div class="form-group">
    <label for="user_name">User Name</label>
    <input type="text" name="user_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_password">Password</label>
    <input type="text" name="user_password" class="form-control">
</div>
<!-- <div class="form-group">
    <label for="user_img">User Image</label>
    <input type="file" name="user_img" class="form-control">
</div> -->
<div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" class="form-control">
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>


</div>
<div class="form-group">
    <label for="user_first_name">First Name</label>
    <input type="text" name="user_first_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" class="form-control" name="user_last_name">
</div>
<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" name="user_email" class="form-control">
</div>

<input type="submit" value="Create User" name="create_user" class="btn btn-primary">
</form>