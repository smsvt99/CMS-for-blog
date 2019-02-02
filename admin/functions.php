<?php
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim(strip_tags($string)));
}

function makeNewCategory(){
    global $connection;
    if(isset($_POST['submit'])){
        if($_POST['cat_title'] == ''){
            echo 'empty field!';
        } else {
            $new_cat_title = escape($_POST['cat_title']);
            $query = "INSERT INTO categories(cat_title) "; 
            $query .= "VALUE('{$new_cat_title}') ";
            $insertQuery = mysqli_query($connection, $query);
            if(!$insertQuery){
                die('QUERY FAILED <br/>' . mysqli_error($connection) . '<br>' . escape($query));
            }
        }
    }
}
function populateCategoryTable(){
    global $connection;
    $query = 'SELECT * FROM categories';
    $get_cats_for_admin = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_cats_for_admin)){
        $id = escape($row['cat_id']);
        $title = escape($row['cat_title']);

        echo "<tr>
                <td>{$id}</td>
                <td>{$title}</td>
                <td><a href='categories.php?edit={$id}&name={$title}'>Edit</a></td>
                <td><a onClick=\"javascript: return confirm('Are you sure you want to delete this category?');\"  href='categories.php?delete={$id}'>Delete</a></td>
                </tr>";
            }
}

function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $delete_id = escape($_GET['delete']);
        $query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
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
        
        $cat_name_from_id = escape(get_cat_name_from_id($row['post_cat_id']));
        $id = escape($row['post_id']);
        $author = escape($row['post_author']);
        $title = escape($row['post_title']);
        $status = escape($row['post_status']);
        $img = escape($row['post_img']);
        $tags = escape($row['post_tags']);
        $comment_count = escape($row['post_comment_count']);
        $date = escape($row['post_date']);
        
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$author}</td>";
        echo "<td>{$title}</td>";

        echo "<td>{$cat_name_from_id}</td>";
        
        echo "<td>{$status}</td>";
        echo "<td><img alt='image' width='75' src='../images/{$img}'</td>";
        echo "<td>{$tags}</td>";
        echo "<td>{$comment_count}</td>";
        echo "<td>{$date}</td>";

        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?');\" href='posts.php?delete={$id}'>Delete</a></td>";

        echo "<td><a href='posts.php?source=edit_post&id={$id}'>Edit</a></td>";
        echo "<td><a href='../post.php?id={$id}'>View</a></td>";
        echo "</tr>";
    }

}
function get_cat_name_from_id($id){
    global $connection;
    $id = escape($id);
    $query = "SELECT * FROM categories WHERE cat_id = {$id}";
    $get_name = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_name)){
        $cat_title = escape($row['cat_title']);
        return $cat_title;
    }
}

function delete_posts_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $delete = escape($_GET['delete']);
        $query = "DELETE FROM posts WHERE post_id = {$delete}";
        mysqli_query($connection, $query);
    }
}

function make_cat_options(){
    global $connection;
    $clean_id = escape($_GET['id']);
    $current_cat_id = get_cat_id_from_post_id($clean_id);

    $query1 = "SELECT * FROM categories WHERE cat_id = {$current_cat_id}";
    $cat_option = mysqli_query($connection, $query1);
    while($row = mysqli_fetch_assoc($cat_option)){
        $id = $row['cat_id'];
        $title = $row['cat_title'];
        echo "<option value='{$id}'>{$title}</option>";
    }
    $query2 = "SELECT * FROM categories WHERE cat_id != {$current_cat_id}";
    $cat_options = mysqli_query($connection, $query2);
    while($row = mysqli_fetch_assoc($cat_options)){
        $id = $row['cat_id'];
        $title = $row['cat_title'];
        echo "<option value='{$id}'>{$title}</option>";
    }
}
function get_cat_id_from_post_id($id){
    global $connection;
    $query = "SELECT post_cat_id FROM posts WHERE post_id = {$id}";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        return $row['post_cat_id'];
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
        // $post_date = date('d,m,y');
        // $post_comment_count = 4;
        $id = escape($_GET['id']);

     
        move_uploaded_file($post_img_temp, "../images/{$post_img}");

        if(empty($post_img)){
            $query2 = "SELECT * FROM posts WHERE post_id={$id}";
            $fetch_img = mysqli_query($connection, $query2);
            if(!$fetch_img){
                die('QUERY FAILED: ' . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($fetch_img)){
                $post_img = escape($row['post_img']);
            }
        } 

        $query = "UPDATE posts SET ";
        $query .= "post_title = ?, ";
        $query .= "post_author = ?, ";
        $query .= "post_cat_id = ?, ";
        $query .= "post_status = ?, ";
        $query .= "post_img = ?, ";
        $query .= "post_tags = ?, ";
        $query .= "post_content = ? ";
        // $query .= "post_date = now() ";
        // $query .= "post_comment_count = '{$post_comment_count}' ";
        $query .= "WHERE post_id = ?";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssissssi", $post_title, $post_author, $post_cat_id, $post_status, $post_img, $post_tags, $post_content, $id);
        $update_post = mysqli_stmt_execute($stmt);
        
        // $update_post = mysqli_query($connection, $query);
        if(!$update_post){
            die('query failed: ' . mysqli_error($connection));
        }
        echo "<p class='bg-success'> Post Updated Successfully!<a href='../post.php?id={$id}'> See Updated Post</a> or <a href='./posts.php'>Go Back to all Posts</a></p>";
    }
}

function delete_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $delete = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$delete}";
        mysqli_query($connection, $query);
    }
}
function populate_comments_table(){
    global $connection;
    $query = "SELECT * FROM comments";
    $get_comments = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_comments)){
        
        $post_name_from_id = escape(get_post_name_from_id($row['comment_post_id']));
        
        $id = escape($row['comment_id']);
        $author = escape($row['comment_author']);
        $content = escape($row['comment_content']);
        $email = escape($row['comment_email']);
        $status = escape($row['comment_status']);
        $post_id = escape($row['comment_post_id']);
        $date = escape($row['comment_date']);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$author}</td>";
        echo "<td>{$content}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$status}</td>";
        echo "<td><a href='../post.php?id={$id}'>$post_name_from_id</a></td>";
        echo "<td>{$date}</td>";
        echo "<td><a href='comments.php?approve={$id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$id}'>Unapprove</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this comment?');\" href='comments.php?delete={$id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function get_post_name_from_id($id){
    global $connection;
    $id = escape($id);
    $query = "SELECT * FROM posts WHERE post_id = {$id}";
    $get_name = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_name)){
        $title = escape($row['post_title']);
        return $row['post_title'];
    }
}
function unapprove_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['unapprove'])){
        $unapprove = escape($_GET['unapprove']);
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove}";
       $thing = mysqli_query($connection, $query);
    }
}
function approve_comment_with_marked_id(){
    global $connection;
    if (isset($_GET['approve'])){
        $approve = escape($_GET['approve']);
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve}";
       $thing = mysqli_query($connection, $query);
    }
}

function populate_users_table(){
    global $connection;
    $query = "SELECT * FROM users";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        
        $id = escape($row['user_id']);
        $name = escape($row['user_name']);
        $first_name = escape($row['user_first_name']);
        $last_name = escape($row['user_last_name']);
        $email = escape($row['user_email']);
        $role = escape($row['user_role']);
        $id = escape($row['user_id']);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$first_name}</td>";
        echo "<td>{$last_name}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$role}</td>";
        echo "<td><a href='users.php?promote={$id}'>Promote to Admin</a></td>";
        echo "<td><a href='users.php?demote={$id}'>Demote</a></td>";
        echo "<td><a href='users.php?source=edit_user&id={$id}'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" href='users.php?delete={$id}'>Delete</a></td>";
        echo "</tr>";

    }
}

function delete_user_with_marked_id(){
    global $connection;
    if (isset($_GET['delete'])){
        $delete = escape($_GET['delete']);
        $query = "DELETE FROM users WHERE user_id = {$delete}";
        mysqli_query($connection, $query);
    }
}
function promote_user(){
    global $connection;
    if (isset($_GET['promote'])){
        $promote = escape($_GET['promote']);
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$promote}";
       $thing = mysqli_query($connection, $query);
    }
}
function demote_user(){
    global $connection;
    if (isset($_GET['demote'])){
        $demote = escape($_GET['demote']);
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$demote}";
       $thing = mysqli_query($connection, $query);
       if(!$thing){
           die('QUERY FAILED: ' . mysqli_error($connection));
       }
    }
}
function get_user_info($x){
    global $connection;
    $id = escape($_GET['id']);
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        return escape($row[$x]);
    } 
}
function get_user_info_session($x){
    global $connection;
    $id = escape($_SESSION['user_id']);
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    $get_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_users)){
        return escape($row[$x]);
    } 
}
function get_numbers($table){
    global $connection;
    // $table = $table; 
    $query = "select * from {$table}";
    $result = mysqli_query($connection, $query);
    $number = mysqli_num_rows($result);
    return escape($number);
}

function get_numbers_with_params($table, $param, $value){
    global $connection;
    $table = escape($table);
    $param = escape($param);
    $value = escape($value);
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

        if(!$connection){
            echo 'no connection????';
        } else {
            echo 'connection good';
        }
     
        move_uploaded_file($post_img_temp, "../images/{$post_img}");
     
        $stmt = mysqli_prepare($connection, "INSERT into posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ? ) ");
        
        mysqli_stmt_bind_param($stmt, "issssssis", $post_cat_id, $post_title, $post_author, $post_date, $post_img, $post_content, $post_tags, $post_comment_count, $post_status);

        $insert_post = mysqli_stmt_execute($stmt);

        // {$post_cat_id},'{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}'
        // $insert_post = mysqli_query($connection, $query);
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
    
    $user_name = escape($_POST['user_name']);
    $user_password = escape($_POST['user_password']);
    $user_role = escape($_POST['user_role']);
    $user_first_name = escape($_POST['user_first_name']);
    $user_last_name = escape($_POST['user_last_name']);
    $user_email = escape($_POST['user_email']);
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
        $id = escape($_GET['id']);
        $user_name = escape($_POST['user_name']);
        $user_password = escape($_POST['user_password']);
        $user_role = escape($_POST['user_role']);
        $user_first_name = escape($_POST['user_first_name']);
        $user_last_name = escape($_POST['user_last_name']);
        $user_email = escape($_POST['user_email']);
        $user_img = 'PLACEHOLDER';

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

    $encrypted_password = crypt($user_password, $salt);
     
        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";

        $query .= "user_password = '{$encrypted_password}', ";
        
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_first_name = '{$user_first_name}', ";
        $query .= "user_last_name = '{$user_last_name}', ";
        $query .= "user_email = '{$user_email}' ";
        $query .= "WHERE user_id = {$id}";
     
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
        $new_cat_name = escape($_POST['new_cat_name']);
        $edit = escape($_GET['edit']);
        $query = "UPDATE categories SET cat_title = '{$new_cat_name}' WHERE cat_id = {$edit}";
        $edit_cat = mysqli_query($connection, $query);
            if (!$edit_cat){
                die ('query failed:' . mysqli_error($connection));
            }
    }
}

function display_name(){
    if(isset($_SESSION['username'])){
        echo escape($_SESSION['username']);
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