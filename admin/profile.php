<?php include "includes/adminHeader.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        // $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['update_profile'])) {
    $is_valid = true;
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    // $user_image = $_POST['user_image'];
    $user_role = $_POST['user_role'];


    if ($user_firstname == "" || empty($user_firstname)) {
        $is_valid = false;
    }

    if ($user_lastname == "" || empty($user_lastname)) {
        $is_valid = false;
    }

    if ($user_role == "" || empty($user_role)) {
        $is_valid = false;
    }

    if ($username == "" || empty($username)) {
        $is_valid = false;
    }

    if ($user_email == "" || empty($user_email)) {
        $is_valid = false;
    }

    if ($user_password == "" || empty($user_password)) {
        $is_valid = false;
    }

    if ($is_valid) {

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE username = '{$username}' ";

        $update_profile_query = mysqli_query($conn, $query);

        if (!$update_profile_query) {
            $_SESSION['profileUpdated'] = false;
        } else {
            $_SESSION['profileUpdated'] = true;
        }
    } else {
        $_SESSION['profileUpdated'] = false;
    }
}

?>
<div id="wrapper">
<?php
if (isset($_SESSION['profileUpdated']) && $_SESSION['profileUpdated']) {
?>
    <div class='alert alert-success alert-dismissible'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div>
            <strong>Profile updated</strong>
        </div>        
    </div>
<?php
    unset($_SESSION['profileUpdated']);
} elseif (isset($_SESSION['profileUpdated']) && !$_SESSION['profileUpdated']) {
?>

    <div class='alert alert-warning alert-dismissible'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p class='errorMsg'>
            Failed to update profile. Please try again!
        </p>
    </div>
<?php
    unset($_SESSION['profileUpdated']);
}
?>

    <!-- Navigation -->
    <?php include "includes/adminNavigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>


                    <h3>Profile</h3>

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
                            <select name="user_role" id="user_role">
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php

                                if ($user_role == 'Admin') {
                                    echo "<option value='Subscriber'>Subscriber</option>";
                                } else {
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
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                        </div>
                    </form>

                </div>
                <!--/.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/adminFooter.php"; ?>