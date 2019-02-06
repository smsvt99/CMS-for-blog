    <?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>
    
    <!-- Navigation -->
   <?php include "includes/navigation.php" ?>    <!-- Page Content -->
    <div class="container">
    <?php include "includes/title.php" ?>

<h1 id="sub_title">All posts</h1>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-9">


                <!-- First Blog Post -->
                <?php
                $counter = 0;
                $query = "SELECT post_id, post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status FROM posts WHERE post_status = ? ";
                if(isset($_GET['author'])){
                    $author = escape($_GET['author']);
                    $query .= "AND post_author = ? ";
                }
                $query .= "ORDER BY post_id DESC";
                $published = 'published';
                                
                $stmt = mysqli_prepare($connection, $query);
                
                if(isset($_GET['author'])){
                    mysqli_stmt_bind_param($stmt, "ss", $published, $author);
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $published);
                }
                
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $post_id, $post_cat_id, $post_title, $post_author, $post_date, $post_img, $post_content, $post_tags, $post_comment_count, $post_status);

                      
                    while (mysqli_stmt_fetch($stmt)){
                        $post_content = substr($post_content, 0, 300) . "....";

                ?>
                    <div class="not-black">
                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php?author=<?php echo $post_author ?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post.php?id=<?php echo $post_id ?>"><img class="img-responsive" src="./images/<?php echo $post_img ?>" alt=""></a>
                <hr>
                <div>
                    <p><?php echo $post_content?></p>
                </div>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>                
                    </div>
                <?php
                }
                ?>
                
                <!-- <hr> -->

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
include "includes/footer.php"
?>