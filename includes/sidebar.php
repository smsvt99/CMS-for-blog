<div class="col-md-3 sticky">

<!-- Blog Search Well -->

<!-- <div class="well"> -->
    <!-- <h4>Blog Search</h4>
    <div class="input-group">
    <form action="./search.php" method="post">
        <input type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span> 
        </form>
    </div> -->
    <!-- /.input-group -->
<!-- </div> -->

<!-- Login -->
<div class="well not-black">
    <?php
        if (isset($_SESSION['username'])){
            echo "<h4>Hello, {$_SESSION['username']}</h4>
                <ul>
                    <li><a href='./includes/logout.php'>Log Out</a></li>
                    <li><a href='./admin/profile.php'>Edit Profile</a></li>
                </ul>
            ";
        } else {
            if (isset($_GET['login'])){
                echo "<p class=' text text-danger'>Invalid credentials, please try again.</p>";
            }
            echo "<h4>Login</h4>";
            echo "<div class='form-group'>";
            echo "<form action='./includes/login.php' method='post'>";
            echo "<label for='username'>Username</label>";
            echo "<input type='text' class='form-control' name='username'>";
            echo "<label for='password'>Password</label>";
            echo "<input type='password' class='form-control' name='password'>";
            echo "<input style='margin-top: 5px;' type='submit' name='login' class='btn btn-block btn-primary'>";
            echo "<hr>";
            echo "<p class='text-center'><a href='registration.php'>Click here to register and get access to Admin as a visitor!</a></p>";
            echo "</form>";
            echo "</div>";
    }
    ?>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->

<div class="well not-black">
    <h4>Tags</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            <?php 
            $query = 'SELECT post_tags FROM posts';
            $get_tags_for_sidebar = mysqli_query($connection, $query);
            $allTagsArray = [];
            $allTagsString = '';
            while($row = mysqli_fetch_assoc($get_tags_for_sidebar)){
                $string = $row['post_tags'];
                if ($string != ''){
                    $tagArray = explode(", ", $string);
                    for ($i = 0; $i < sizeof($tagArray); $i++){
                        array_push($allTagsArray, $tagArray[$i]);
                    }
            }
                ?>
    
                <!-- <li>
                    <a href='category.php?id=<?php echo $row['cat_id'] ?>'> <?php echo $row['cat_title']; ?></a>
                </li> -->
                
                <?php
            }
            $allTagsArray = array_unique($allTagsArray, SORT_STRING);
            // print_r($allTagsArray);
            for($i=0; $i < sizeof($allTagsArray); $i++){
                if(isset($allTagsArray[$i])){
                    $tag = ucwords($allTagsArray[$i]);
                    echo "<a href ='search.php?lemma={$allTagsArray[$i]}'>{$tag}</a>";
                    echo ' &#8226; ';
                }
            }
            ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<!-- <?php include 'widget.php' ?> -->

</div>
