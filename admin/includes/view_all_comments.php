<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select * from comments";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";

            // $query_for_cat_title = "select * from categories where cat_id = $post_category_id";
            // $result_for_cat_title = mysqli_query($connection, $query_for_cat_title);
            // while ($row = mysqli_fetch_assoc($result_for_cat_title)) {
            //     $cat_title = $row['cat_title'];
            // }
            // echo "<td>$cat_title</td>";

            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            // echo "<td>$query_for_post_title_data</td>";
            $query_for_post_title = "SELECT post_title FROM posts WHERE post_id = $comment_post_id";
            $query_for_post_title_data = mysqli_query($connection, $query_for_post_title);
            while ($row = mysqli_fetch_assoc($query_for_post_title_data)) {
                $result_for_post_title = $row['post_title'];
            }
            echo "<td><a href='../post.php?p_id=$comment_post_id'>$result_for_post_title</a></td>";
            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?c_status_app=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?c_status_unapp=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='posts.php?delete='>Edit</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            echo "</tr>";
        }

        if (isset($_GET['delete'])) {
            $delete_comment_id = $_GET['delete'];
            $query = "DELETE from comments where comment_id = {$delete_comment_id}";
            $delete_post_query = mysqli_query($connection, $query);
            header("Location: comments.php");
        }

        if (isset($_GET['c_status_app'])) {
            $comment_status_id = $_GET['c_status_app'];
            $comment_status_approve_query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '{$comment_status_id}'";
            $comment_status_approve_query_result = mysqli_query($connection, $comment_status_approve_query);
            header("Location: comments.php");
        }

        if (isset($_GET['c_status_unapp'])) {
            $comment_status_id = $_GET['c_status_unapp'];
            $comment_status_unapprove_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '{$comment_status_id}'";
            $comment_status_unapprove_query_result = mysqli_query($connection, $comment_status_unapprove_query);
            header("Location: comments.php");
        }
        ?>
    </tbody>
</table>