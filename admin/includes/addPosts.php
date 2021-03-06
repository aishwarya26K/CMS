<?php
addPosts();
if (isset($_SESSION['addPostStatus']) && $_SESSION['addPostStatus']) {
?>
    <div class='alert alert-success' role='alert' style='width:-webkit-fit-content;width:-moz-fit-content;  width: fit-content;margin:1em auto 1em 0;'>
        <p class='errorMsg'>
            <strong>Post Created! </strong><a href='../post.php?p_id=<?php echo $_SESSION['created_post_id'] ?>'>View Post</a> or <a href='posts.php'>Edit More Posts</a>
        </p>
    </div>
<?php
    unset($_SESSION['addPostStatus']);
    unset($_SESSION['created_post_id']);
} elseif (isset($_SESSION['addPostStatus']) && !$_SESSION['addPostStatus']) {
?>

    <div class='alert alert-warning alert-dismissible'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p class='errorMsg'>
            Failed to add post. Please try again!
        </p>
    </div>
<?php
    unset($_SESSION['addPostStatus']);
}
?>


<h3>Add Posts</h3>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select name="post_category" id="post_category">
            <?php

            global $conn;
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($conn, $query);

            if (!$select_categories) {
                die("QUERY FAILED" . mysqli_error_list($conn));
            }

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" id="post_author">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>