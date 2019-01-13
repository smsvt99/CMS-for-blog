<?php
    if (isset($_POST['edit_submit'])){
        $query = "UPDATE categories SET cat_title = '{$_POST['new_cat_name']}' WHERE cat_id = {$_GET['edit']}";
        $edit_cat = mysqli_query($connection, $query);
            if (!$edit_cat){
                die ('query failed:' . mysqli_error($connection));
            }
    }
?>

<form action="" method="post">
    <div class="form-group">

    <?php 
        if (isset($_GET['edit'])){
            echo '<label for="new_cat_name">Edit Category</label>';
            echo "<input type='text' class='form-control' name='new_cat_name' value={$_GET['name']}>";
            echo '</div>';
            echo '<div class="form-group">';
            echo "<input class='btn btn-primary' type='submit' name='edit_submit' value='Edit Category'/>";
        }
    ?>

    </div>
</form>