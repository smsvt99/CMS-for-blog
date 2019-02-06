<?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>
    
    <!-- Navigation -->
   <?php include "includes/navigation.php" ?>    <!-- Page Content -->
    <div class="container">
    <?php include "includes/title.php" ?>

        <div class="row">
        <h1 id="sub_title">
                <?php 
                echo ucwords(get_cat_name_from_id(escape($_GET['id']))); ?>
            </h1>
            <!-- Blog Entries Column -->
            <div class="col-md-9">

                <!-- First Blog Post -->
                <?php
                if(empty($_GET['id'])){
                    head('location: index.php');
                }
                $query = "SELECT * FROM posts WHERE post_cat_id = {$_GET['id']} ORDER BY post_id DESC";
                $get_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($get_posts)){
                    $post_title = escape($row['post_title']);
                    $post_author = escape($row['post_author']);
                    $post_date = escape($row['post_date']);
                    $post_img = escape($row['post_img']);
                    $post_content = substr(escape($row['post_content']), 0, 300) . "....";
                    $post_id = escape($row['post_id']);

                ?>
                  <div class="not-black">  
                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post.php?id=<?php echo $post_id ?>"><img class="img-responsive" src="./images/<?php echo $post_img ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>                
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