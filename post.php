<?php 
// include "./admin/functions.php"
 ?>
<?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>
    
    <!-- Navigation -->
   <?php include "includes/navigation.php" ?>    <!-- Page Content -->
    <div class="container">
    <?php include "includes/title.php" ?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <!-- First Blog Post -->
                <?php 
                if (empty($_GET['id'])){
                    header('location: index.php');
                }
                $id = $_GET['id'];
                $query = "SELECT post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status FROM posts WHERE post_id = ? " ;
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "i", $id);
                $thing = mysqli_stmt_execute($stmt);
                if(!$thing){
                    die("FAILURE: " . mysqli_error($connection));
                }
                mysqli_stmt_bind_result($stmt, $post_cat_id, $post_title, $post_author, $post_date, $post_img, $post_content, $post_tags, $post_comment_count, $post_status);
                // $get_posts = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($get_posts)){
                    // $post_title = escape($row['post_title']);
                    // $post_author = escape($row['post_author']);
                    // $post_date = escape($row['post_date']);
                    // $post_img = escape($row['post_img']);
                    // $post_content = escape($row['post_content']);
                while(mysqli_stmt_fetch($stmt)){



                ?>
                    <h1 id="sub_title">
                        <?php 
                        echo $post_date . ": ";
                        echo $post_title;
                        echo " by ";
                        echo $post_author;
                        ?>
                    </h1>
                   <div class="not-black"> 
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php?author=<?php echo $post_author; ?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $post_img ?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                </div>
                <?php
                }
                ?>
                
                                <!-- Comments Form -->
        <?php if(isset($_POST['create_comment'])){
            create_comment();} 
            ?>
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
        <?php 
        // include "includes/sidebar.php" 
        ?>

        </div>
        <!-- /.row -->

        <!-- <hr> -->
        <?php 
        
        function create_comment(){
            if(empty($_POST['comment_email']) ||
            empty($_POST['comment_author']) ||
            empty($_POST['comment_content'])){
                echo "<script>alert('All fields are required when submitting a comment!')</script>";
            } else {
                global $connection;
                $id = escape($_GET['id']);
                $author = escape($_POST['comment_author']);
                $email = escape($_POST['comment_email']);
                $content = escape($_POST['comment_content']);



                $query = "INSERT into comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES('{$id}', '{$author}', '{$email}', '{$content}', 'unapproved', now()) " ;
                $insert_comment = mysqli_query($connection, $query);
                if(!$insert_comment){
                    die('QUERY FAILED: ' . mysqli_err($conection));
                }
        
                $query2="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$id}";
                $update_post_count = mysqli_query($connection, $query2);
            }
        }

        function show_comments_for_post(){
            global $connection;
            $id = $_GET['id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = {$id} AND comment_status = 'approved' ORDER BY comment_id DESC";
            $get_comments = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($get_comments)){
                $author = escape($row['comment_author']);
                $date = escape($row['comment_date']);
                $content = $row['comment_content'];

                echo '<div class="media">';
                echo '<a class="pull-left" href="#">';
                echo '<img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>';
                echo '<div class="media-body">';
                    echo "<h4 class='media-heading'>{$author}
                        <small>{$date}</small>
                    </h4>";
                   echo $content;
                echo '</div>';
            echo '</div>';
            }
        }
        

        ?>

<?php 
include "includes/footer.php"
?>