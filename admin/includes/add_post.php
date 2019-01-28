<?php 
add_post();

?>


<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control">
</div>


<div class="form-group">
    <label for="cat_id">Category</label>
    <!-- <input type="text" name="cat_id" class="form-control"> -->
    <select class="form-control" name="cat_id">
    <?php make_cat_options(); ?>
</select>
</div>


<div class="form-group">
    <label for="author">Author</label>
    <input type="text" name="author" class="form-control">
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select type="text" name="status" class="form-control">
        <option value = 'published'>Published</option>
        <option value = 'draft'>Draft</option>
    </select>
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image">
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" class="form-control">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" name="content" id="body" class="form-control" cols="30" rows="10"></textarea>
</div>
<input type="submit" value="Create Post" name="create_post" class="btn btn-primary">
</form>