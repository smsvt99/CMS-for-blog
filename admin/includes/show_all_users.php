<?php 
delete_user_with_marked_id();
promote_user();
demote_user(); 
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Promote</th>
            <th>Demote</th>
            <th>Edit</th>
            <th>Delete</th>



            

        </tr>
    </thead>
    <tbody>
        <?php populate_users_table(); ?>
    </tbody>
</table>