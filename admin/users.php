<?php include 'includes/admin_header.php'; 

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
                            Users
                            <small><?php display_name(); ?></small>
                        </h1>
                        
                        <?php
                        if(isset($_GET['source'])){
                            switch($_GET['source']){
                                case 'add_user';
                                    include './includes/add_user.php';
                                    break;
                                case 'edit_user';
                                    include './includes/edit_users.php';
                                    break;    
                                
                                default: 
                                    include './includes/show_all_users.php';
                            }
                        } else {
                            include './includes/show_all_users.php';
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