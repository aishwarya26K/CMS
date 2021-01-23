<!-- Blog sidebar widgets column -->
<div class="col-md-4">




<!-- Blog Search Well -->
<div class="well">
    <h4>Search By Tags</h4>
    <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- login -->
<div class="well">
    <h4>Admin Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username"> 
        </div>
        <div class="form-group">
            <span class="text-info">eg: admin</span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit
                    </button>
                </span> 
            </div>
        </div>
        <div class="form-group">
            <span class="text-info">eg: admin</span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

<?php

$query = "SELECT * FROM categories";
$select_categories_sidebar = mysqli_query($conn, $query);


?>

    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
<?php

while($row = mysqli_fetch_assoc($select_categories_sidebar))
{
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
}

?>

            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>