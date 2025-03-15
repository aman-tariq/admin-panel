<?php
include('config/dbcon.php');
include('authentication.php');

if(isset($_POST['slider_save'])){
    $slider_name = $_POST['slider_name'];
    $block = $_POST['block'];
    $image = $_FILES['slider']['name'];

    $allowed_extension = array('jpg', 'jpeg', 'png');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$file_extension;

    if(!in_array($file_extension, $allowed_extension)){
        $_SESSION['status'] = "You are allowed only jpg, jpeg, png images";
        header('Location: slider-add.php');
        exit(0);
    } else {
        $query = "INSERT INTO `sliders` (`slider_name`, `block`, `path`) 
                  VALUES ('$slider_name', '$block', '$filename')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            move_uploaded_file($_FILES['slider']['tmp_name'], "uploads/products/".$filename);
            $_SESSION['status'] = "Slider added successfully";
            header('Location: sliders.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Slider not added";
            header('Location: slider-add.php');
            exit(0);
        }
    }
}
if(isset($_POST['slider_update'])){

    $slider_id = $_POST['slider_id'];
    $slider_name = $_POST['name'];
    $block = $_POST['block'];
    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($image != '') {
        $allowed_extension = array('jpg', 'jpeg', 'png');
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $file_extension;

        if(!in_array($file_extension, $allowed_extension)) {
            $_SESSION['status'] = "Only JPG, JPEG, PNG formats are allowed";
            header('Location: sliders-edit.php?id='.$slider_id);
            exit(0);
        }

        // ✅ Move the uploaded file
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products/" . $filename);

        // ✅ Delete old image if exists
        if(file_exists("uploads/products/" . $old_image)) {
            unlink("uploads/products/" . $old_image);
        }

        $update_filename = $filename;
    } else {
        $update_filename = $old_image;
    }

    // ✅ Update query
    $query = "UPDATE `sliders` SET `slider_name`='$slider_name', `block`='$block', `image`='$update_filename' WHERE `id`='$slider_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        $_SESSION['status'] = "Slider updated successfully";
        header('Location: sliders-edit.php?id='.$slider_id);
        exit(0);
    } else {
        $_SESSION['status'] = "Slider not updated";
        header('Location: sliders-edit.php?id='.$slider_id);
        exit(0);
    }
}



if(isset($_POST['product_update'])){
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'];
    $tax = $_POST['tax'];
    $quantity = $_POST['quantity'];
    $status = isset($_POST['status']) == true ? '1' : '0';
    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($image != ''){
        $update_filename = $_FILES['image']['name'];

        $allowed_extension = array('jpg', 'jpeg', 'png');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$file_extension;

    if(!in_array($file_extension, $allowed_extension)){
        $_SESSION['status'] = "You are allowed only jpg, jpeg, png images";
        header('Location: product-edit.php');
        exit(0);
    }
    $update_filename = $filename;
    }
    else{
        $update_filename = $old_image;
    }

    $query = "UPDATE `products` SET `category_id`='$category_id', `name`='$name', `small_description`='$small_description', `long_description`='$long_description', `price`='$price', `offerprice`='$offerprice', `tax`='$tax', `quantity`='$quantity', `image`='$update_filename', `status`='$status' WHERE `id`='$product_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run){
        if($image != ''){
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products".$filename);
            if(file_exists("uploads/products/".$old_image)){
                unlink("uploads/products/".$old_image);
            }
        }
        $_SESSION['status'] = "Product updated successfully";
        header('Location: product-edit.php?id='.$product_id);
        exit(0);
    }
    else{
        $_SESSION['status'] = "Product not updated";
        header('Location: product-edit.php?product_id='.$product_id);
        exit(0);
    }
}

if(isset($_POST['product_save'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $small_description = $_POST['small_description'];
    $long_description = $_POST['long_description'];
    $price = $_POST['price'];
    $offerprice = $_POST['offerprice'];
    $tax = $_POST['tax'];
    $quantity = $_POST['quantity'];
    $status = isset($_POST['status']) == true ? '1' : '0';
    $image = $_FILES['image']['name'];

    $allowed_extension = array('jpg', 'jpeg', 'png');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$file_extension;

    if(!in_array($file_extension, $allowed_extension)){
        $_SESSION['status'] = "You are allowed only jpg, jpeg, png images";
        header('Location: product.php');
        exit(0);
    }
    else{
        $query = "INSERT INTO `products` (`category_id`, `name`, `small_description`, `long_description`, `price`, `offerprice`, `tax`, `quantity`,`image`, `status`) 
                  VALUES ('$category_id', '$name', '$small_description', '$long_description', '$price', '$offerprice', '$tax', $quantity, '$filename', '$status')";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/products".$filename);
            $_SESSION['status'] = "Product added successfully";
            header('Location: product.php');
            exit(0);
        }
        else{
            $_SESSION['status'] = "Product not added";
            header('Location: product.php');
            exit(0);
        }
    }

}
if(isset($_POST['product_delete_btn'])){
    $categ_id = $_POST['product_delete_id'];
    $query = "DELETE FROM `products` WHERE `id`='$categ_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['status'] = "Product deleted successfully";
    } else {
        $_SESSION['status'] = "Product deletion failed";
    }
    header("location: product.php");
    exit(0);
}



if(isset($_POST['category_save'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = isset($_POST['trending']) ? '1' : '0';
    $status = isset($_POST['status']) ? '1' : '0';


    $category_query = "INSERT INTO `categories` (`name`, `description`, `trending`, `status`) 
                        VALUES ('$name', '$description', '$trending', '$status')";
    $category_query_run = mysqli_query($conn, $category_query);
    if($category_query_run){
        $_SESSION['status'] = "Category added successfully";
        header("location: category.php");
    }
    else{
        $_SESSION['status'] = "Category not added: ";
        header("location: category.php");
    }
}

if(isset($_POST['category_update'])){
    $categ_id = $_POST['categ_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $trending = isset($_POST['trending']) ? '1' : '0';
    $status = isset($_POST['status']) ? '1' : '0';

    $category_query = "UPDATE `categories` SET `name`='$name', `description`='$description', `trending`='$trending', `status`='$status' WHERE `id`='$categ_id'";
    $category_query_run = mysqli_query($conn, $category_query);

    if($category_query_run){
        $_SESSION['status'] = "Category updated successfully";
        header("location: category.php");
        exit;
    }
    else{
        $_SESSION['status'] = "Category not updated: " . mysqli_error($conn);
        header("location: category.php");
        exit;
    }
}

if(isset($_POST['cate_delete_btn'])){
    $categ_id = $_POST['cate_delete_id'];
    $query = "DELETE FROM `categories` WHERE `id`='$categ_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['status'] = "Category deleted successfully";
        header("location: category.php");
    }
    else{
        $_SESSION['status'] = "Category deletion failed: ";
        header("location: category.php");
    }
}


if(isset($_POST['logout_btn'])){
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    header('Location: login.php');

    $_SESSION['status'] = "You are logged out";
    header('Location: login.php');
    exit(0);
}

if (isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Insert the user data into the database
    $sql = "INSERT INTO `users` (`name`, `email`, `phone`, `password`, `status`) 
            VALUES ('$name', '$email', '$phone', '$password', '$status')";
    
    // Execute the query using $conn object
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User added successfully";
        header("location: registered.php");
    } else {
        $_SESSION['status'] = "User not added: " . $conn->error;
        header("location: registered.php");
    }
}

if(isset($_POST['updateUser'])){
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'];

    // Update the user data in the database
    $query = "UPDATE `users` SET `name`='$name', `email`='$email', `phone`='$phone', `password`='$password',`role_as`='$role_as' ,`status`='$status' WHERE `id`='$user_id'";
    $user_query_run = mysqli_query($conn, $query);
   
    if($user_query_run){
        $_SESSION['success'] = "User updated successfully";
        header("location: registered.php");
    } else {
        $_SESSION['status'] = "User not updated: " . $conn->error;
        header("location: registered.php");
    }
}

if(isset($_POST['deleteUserBtn'])){
    $user_id = $_POST['delete_id']; // Fetch user ID from form

    if(!empty($user_id)) {
        $query = "DELETE FROM `users` WHERE `id`='$user_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            $_SESSION['success'] = "User deleted successfully";
        } else {
            $_SESSION['status'] = "User deletion failed: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['status'] = "Invalid user ID!";
    }
    header("Location: registered.php");
    exit();
}

?>