    <?php include 'includes/admin_header.php'?>

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
                            <small><?php echo $_SESSION['first_name']?></small>
                        </h1>
  
                    </div>
                </div>
                <!-- /.row -->
                                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo get_numbers('posts'); ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo get_numbers('comments'); ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo get_numbers('users'); ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo get_numbers('categories'); ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<div class="row">
<script type="text/javascript">

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        
        ['Data','Drafted Posts','Published Posts', 'Approved Comments', 'Unapproved Comments', 'Administrators', "Subscribers", "Categories"],
        
        ['Posts', <?php echo get_numbers("posts WHERE post_status = 'draft'");?>, <?php echo get_numbers("posts WHERE post_status = 'published'"); ?>, 0, 0, 0, 0, 0],
        
        ['Comments','','', <?php echo get_numbers("comments WHERE comment_status = 'approved'");?>,<?php echo get_numbers("comments WHERE comment_status = 'unapproved'");?>, 0, 0, 0],
        
        ['Users', 0, 0, 0, 0, <?php echo get_numbers("users WHERE user_role = 'admin'"); ?> ,<?php echo get_numbers("users WHERE user_role = 'subscriber'"); ?>, 0],
        
        ['Categories', 0, 0, 0, 0, 0, 0, <?php echo get_numbers('categories');?>],

        ]);

        var options = {
            series: {
          1:{color:'#337ab7'},
          0:{color:'#2269a6'},
          3:{color:'#5cb85c'},
          2:{color:'#4ba74b'},
          5:{color:'#f0ad4e'},
          4:{color:'#ef9c3d'},
          6:{color:'#d9534f'},
          7:{color:'#AAA'},
        },
            legend: { position: "none" },
            isStacked : true,
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php' ?>