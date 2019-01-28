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
                <td><a href='categories.php?edit={$row['cat_id']}&name={$row['cat_title']}'>Edit</a></td>
                <td><a onClick=\"javascript: return confirm('Are you sure you want to delete this category?');\"  href='categories.php?delete={$row['cat_id']}'>Delete</a></td>

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

        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?');\" href='posts.php?delete={$row['post_id']}'>Delete</a></td>";

        echo "<td><a href='posts.php?source=edit_post&id={$row['post_id']}'>Edit</a></td>";
        echo "<td><a href='../post.php?id={$row['post_id']}'>View</a></td>";
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
        echo "<p class='bg-success'> Post Updated Successfully!<a href='../post.php?id={$_GET['id']}'> See Updated Post</a> or <a href='./posts.php'>Go Back to all Posts</a></p>";
    }
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
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this comment?');\" href='comments.php?delete={$row['comment_id']}'>Delete</a></td>";
        echo "</tr>";
    }
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
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" href='users.php?delete={$row['user_id']}'>Delete</a></td>";
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
    } 
}
function get_user_info_session($x){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        return $row[$x];
    } 
}
function get_numbers($table){
    global $connection;
    $query = "select * from {$table}";
    $result = mysqli_query($connection, $query);
    $number = mysqli_num_rows($result);
    return $number;
}

function get_numbers_with_params($table, $param, $value){
    global $connection;
    $query = "select * from {$table} WHERE {$param} = {'$value'}";
    $result = mysqli_query($connection, $query);
    $number = mysqli_num_rows($result);
}
function add_post(){
    global $connection;
    if (isset($_POST['create_post'])){
        $post_title  = $_POST['title'];
        $post_author = $_POST['author'];
        $post_cat_id = $_POST['cat_id'];
        $post_status = $_POST['status'];
     
        $post_img = $_FILES['image']['name'];
        $post_img_temp = $_FILES['image']['tmp_name'];
     
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date("Y-m-d");
        $post_comment_count = 0;
     
        move_uploaded_file($post_img_temp, "../images/{$post_img}");
     
        $query = "INSERT into posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) VALUES({$post_cat_id},'{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}' ) ";
        
        $insert_post = mysqli_query($connection, $query);
        if(!$insert_post){
            die('query failed: ' . mysqli_error($connection));
        } else {

            $last_id = mysqli_insert_id($connection);

            echo "<p class='bg-success'> Post Successful!<a href='../post.php?id={$last_id}'> See Your Post</a> or <a href='./posts.php'>Go to all Posts</a></p>";
        }
     }
}
function add_user(){
if (isset($_POST['create_user'])){
    global $connection;
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_img = 'PLACEHOLDER';
 
 //    $user_img = $_FILES['image']['name'];
 //    $user_img_temp = $_FILES['image']['tmp_name'];
 //    move_uploaded_file($post_img_temp, "../images/{$post_img}");
 
    $query = "INSERT INTO users(user_img, user_name, user_password, user_role, user_first_name, user_email, user_last_name) VALUES('{$user_img}', '{$user_name}', '{$user_password}', '{$user_role}', '{$user_first_name}', '{$user_email}', '{$user_last_name}')" ;
    
    $insert_post = mysqli_query($connection, $query);
    if(!$insert_post){
        die('query failed: ' . mysqli_error($connection));
    }
    echo "<p class='bg-success'>user successfully created! <a href=users.php>See All Users</a></p>";
    }
}
function update_user(){
    global $connection;
    if (isset($_POST['edit_user'])){
        // $user_name = $_POST['user_name'];
        // $user_password = $_POST['user_password'];
        // $user_role = $_POST['user_role'];
        // $user_first_name = $_POST['user_first_name'];
        // $user_last_name = $_POST['user_last_name'];
        // $user_email = $_POST['user_email'];
        // $user_img = 'PLACEHOLDER';
     
     //    $user_img = $_FILES['image']['name'];
     //    $user_img_temp = $_FILES['image']['tmp_name'];
     //    move_uploaded_file($post_img_temp, "../images/{$post_img}");

     $q = "SELECT randSalt FROM users";
     $get_salt_result = mysqli_query($connection, $q);
     if (!$get_salt_result){
        die('QUERY FAILED: ' . mysqli_error($connection));
     } else {
        $salt_array = mysqli_fetch_array($get_salt_result);
        $salt = $salt_array[0];
        }
    }

    $encrypted_password = crypt($_POST['user_password'], $salt);
     
        $query = "UPDATE users SET ";
        $query .= "user_name = '{$_POST['user_name']}', ";

        $query .= "user_password = '{$encrypted_password}', ";
        
        $query .= "user_role = '{$_POST['user_role']}', ";
        $query .= "user_first_name = '{$_POST['user_first_name']}', ";
        $query .= "user_last_name = '{$_POST['user_last_name']}', ";
        $query .= "user_email = '{$_POST['user_email']}' ";
        $query .= "WHERE user_id = {$_GET['id']}";
     
        $edit = mysqli_query($connection, $query);
        if(!$edit){
            die('query failed: ' . mysqli_error($connection));
        } else {
         header('location: users.php');
        }
     }

function update_category(){
    if (isset($_POST['edit_submit'])){
        global $connection;
        $query = "UPDATE categories SET cat_title = '{$_POST['new_cat_name']}' WHERE cat_id = {$_GET['edit']}";
        $edit_cat = mysqli_query($connection, $query);
            if (!$edit_cat){
                die ('query failed:' . mysqli_error($connection));
            }
    }
}
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim(strip_tags($string)));
}
function display_name(){
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    } else {
        echo 'anonymous';
    }
}
function register(){
    if(isset($_POST['submit'])){
        global $connection;
        $username = escape($_POST['username']);
        $email = escape($_POST['email']);
        $password = escape($_POST['password']);
        if (empty($_POST['username']) ||
            empty($_POST['email']) ||
            empty($_POST['password'])){
                echo "<script>alert('Some fields left blank. Please fill out all fields in order to register.')</script>";
            } else {
                $query="SELECT randSalt FROM users";
                $result = mysqli_query($connection, $query);
                if (!$result){
                    die('QUERY FAILED: ' . mysqli_error($connection));
                } else {
                    $salt_array = mysqli_fetch_array($result);
                    $salt = $salt_array[0];
                    // echo $salt;
                    $encrypted_password = crypt($password, $salt);
                    $query2 = "INSERT INTO users(user_name, user_email, user_password, user_role) VALUES('{$username}', '{$email}', '{$encrypted_password}', 'subscriber')";      
                    $result2 = mysqli_query($connection, $query2);
                    if (!$result2){
                        die('QUERY FAILED: ' . mysqli_error($connection));
                    } else {
                        echo "<p class='bg-success text-center'>Success! Go <a href='./'>home</a> to log in.</p>"; }
                    }
                }
            }
        }
?>