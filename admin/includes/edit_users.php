<?php
if (isset($_POST['edit_user'])){
    update_user();
}
?>

<form action="" method="POST">
<div class="form-group">
    <label for="user_name">User Name</label>
    <input type="text" value="<?php echo get_user_info('user_name');?>" name="user_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" value="<?php echo get_user_info('user_password'); ?>" name="user_password" class="form-control">
</div>
<!-- <div class="form-group">
    <label for="user_img">User Image</label>
    <input type="file" name="user_img" class="form-control">
</div> -->
<div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" class="form-control">
        <option value=<?php echo get_user_info('user_role'); ?>><?php echo get_user_info('user_role'); ?></option>
        <?php if (get_user_info('user_role') == 'admin'){
            echo"<option value='subscriber'>subscriber</option>";
        } else {
            echo"<option value='admin'>admin</option>";
        } 
        ?>
    </select>


</div>
<div class="form-group">
    <label for="user_first_name">First Name</label>
    <input type="text" value="<?php echo get_user_info('user_first_name'); ?>" name="user_first_name" class="form-control">
</div>
<div class="form-group">
    <label for="user_last_name">Last Name</label>
    <input type="text" value="<?php echo get_user_info('user_last_name'); ?>" class="form-control" name="user_last_name">
</div>
<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" value="<?php echo get_user_info('user_email'); ?>" name="user_email" class="form-control">
</div>

<input type="submit" value="Edit User" name="edit_user" class="btn btn-primary">
</form>