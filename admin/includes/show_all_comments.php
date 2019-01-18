<?php delete_comment_with_marked_id(); ?>
<?php unapprove_comment_with_marked_id(); ?>
<?php approve_comment_with_marked_id(); ?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Resonse to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php populate_comments_table(); ?>
    </tbody>
</table>