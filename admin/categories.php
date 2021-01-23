<?php include "includes/adminHeader.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                        
                        <div class="col-xs-6">

<?php 

addCategories(); 

if (isset($_SESSION['addCategories']) && $_SESSION['addCategories']) 
{
    ?>
        <div class='alert alert-success alert-dismissible'>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p class='errorMsg'>
                <strong>Category Added </strong>
            </p>
        </div>
    <?php
        unset($_SESSION['addCategories']);
    } elseif (isset($_SESSION['addCategories']) && !$_SESSION['addCategories']) {
    ?>
    
        <div class='alert alert-warning alert-dismissible'>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p class='errorMsg'>
                Failed to add Category. Please try again!
            </p>
        </div>
    <?php
        unset($_SESSION['addCategories']);
    }
    ?>


                            <form action="" method="post">
                                    <div class="form-group">
                                        <label for="cat_title">Add Category</label>
                                        <input class="form-control" type="text" name="cat_title" id="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Add Category" name="submit">
                                    </div>
                            </form>

<?php

if(isset($_GET['edit']))
{
    $cat_id = $_GET['edit'];

    include "includes/editCategories.php";
}


?>                            

                        </div><!--Add Category Form-->

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>

<?php findCategories(); ?>

<?php deleteCategories(); ?>

                                </tbody>
                            </table>
                        </div><!--table-->
                        
                    </div>
                    <!--/.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adminFooter.php"; ?>
