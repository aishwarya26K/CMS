<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <!-- <th>Date</th> -->
            </tr>
        </thead>
        <tbody>
                                
<?php displayUsers(); ?>
                                
        </tbody>
    </table>

<?php deleteUsers(); ?>

<?php changeToAdmin(); ?>

<?php changeToSubscriber(); ?>