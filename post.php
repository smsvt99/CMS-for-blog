<?php include "./admin/functions.php" ?>
<?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>
    
    <!-- Navigation -->
   <?php include "includes/navigation.php" ?>    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php 
                if (empty($_GET['id'])){
                    header('location: index.php');
                }
                $query = "SELECT * FROM posts WHERE post_id = {$_GET['id']}" ;
                $get_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($get_posts)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_img = $row['post_img'];
                    $post_content = $row['post_content'];
                ?>
                    
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $post_img ?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>                
                
                <?php
                }
                ?>
                
                                <!-- Comments Form -->
        <?php if(isset($_POST['create_comment'])){create_comment();} else { echo "not set"; } ?>
                                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="text" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group"></div>

                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name='create_comment'>Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php show_comments_for_post(); ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
include "includes/footer.php"
?>