<?php 
add_user();
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