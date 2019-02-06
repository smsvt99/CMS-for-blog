<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand blue" href="index.php">Home</a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php 
                $query = "SELECT * FROM categories";
                $get_categories = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($get_categories)){
                    $cat_title = ucwords($row['cat_title']);
                    $cat_id = $row['cat_id'];
                    echo "<li><a href=category.php?id={$cat_id}>{$cat_title}</a></li>";
                }

                if (isset($_SESSION['user_id'])){
                    if (strpos($_SERVER['REQUEST_URI'], 'post.php?id')){
                        echo "<li><a href='./admin/posts.php?source=edit_post&id={$_GET['id']}'>Edit Post</a></li>";
                    } 
                 }
                ?>
                    <!-- <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->


                </ul>
                <div class="reverse nav navbar-nav">
                <a href="admin" class="navbar-brand admin-button">Admin</a>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
