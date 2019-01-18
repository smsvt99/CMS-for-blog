<div class="col-md-4">

<!-- Blog Search Well -->

<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
    <form action="./search.php" method="post">
        <input type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
        </form>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->

<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            <?php 
            $query = 'SELECT * FROM categories';
            $get_cats_for_sidebar = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($get_cats_for_sidebar)){
                ?>
    
                <li>
                    <a href='category.php?id=<?php echo $row['cat_id'] ?>'> <?php echo $row['cat_title']; ?></a>
                </li>
                
                <?php
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
<?php include 'widget.php' ?>

</div>