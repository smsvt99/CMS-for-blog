        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Sean Stone 2019</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
        function removeUnderscore(){
            setTimeout(function(){
                document.getElementById('title').innerHTML = "> Hello World&nbsp;&nbsp;&nbsp;" +
                        '<small><i>' +"A Blog About Itself" + '<i></small>';
                        addUnderscore();
            }, 500)
        }
        function addUnderscore(){
            setTimeout(function(){
                document.getElementById('title').innerHTML = "> Hello World _ " +
                        '<small><i>' +"A Blog About Itself" + '<i></small>';
                        removeUnderscore();
            }, 500)
        }
        removeUnderscore();

        </script>

</body>

</html>
