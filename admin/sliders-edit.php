<?php
include('includes/header.php');
include('authentication.php');
include('config/dbcon.php');
include('includes/top-navbar.php');
include('includes/sidebar.php');

?>

<div class="content-wrapper">

<?php
if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $query = "SELECT * FROM sliders WHERE id = $product_id";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run)>0){
        $prodItem = mysqli_fetch_array($query_run);
        ?>


    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit - Sliders
                                <a href="product.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <?php include('message.php'); ?>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="slider_id" value="<?=$prodItem['id']?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Select Category</label>
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $query_run = mysqli_query($conn, $query);
                                             if(mysqli_num_rows($query_run) > 0){
                                                foreach($query_run as $items){
                                                    ?>
                                                        <select name="category_id" class="form-control">
                                                            <?php foreach($query_run as $item){ ?>
                                                                <option value="<?= $item['id'] ?>">  <?= $prodItem['category_id'] == $item['id'] ? 'selected':'' ?>
                                                                    <?= $item['name'] ?></option>
                                                           <?php } ?>
                                                        </select> 
                                                    <?php
                                                }
                                             }
                                        ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php include('message.php'); ?>
                                        <div class="form-group">
                                            <label for="">Slider Name</label>
                                            <input type="text" name="name" value="<?=$prodItem['slider_name']?>" class="form-control"
                                                placeholder="Enter product name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">block</label>
                                            <input type="text" name="block" value="<?=$prodItem['block']?>" class="form-control"
                                                placeholder="Enter block">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <input type="hidden" name="old_image" value="<?=$prodItem['image']?>">
                                        </div>
                                        <img src="uploads/products<?=$prodItem['image']?>" width="50px" height="50px" alt="image">
                                    </div>
                                    
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Click to Save</label><br>
                                            <button type="submit" name="slider_update"
                                                class="btn btn-primary">Update</button>
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

    <?php
    }
    else{
        echo "<p class='text-danger'>Product Not Found</p>";
    }
}
?>
</div>



<?php
include('includes/script.php');
?>
<?php
include('includes/footer.php');
?>