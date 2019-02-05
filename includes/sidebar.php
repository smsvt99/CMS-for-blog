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
<div class="well">
    <?php if (isset($_GET['login'])){
        echo "<p class=' text text-danger'>Invalid credentials, please try again.</p>";
    } ?>
    <h4>Login</h4>
    <div class="form-group">
    <form action="./includes/login.php" method="post">
    <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
        <input type="submit" name="login" class="btn btn-primary">
        </form>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->

<div class="well">
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
            for($i=0; $i < sizeof($allTagsArray); $i++){
                echo "<a href ='search.php?search={$allTagsArray[$i]}'>{$allTagsArray[$i]}</a>";
                echo ' &#8226; ';
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
