<?php
//approving comments
function approveComments()
{
    global $conn;
    if(isset($_GET['approve']))
    {
        $comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id} ";

        $approve_comments_query = mysqli_query($conn,$query);

        header("Location: comments.php "); 
        exit;

        if(!$approve_comments_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }
    }
}

//unapproving comments
function unapproveComments()
{
    global $conn;
    if(isset($_GET['unapprove']))
    {
        $comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id} ";

        $unapprove_comments_query = mysqli_query($conn,$query);

        header("Location: comments.php "); 
        exit;

        if(!$unapprove_comments_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }
    }
}

//delete comments
function deleteComments()
{
    global $conn;
    if(isset($_GET['delete']))
    {
        // $post_id = $_GET['p_id'];
        $comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";

        $delete_comments_query = mysqli_query($conn,$query);


        if(!$delete_comments_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        // $query = "UPDATE posts SET post_comment_count= post_comment_count - 1 ";
        // $query .= "WHERE post_id = {$post_id} ";

        header("Location: comments.php "); 
        exit;
    }
}
//display comments
function displayComments()
{
    global $conn;
    $query = "SELECT * FROM comments ORDER by comment_id DESC ";
    $select_comments_query = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_comments_query))
    {
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
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";


        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";

        $select_post_id_query = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_post_id_query))
        {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }
        echo "<td>$comment_date</td>";

        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
        echo "</tr>";    

    }
}


//adding category
function addCategories()
{
    global $conn;
    if(isset($_POST['submit']))
    {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title))
        {
            echo "this field should not be empty";
        }
        else
        {

            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES ('{$cat_title}') ";

            $create_category_query = mysqli_query($conn,$query);

            header("Location: categories.php");
            exit;

            if(!$create_category_query)
            {
                die("QUERY FAILED" . mysqli_error($conn));
            }

        }
    }

}

//find all categories
function findCategories()
{
    global $conn;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_categories))
    {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";


    }
}

//delete categories
function deleteCategories()
{
    global $conn;
    if(isset($_GET['delete']))
    {
        $cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";

        $delete_category_query = mysqli_query($conn, $query);

        header("Location: categories.php");
        exit;

        if(!$delete_category_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        else{
            echo "DELETED SUCCESSFULLY";
        }
    }
}


//delete posts
function deletePosts()
{
    global $conn;
    if(isset($_GET['delete']))
    {
        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$post_id} ";

        $delete_posts_query = mysqli_query($conn,$query);

        header("Location: posts.php "); 
        exit;

        if(!$delete_posts_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }        
    }
}

//displayposts
function displayPosts()
{
    global $conn;
    $query = "SELECT * FROM posts";
    $select_posts_query = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_posts_query))
    {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $select_categories_id = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_categories_id))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];


        echo "<td>{$cat_title}</td>";


        }

        echo "<td>$post_status</td>";
        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td><a href='posts.php?source=editPosts&p_id={$post_id}'>Edit</a></td>";
        echo "</tr>";

    }
}

?>