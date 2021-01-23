<?php
addUsers();

if (isset($_SESSION['userAddSuccess']) && $_SESSION['userAddSuccess']) {
?>
    <div class='alert alert-success alert-dismissible' >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p class='errorMsg'>
            <strong>User added: </strong>&nbsp;<a href='users.php'>View users</a>
        </p>
    </div>

<?php
    unset($_SESSION['userAddSuccess']);
} 
elseif(isset($_SESSION['userAddSuccess']) && !$_SESSION['userAddSuccess'])
{
?>
    <div class='alert alert-warning alert-dismissible'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p class='errorMsg'>
            Failed to add user. Please try again!
        </p>
    </div>
<?php
    unset($_SESSION['userAddSuccess']);
}
?>


<h3>Add Users</h3>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="user_role">
            <option value="Subscriber">Select Options</option>
            <option value="Admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>



    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" id="post_image">
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>