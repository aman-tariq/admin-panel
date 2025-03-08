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
                                Edit - Gift Category
                                <a href="category.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <?php
                                if(isset($_GET['id'])){
                                    $categ_id = $_GET['id'];  
                                    $category_query = "SELECT * FROM categories WHERE id = $categ_id";
                                    $category_query_run = mysqli_query($conn, $category_query);

                                    if($category_query_run && mysqli_num_rows($category_query_run) > 0) {
                                        $categitem = mysqli_fetch_assoc($category_query_run); 
                            ?>
                                <input type="hidden" name="categ_id" value="<?= $categitem['id']; ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Category Name</label>
                                        <input type="text" name="name" value="<?= $categitem['name']; ?>"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control"
                                            required><?= $categitem['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Trending</label>
                                        <input type="checkbox" name="trending"
                                            <?= $categitem['trending'] == "1" ? 'checked':''; ?> /> Trending
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="checkbox" name="status"
                                            <?= $categitem['status'] == "1" ? 'checked':''; ?> /> Status
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="category_update"
                                            class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                <?php
                                    } else {
                                        echo "<p class='text-danger'>Category Not Found</p>";
                                    }
                                } else {
                                    echo "<p class='text-danger'>No ID Found</p>";
                                }
                            ?>
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