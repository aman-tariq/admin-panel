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
                                Sliders
                                <a href="slider-add.php" class="btn btn-primary float-end">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Slider Name</th>
                                        <th>Block</th>
                                        <th>Path</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $query = "SELECT * FROM sliders";
                                        $query_run = mysqli_query($conn, $query);
                                        if ($query_run) {
                                            while ($sliderImage = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $sliderImage['id']; ?></td>
                                                    <td><?= $sliderImage['slider_name']; ?></td>
                                                    <td><?= $sliderImage['block']; ?></td>
                                                    <td><?= $sliderImage['path']; ?></td>
                                                    <td><a href="sliders-edit.php?id=<?= $sliderImage['id']; ?>" class="btn btn-success">Edit</a></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="7">No data found</td>
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
    </section>
</div>

<?php
include('includes/script.php');
?>
<?php
include('includes/footer.php');
?>

