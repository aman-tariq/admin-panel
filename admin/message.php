<?php
if(isset($_SESSION['status'])){
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <span aria-hidden="true">&times;</span>
    </div>
    <?php
    unset($_SESSION['status']);
}
?>