<?php
//change to admin
function changeToAdmin()
{
    global $conn;
    if(isset($_GET['change_to_admin']))
    {
        $user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id} ";

        $change_to_admin_query = mysqli_query($conn,$query);

        if(!$change_to_admin_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        header("Location: users.php "); 
        exit;
    }
}

//change to subscriber
function changeToSubscriber()
{
    global $conn;
    if(isset($_GET['change_to_sub']))
    {
        $user_id = $_GET['change_to_sub'];

        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$user_id} ";

        $change_to_subscriber_query = mysqli_query($conn,$query);

        if(!$change_to_subscriber_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        header("Location: users.php "); 
        exit;
    }
}


//delete users
function deleteUsers()
{
    global $conn;
    if(isset($_GET['delete']))
    {
        $user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$user_id} ";

        $delete_users_query = mysqli_query($conn,$query);


        if(!$delete_users_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        header("Location: users.php "); 
        exit;
    }
}


//add users
function addUsers()
{
    global $conn;
    if(isset($_POST['create_user']))
    {
        $is_valid = true;
        // $user_id = $_POST['user_id'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // $post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];



        // move_uploaded_file($post_image_temp,"../images/$post_image" );

        if($user_firstname == "" || empty($user_firstname))
        {
            $is_valid = false;
        }
    
        if($user_lastname == "" || empty($user_lastname))
        {
            $is_valid = false;
        }
    
        if($user_role == "" || empty($user_role))
        {
            $is_valid = false;
        }
    
        if($username == "" || empty($username))
        {
            $is_valid = false;
        }
    
        if($user_email == "" || empty($user_email))
        {
            $is_valid = false;
        }
    
        if($user_password == "" || empty($user_password))
        {
            $is_valid = false;
        }

        if($is_valid)
        {

            $query = "INSERT INTO users(user_firstname, user_lastname,
            user_role, username, user_email, user_password) ";
    
            $query .= "VALUES('{$user_firstname}','{$user_lastname}',
            '{$user_role}','{$username}','{$user_email}','{$user_password}' ) ";
    
            $create_user_query = mysqli_query($conn, $query);

            if(!$create_user_query)
            {
                $_SESSION['userAddSuccess'] = false;
            } else {
                $_SESSION['userAddSuccess'] = true;
            }

            header("Location: users.php?source=addUsers ");
            exit;

        } else {
            $_SESSION['userAddSuccess'] = false;
        }
    }
}


//display users
function displayUsers()
{
    global $conn;
    $query = "SELECT * FROM users ORDER by user_id DESC ";
    $select_users_query = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_users_query))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_password</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "<td><a href='users.php?source=editUsers&edit={$user_id}'>Edit</a></td>";
        echo "</tr>";   


        // $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";

        // $select_post_id_query = mysqli_query($conn, $query);

        // while($row = mysqli_fetch_assoc($select_post_id_query))
        // {
        //     $post_id = $row['post_id'];
        //     $post_title = $row['post_title'];

        //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        // }
        // echo "<td>$comment_date</td>";

         

    }
}


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
        $post_id = $_GET['p_id'];
        $comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";

        $delete_comments_query = mysqli_query($conn,$query);


        if(!$delete_comments_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        $query = "UPDATE posts SET post_comment_count= post_comment_count - 1 ";
        $query .= "WHERE post_id = {$post_id} ";

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
        $is_valid = true;
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title))
        {
            $is_valid = false;
        }
        if($is_valid)
        {

            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES ('{$cat_title}') ";

            $create_category_query = mysqli_query($conn,$query);

            header("Location: categories.php");
            exit;

            if(!$create_category_query)
            {
                $_SESSION['addCategories'] = false;
            }
            else
            {
                $_SESSION['addCategories'] = true;
            }

        }
        else {
            $_SESSION['addCategories'] = false;
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

//add posts
function addPosts()
{
    global $conn;
    if(isset($_POST['create_post']))
    {
        $is_valid = true;
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');


        move_uploaded_file($post_image_temp,"../images/$post_image" );

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

        if(empty($post_image))
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

        if($is_valid)
        {
            $query = "INSERT INTO posts(post_category_id, post_title, post_author,
            post_date, post_image, post_content, post_tags, post_status) ";

            $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}',
            '{$post_content}','{$post_tags}','{$post_status}' ) ";

            $add_posts_query = mysqli_query($conn, $query);

            $the_post_id = mysqli_insert_id($conn);
            $_SESSION['created_post_id'] = $the_post_id;
            if(!$add_posts_query)
            {
                $_SESSION['addPostStatus'] = false;
            }
            else
            {
                $_SESSION['addPostStatus'] = true;
            }

            header("Location: posts.php?source=addPosts "); 
            exit;
        } else {
            $_SESSION['addPostStatus'] = false;
        }
    }
}

?>