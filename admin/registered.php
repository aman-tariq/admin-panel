<?php
include('includes/header.php');
include('authentication.php');
include('includes/top-navbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">
    
    <!-- Modal Structure -->
    <div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to add user details -->
                    <form action="code.php" method="POST">
                        <div class="form-group">
                            <b><label for="name">Name</label></b>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <b><label for="email">Email</label></b>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <b><label for="phone">Phone Number</label></b>
                            <input type="text" name="phone" class="form-control" id="phone"
                                placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <b><label for="password">Password</label></b>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <b><label for="status">Status</label></b>
                            <select class="form-control" name="status" id="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addUser" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete user modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalTitle">Delete User</h5>
                <button type="button" class="close mx-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="deleteUserId">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteUserBtn" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registered User</li>
                        <!-- Button to trigger modal -->
                        <a href="#" class="btn btn-sm btn-primary mx-3" data-toggle="modal" data-target="#addUserModel">Add
                            User</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                    if (isset($_SESSION['success'])) {
                        echo "<h4>" . $_SESSION['success'] . "</h4>";
                        unset($_SESSION['success']);
                    }

                    if (isset($_SESSION['status'])) {
                        echo "<h4>" . $_SESSION['status'] . "</h4>";
                        unset($_SESSION['status']);
                    }
                ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>role as</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM `users`";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach($query_run as $row){
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php 
                                                        if($row['role_as']==1){
                                                            echo "Admin";
                                                        }
                                                        elseif($row['role_as']==0){
                                                            echo "User";
                                                        }
                                                        else{
                                                            echo "invalid user";
                                                        }
                                                    ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <td>
                                                        <a href="registered-edit.php?user_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <button type ="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                                    </td> 
                                                </tr>
                                            
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td>No Record Found</td>
                                        </tr>
                                        <?php
                                    }   
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
<script>
    $(document).ready(function() {
    $('.deletebtn').click(function(e) {
        e.preventDefault();
        
        var user_id = $(this).val();
        console.log("User ID to delete:", user_id); // Debugging
        
        $('#deleteUserId').val(user_id); // Set user ID in hidden input
        $('#deleteUserModal').modal('show'); // Show modal
    });
});

</script>

<?php
include('includes/script.php');
?>

<!-- jQuery
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- jQuery (full version, NOT slim) -->
