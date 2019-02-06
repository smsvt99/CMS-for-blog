<?php delete_posts_with_marked_id(); ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php populate_posts_table(); ?>
    </tbody>
</table> 