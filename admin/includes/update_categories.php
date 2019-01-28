<?php
    update_category();
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