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
                                Gift Products
                                <a href="product-add.php" class="btn btn-primary float-end">Add</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $query = "SELECT * FROM products";
                                        $query_run = mysqli_query($conn, $query);
                                        if ($query_run) {
                                            while ($categitem = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                    <tr>
                                        <td><?= $categitem['id']; ?></td>
                                        <td><?= $categitem['name']; ?></td>
                                        <td><?= $categitem['price']; ?></td>

                                        <td><input type="checkbox" name="status"
                                                <?= $categitem['status'] == '1' ? 'checked':'' ?> readonly /></td>
                                        <td><?= $categitem['created_at']; ?></td>
                                        <td><a href="product-edit.php?id=<?= $categitem['id']; ?>"
                                                class="btn btn-success">Edit</a></td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="product_delete_id"
                                                    value="<?= $categitem['id']; ?>">
                                                <button type="submit" name="product_delete_btn"
                                                    class="btn btn-danger">Delete</button>
                                            </form>

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