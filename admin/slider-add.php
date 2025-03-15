<?php
include('includes/header.php');
include('authentication.php');
include('config/dbcon.php');
include('includes/top-navbar.php');
include('includes/sidebar.php');

?>


<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Add - Sliders
                                <a href="slider.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <?php include('message.php'); ?>

                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Slider Name</label>
                                            <input type="text" name="slider_name" class="form-control"
                                                placeholder="Enter slider name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Path</label>
                                            <input type="text" name="path" class="form-control"
                                                placeholder="Enter Path">
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Upload Slider</label>
                                            <input type="file" name="slider" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Click to Save</label><br>
                                            <button type="submit" name="slider_save"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include('includes/script.php');
?>
<?php
include('includes/footer.php');
?>