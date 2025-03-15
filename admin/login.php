<?php 

include('includes/header.php'); 

if(isset($_SESSION['auth'])){
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
include('authentication.php'); 

?>




<div class="card shadow-lg p-4"
    style="width: 350px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <h3 class="text-center mb-4">Login</h3>
    <?php include('message.php'); ?>
    <?php
        if(isset($_SESSION['auth_status'])){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?php echo $_SESSION['auth_status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
            </div>
            <?php
            unset($_SESSION['auth_status']);
        }
?>
    <form action="logincode.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" name="login_Btn" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
        <a href="registered.php">Create an account</a>
    </div>
</div>



<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>