<?php include 'includes/admin_header.php' ?>
<?php 
// deleteCategory(); 
?>
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
                            Comments
                            <small><?php display_name(); ?></small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            switch($_GET['source']){
                                case 'add_comment';
                                    include './includes/comment.php';
                                    break;
                                case 'edit_comment';
                                    include './includes/edit_comment.php';
                                    break;    
                                
                                default: 
                                    include './includes/show_all_comments.php';
                            }
                        } else {
                            include './includes/show_all_comments.php';
                        }
                        ?>

                    </div>     
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php' ?>