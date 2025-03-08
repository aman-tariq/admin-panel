<?php
include('includes/header.php');
include('authentication.php');
include('includes/top-navbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<div class="content-wrapper">

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit - Registered User</li>
                        <!-- Button to trigger modal -->
                        <a href="registered.php" class="btn btn-sm btn-danger mx-3">BACK</a>
                    </ol>

                </div>
                <div class="card-body">
                    <div class="row mx-2">
                        <div class="col-md-6">
                            <form action="code.php" method="POST">
                                <?php
                                    if(isset($_GET['user_id']))
                                    {
                                        $user_id = $_GET['user_id'];
                                        $query = "select * from `users` where id='$user_id' LIMIT 1";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                <input type="text" name="user_id" value="<?php echo $row['id'] ?>" hidden>
                                <div class="form-group">
                                    <b><label for="name">Name</label></b>
                                    <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" id="name"
                                        placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <b><label for="email">Email</label></b>
                                    <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" id="email"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <b><label for="phone">Phone Number</label></b>
                                    <input type="text" name="phone" value="<?php echo $row['phone'] ?>" class="form-control" id="phone"
                                        placeholder="Enter phone number">
                                </div>
                                <div class="form-group">
                                    <b><label for="password">Password</label></b>
                                    <input type="password" name="password" value="<?php echo $row['password'] ?>" class="form-control" id="password"
                                        placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label for="">Give Role</label>
                                    <select name="role_as" id="" class="form-control" required>
                                        <option value="">select</option>
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <b><label for="status">Status</label></b>
                                    <select class="form-control" name="status" value="<?php echo $row['password'] ?>" id="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <?php
                                            }

                                        }
                                        else{
                                            echo "<h4>No Record Found</h4>";
                                        }
                                    }
                                ?>


                                <div class="modal-footer">
                                    <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit - Registered User</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/script.php');
?>
<?php
include('includes/footer.php');
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>