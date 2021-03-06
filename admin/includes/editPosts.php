<?php
// validation needed
global $conn;
if(isset($_GET['p_id']))
{
   $the_post_id =  $_GET['p_id'];
}

$query = "SELECT * FROM posts where post_id = {$the_post_id} ";

$select_posts_by_id = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($select_posts_by_id))
{
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if(isset($_POST['update_post']))
{
    $is_valid = true;
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image" );

    if($post_title == "" || empty($post_title))
    {
        $is_valid = false;
    }

    if($post_category_id == "" || empty($post_category_id))
    {
        $is_valid = false;
    }

    if($post_author == "" || empty($post_author))
    {
        $is_valid = false;
    }

    if($post_status == "" || empty($post_status))
    {
        $is_valid = false;
    }

    if($post_tags == "" || empty($post_tags))
    {
        $is_valid = false;
    }

    if($post_content == "" || empty($post_content))
    {
        $is_valid = false;
    }

    if(empty($post_image))
    {
        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
        $select_image = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($select_image))
        {
            $post_image = $row['post_image'];
        }
    }
    
    if($is_valid)
    {
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post_query = mysqli_query($conn, $query);

        $_SESSION['created_post_id'] = $the_post_id;

        if(!$update_post_query)
        {
            $_SESSION['postEdited'] = false;
        } else {
            $_SESSION['postEdited'] = true;
        }
    }
    else 
    {
        $_SESSION['postEdited'] = false;
    }
}

if (isset($_SESSION['postEdited']) && $_SESSION['postEdited']) {
?>
    <div class='alert alert-success' role='alert' style='width:-webkit-fit-content;width:-moz-fit-content;  width: fit-content;margin:1em auto 1em 0;'>
        <p class='errorMsg'>
            <strong>Post Created! </strong><a href='../post.php?p_id=<?php echo $_SESSION['created_post_id'] ?>'>View Post</a> or <a href='posts.php'>Edit More Posts</a>
        </p>
    </div>
<?php
    unset($_SESSION['postEdited']);
    unset($_SESSION['created_post_id']);
} elseif (isset($_SESSION['postEdited']) && !$_SESSION['postEdited']) {
?>

    <div class='alert alert-warning alert-dismissible'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p class='errorMsg'>
            Failed to edit post. Please try again!
        </p>
    </div>
<?php
    unset($_SESSION['postEdited']);
}
?>


<h3>Edit Posts</h3>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select name="post_category" id="post_category">
<?php

global $conn;
$query = "SELECT * FROM categories ";
$select_categories = mysqli_query($conn, $query);

if(!$select_categories)
{
    die("QUERY FAILED" . mysqli_error_list($conn));
}

while($row = mysqli_fetch_assoc($select_categories))
{
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='{$cat_id}'>{$cat_title}</option>";
}


?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author" id="post_author">
    </div>


    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
            <option value="<?php echo $post_status ?>"><?php echo $post_status; ?></option>
            
<?php

if($post_status == 'published')
{
    echo "<option value='draft'>Draft</option>";
}
else
{
    echo "<option value='published'>Publish</option>";
}

?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <input type="file" name="post_image">
        <br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
            <?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>