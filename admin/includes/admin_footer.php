
    </div>

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
            $(document).ready(
    () => {
        var div_box = "<div id='load-screen'><div id='loading'></div></div>";
        $("body").prepend(div_box);
        $('#load-screen').delay(700).fadeOut(600, function () {
            $(this).remove();
        });
    }
)
    </script>

    <script src="./js/scripts.js"></script>


</body>

</html>