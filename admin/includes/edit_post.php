<?php
update_post();
if (isset($_GET['id'])){
    $query = "SELECT * FROM posts WHERE post_id = {$_GET['id']}";
    $fill_form_with_old_data = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($fill_form_with_old_data)){
?>


  


<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" value="<?php echo $row['post_title']; ?>"class="form-control">
</div>
<div class="form-group">
<label for="cat_id">Category</label>
<select name="cat_id" class="form-control">
    <?php make_cat_options(); ?>
</select>
</div>

<div class="form-group">
    <label for="author">Author</label>
    <input type="text" name="author" value="<?php echo $row['post_author']; ?>" class="form-control">
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control">
        <?php if ($row['post_status'] == 'draft'){
            echo "<option value = 'draft'>Draft</option>";
            echo "<option value = 'published'>Published</option>";
        } else {
            echo "<option value = 'published'>Published</option>";
            echo "<option value = 'draft'>Draft</option>";
        }
        ?>
    </select>
</div>
<div class="form-group">
    <img name="image" width="75px" src="../images/<?php echo $row['post_img']; ?>">
    <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image">
</div>
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" value="<?php echo $row['post_tags']; ?>" class="form-control">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" name="content" class="form-control" cols="30" rows="10"><?php echo $row['post_content']; ?></textarea>
</div>
<input type="submit" value="Edit Post" name="edit_post" class="btn btn-primary">
</form>

<?php }} ?>