<?php include 'includes/admin_header.php' ?>
    <div id="wrapper">

        <!-- Navigation -->
   <?php include 'includes/admin_navigation.php'?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                <!-- /Page Heading -->
                <!-- form -->
                <?php 
                    if(isset($_POST['submit'])){
                        if($_POST['cat_title'] == ''){
                            echo 'empty field!';
                        } else {
                            $new_cat_title = $_POST['cat_title'];
                            $query = "INSERT INTO categories(cat_title) "; 
                            $query .= "VALUE('{$new_cat_title}') ";
                            $insertQuery = mysqli_query($connection, $query);
                            if(!$insertQuery){
                                die('QUERY FAILED <br/>' . mysqli_error($connection));
                            }
                        }
                    }

                ?>
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title"/>
                                </div>
                                <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category"/>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>category title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
            $query = 'SELECT * FROM categories';
            $get_cats_for_admin = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($get_cats_for_admin)){
                echo "<tr>
                        <td>{$row['cat_id']}</td>
                        <td>{$row['cat_title']}</td>
                        <td><a href='categories.php?delete={$row['cat_id']}'>Delete</a></td>
                    </tr>";
            }
            ?>
            <!-- for deleting -->
            <?php 
                if(isset($_GET['delete'])){
                    $query = 
                }
            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>     
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php' ?>