<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  
// include "admin/functions.php"; 
?>
<?php register(); ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    <?php include "includes/title.php"; ?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-med-10">
                <div class="form-wrap not-black">
                <h1 class='blue-no-hover'>Register</h1>
                <p class="text-center">Registering an account will give you access to Admin as a 'visitor'.</p>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>



<?php include "includes/footer.php";?>
