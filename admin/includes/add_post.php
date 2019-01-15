<?php 
if (isset($_POST['create_post'])){
   $post_title  = $_POST['title'];
   $post_author = $_POST['author'];
   $post_cat_id = $_POST['cat_id'];
   $post_status = $_POST['status'];

   $post_img = $_FILES['image']['name'];
   $post_img_temp = $_FILES['image']['tmp_name'];

   $post_tags = $_POST['tags'];
   $post_content = $_POST['content'];
   $post_date = date('d,m,y');
   $post_comment_count = 4;

   move_uploaded_file($post_img_temp, "../images/{$post_img}");

   $query = "INSERT into posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) VALUES({$post_cat_id},'{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}' ) ";
   
   $insert_post = mysqli_query($connection, $query);
   if(!$insert_post){
       die('query failed: ' . mysqli_error($connection));
   }
}
?>


<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control">
</div>
<div class="form-group">
    <label for="cat_id">Category Id</label>
    <input type="text" name="cat_id" class="form-control">
</div>
<div class="form-group">
    <label for="author">Author</label>
    <input type="text" name="author" class="form-control">
</div>
<div class="form-group">
    <label for="status">Status</label>
    <input type="text" name="status" class="form-control">
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
    <textarea type="text" name="content" class="form-control" cols="30" rows="10"></textarea>
</div>
<input type="submit" value="Create Post" name="create_post" class="btn btn-primary">
</form>