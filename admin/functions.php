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
        
        $cat_name_from_id = get_cat_name_from_id($row['post_cat_id']);
        
        echo "<tr>";
        echo "<td>{$row['post_id']}</td>";
        echo "<td>{$row['post_author']}</td>";
        echo "<td>{$row['post_title']}</td>";

        echo "<td>{$cat_name_from_id}</td>";
        
        echo "<td>{$row['post_status']}</td>";
        echo "<td><img alt='image' width='75' src='../images/{$row['post_img']}'</td>";
        echo "<td>{$row['post_tags']}</td>";
        echo "<td>{$row['post_comment_count']}</td>";
        echo "<td>{$row['post_date']}</td>";
        echo "<td><a href='posts.php?delete={$row['post_id']}'>Delete</a></td>";
        echo "<td><a href='posts.php?source=edit_post&id={$row['post_id']}'>Edit</a></td>";
        echo "</tr>";
    }

}
function get_cat_name_from_id($id){
    global $connection;
    $query = "SELECT * FROM categories WHERE cat_id = {$id}";
    $get_name = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_name)){
        return $row['cat_title'];
    }
}

function delete_posts_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $query = "DELETE FROM posts WHERE post_id = {$_GET['delete']}";
        mysqli_query($connection, $query);
    }
}

function make_cat_options(){
    global $connection;
    $query = 'SELECT * FROM categories';
    $cat_options = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($cat_options)){
        echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
    }
}

function update_post(){
    global $connection;
    if (isset($_POST['edit_post'])){
        $post_title  = $_POST['title'];
        $post_author = $_POST['author'];
        $post_cat_id = $_POST['cat_id'];
        $post_status = $_POST['status'];
     
        $post_img = $_FILES['image']['name'];
        $post_img_temp = $_FILES['image']['tmp_name'];
     
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('d,m,y');
        $post_comment_count = 4;
     
        move_uploaded_file($post_img_temp, "../images/{$post_img}");

        if(empty($post_img)){
            $query2 = "SELECT * FROM posts WHERE post_id={$_GET['id']}";
            $fetch_img = mysqli_query($connection, $query2);
            if(!$fetch_img){
                die('QUERY FAILED: ' . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($fetch_img)){
                $post_img = $row['post_img'];
            }
        } 

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_cat_id = '{$post_cat_id}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_img = '{$post_img}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_date = now(), ";
        $query .= "post_comment_count = '{$post_comment_count}' ";
        $query .= "WHERE post_id = '{$_GET['id']}'";
        
        $update_post = mysqli_query($connection, $query);
        if(!$update_post){
            die('query failed: ' . mysqli_error($connection));
        }
    }
    header('location: posts.php');
}
function delete_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $query = "DELETE FROM comments WHERE comment_id = {$_GET['delete']}";
        mysqli_query($connection, $query);
    }
}
function populate_comments_table(){
    global $connection;
    $query = "SELECT * FROM comments";
    $get_comments = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_comments)){
        
        $post_name_from_id = get_post_name_from_id($row['comment_post_id']);
        
        echo "<tr>";
        echo "<td>{$row['comment_id']}</td>";
        echo "<td>{$row['comment_author']}</td>";
        echo "<td>{$row['comment_content']}</td>";
        echo "<td>{$row['comment_email']}</td>";
        echo "<td>{$row['comment_status']}</td>";
        echo "<td><a href='../post.php?id={$row['comment_post_id']}'>$post_name_from_id</a></td>";
        echo "<td>{$row['comment_date']}</td>";
        echo "<td><a href='comments.php?approve={$row['comment_id']}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$row['comment_id']}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={$row['comment_id']}'>Delete</a></td>";
        echo "</tr>";
    }
}

function create_comment(){
        global $connection;
        $query = "INSERT into comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES('{$_GET['id']}', '{$_POST['comment_author']}', '{$_POST['comment_email']}', '{$_POST['comment_content']}', 'pending', now()) " ;
        $insert_comment = mysqli_query($connection, $query);

        $query2="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$_GET['id']}";
        $update_post_count = mysqli_query($connection, $query2);


}

function get_post_name_from_id($id){
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$id}";
    $get_name = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_name)){
        return $row['post_title'];
    }
}
function unapprove_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['unapprove'])){
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$_GET['unapprove']}";
       $thing = mysqli_query($connection, $query);
    }
}
function approve_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['approve'])){
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$_GET['approve']}";
       $thing = mysqli_query($connection, $query);
    }
}

function show_comments_for_post(){
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id = {$_GET['id']} AND comment_status = 'approved' ORDER BY comment_id DESC";
    $get_comments = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($get_comments)){
        echo '<div class="media">';
        echo '<a class="pull-left" href="#">';
        echo '<img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>';
        echo '<div class="media-body">';
            echo "<h4 class='media-heading'>{$row['comment_author']}
                <small>{$row['comment_date']}</small>
            </h4>";
           echo $row['comment_content'];
        echo '</div>';
    echo '</div>';
    }
}
function populate_users_table(){
    global $connection;
    $query = "SELECT * FROM users";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        echo "<tr>";
        echo "<td>{$row['user_id']}</td>";
        echo "<td>{$row['user_name']}</td>";
        echo "<td>{$row['user_first_name']}</td>";
        echo "<td>{$row['user_last_name']}</td>";
        echo "<td>{$row['user_email']}</td>";
        echo "<td>{$row['user_role']}</td>";
        echo "<td><a href='users.php?promote={$row['user_id']}'>Promote to Admin</a></td>";
        echo "<td><a href='users.php?demote={$row['user_id']}'>Demote</a></td>";
        echo "<td><a href='users.php?source=edit_user&id={$row['user_id']}'>Edit</a></td>";
        echo "<td><a href='users.php?delete={$row['user_id']}'>Delete</a></td>";
        echo "</tr>";

    }
}
function delete_user_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $query = "DELETE FROM users WHERE user_id = {$_GET['delete']}";
        mysqli_query($connection, $query);
    }
}
function promote_user(){
    global $connection;
    if (isset($_GET['promote'])){
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$_GET['promote']}";
       $thing = mysqli_query($connection, $query);
    }
}
function demote_user(){
    global $connection;
    if (isset($_GET['demote'])){
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$_GET['demote']}";
       $thing = mysqli_query($connection, $query);
       if(!$thing){
           die('QUERY FAILED: ' . mysqli_error($connection));
       }
    }
}
function get_user_info($x){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = {$_GET['id']}";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        return $row[$x];
        // $user_name = $row['user_name'];
        // $user_password = $row['user_password'];
        // $user_role = $row['user_role'];
        // $user_first_name = $row['user_first_name'];
        // $user_last_name = $row['user_last_name'];
        // $user_email = $row['user_email'];
        // $user_img = 'PLACEHOLDER';
        // $randSalt = 'PLACEHOLDER';
    } 
}
?>