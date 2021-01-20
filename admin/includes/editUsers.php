<?php

global $conn;

if(isset($_GET['edit']))
{
    $user_id = $_GET['edit'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id} ";
    $select_users = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_users))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if(isset($_POST['edit_user']))
{
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    // $user_image = $_POST['user_image'];
    $user_role = $_POST['user_role'];
    

    if($user_firstname == "" || empty($user_firstname))
    {
        echo "this field should not be empty"."<br>";
    }

    if($user_lastname == "" || empty($user_lastname))
    {
        echo "this field should not be empty"."<br>";
    }

    if($user_role == "" || empty($user_role))
    {
        echo "this field should not be empty"."<br>";
    }

    if($username == "" || empty($username))
    {
        echo "this field should not be empty"."<br>";
    }

    if($user_email == "" || empty($user_email))
    {
        echo "this field should not be empty"."<br>";
    }

    if($user_password == "" || empty($user_password))
    {
        echo "this field should not be empty"."<br>";
    }

    else
    {
        # Fetch the salt
        $query = "SELECT randSalt FROM users";
    
        $select_randsalt_query = mysqli_query($conn, $query);
    
        if (!$select_randsalt_query) {
    
            die("Query Failed" . mysqli_error($conn));
    
        }
    
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt); 

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id} ";

        $update_user_query = mysqli_query($conn, $query);

        if(!$update_user_query)
        {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        else{
            echo "Updated succesfully";
        }

    }

}

?>

<h3>Edit Users</h3>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" id="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" id="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select  name="user_role" id="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<?php

if($user_role == 'Admin')
{
    echo "<option value='Subscriber'>Subscriber</option>";
}

else
{
    echo "<option value='Admin'>Admin</option>";
}

?>

        </select>
    </div>

    

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" id="post_image">
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>