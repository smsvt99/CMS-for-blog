<?php

function makeNewCategory(){
    global $connection;
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
}
function populateCategoryTable(){
    global $connection;
    $query = 'SELECT * FROM categories';
    $get_cats_for_admin = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_cats_for_admin)){
        echo "<tr>
                <td>{$row['cat_id']}</td>
                <td>{$row['cat_title']}</td>
                <td><a href='categories.php?delete={$row['cat_id']}'>Delete</a></td>
                <td><a href='categories.php?edit={$row['cat_id']}&name={$row['cat_title']}'>Edit</a></td>
                </tr>";
            }
}

function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $query = "DELETE FROM categories WHERE cat_id = {$_GET['delete']}";
        $delete_cat = mysqli_query($connection, $query);
        if (!$delete_cat){
            die('QUERY FAILED <br/>' . mysqli_error($connection));
        }
    }
}

function populate_posts_table(){
    global $connection;
    $query = "SELECT * FROM posts";
    $get_posts = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_posts)){
        echo "<tr>";
        echo "<td>{$row['post_id']}</td>";
        echo "<td>{$row['post_author']}</td>";
        echo "<td>{$row['post_title']}</td>";
        echo "<td>{$row['post_cat_id']}</td>";
        echo "<td>{$row['post_status']}</td>";
        echo "<td><img alt='image' width='75' src='../images/{$row['post_img']}'</td>";
        echo "<td>{$row['post_tags']}</td>";
        echo "<td>{$row['post_comment_count']}</td>";
        echo "<td>{$row['post_date']}</td>";
        echo "<td><a href=''>delete</a></td>";
        echo "</tr>";
    }

}

?>