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

<?php addCategories(); ?>


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
                                        <th></th>
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
