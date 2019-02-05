<?php include "./includes/db.php" ?>
    <?php include "./includes/header.php" ?>
    
    <!-- Navigation -->
   <?php include "./includes/navigation.php" ?>    <!-- Page Content -->
    <div class="container">
    <h1 id="title" class="text-center">
                    > Hello World _
                    <small><i>A Blog About Itself</i></small>
                </h1>
    <h1 id="sub_title"><?php echo escape($_GET['search']) ?> </h1>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-9">

                <!-- First Blog Post -->
                <?php 
    if (isset($_GET['search'])){
        $lemma = escape($_GET['search']);
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$lemma%' ";
        $get_tagged_posts = mysqli_query($connection, $query);
        if (mysqli_num_rows($get_tagged_posts) == 0){
            echo 'no posts with that tag';
        } else {
            while ($row = mysqli_fetch_assoc($get_tagged_posts)){
                $post_title = escape($row['post_title']);
                $post_author = escape($row['post_author']);
                $post_date = escape($row['post_date']);
                $post_img = escape($row['post_img']);
                $post_content = escape($row['post_content']);         
    ?>    
        <div class="not-black">
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
                
                <?php }}} ?>
            </div>
                
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
        <?php include "./includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
include "./includes/footer.php"
?>