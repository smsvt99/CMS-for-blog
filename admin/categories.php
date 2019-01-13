<?php include 'includes/admin_header.php' ?>
<?php deleteCategory(); ?>
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
                <?php makeNewCategory(); ?>
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

                            <?php include './includes/update_categories.php' ?>

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
                                <?php populateCategoryTable(); ?>

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