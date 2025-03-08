<?php
include('includes/header.php');
include('authentication.php');
include('config/dbcon.php');
include('includes/top-navbar.php');
include('includes/sidebar.php');

?>
<!-- model pop-up -->
            
<div class="modal fade" id="categoryModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
                include('message.php');    
            ?>
    <div class="modal-dialog">
            
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trending</label>
                            <input type="checkbox" name="trending">Trending
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="checkbox" name="status">Status
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="category_save" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Gift Category
                                <a href="#" data-bs-toggle="modal" data-bs-target="#categoryModel"
                                    class="btn btn-primary float-end">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Trending</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($conn, $query);
                                        if ($query_run) {
                                            while ($categitem = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $categitem['id']; ?></td>
                                                    <td><?= $categitem['name']; ?></td>
                                                    
                                                    <td><input type="checkbox" name="trending" <?= $categitem['trending'] == '1' ? 'checked':'' ?> readonly /></td>
                                                    <td><input type="checkbox" name="status" <?= $categitem['status'] == '1' ? 'checked':'' ?> readonly /></td>
                                                    <td><?= $categitem['created_at']; ?></td>
                                                    <td><a href="category-edit.php?id=<?= $categitem['id']; ?>" class="btn btn-success">Edit</a></td>
                                                    <td><a href="#" class="btn btn-danger">Delete</a></td>
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