<?php
include('config/dbcon.php');
include('authentication.php');

if(isset($_POST['login_Btn'])){
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $log_query = "SELECT * FROM `users` WHERE email='$email' AND password='$password' LIMIT 1";
    $log_query_run = mysqli_query($conn, $log_query);

    if(mysqli_num_rows($log_query_run)>0){
        $row = mysqli_fetch_assoc($log_query_run);
        
        $user_id = $row['id'];
        $user_name = $row['name'];
        $user_email = $row['email'];
        $user_phone = $row['phone'];
        $role_as = $row['role_as'];  // Assuming 1 = Admin, 0 = User
        $user_status = $row['status'];
    
        $_SESSION['auth'] = $role_as;
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_phone' => $user_phone,
            'user_status' => $user_status
        ];
    
        $_SESSION['status'] = "Login successful";
    
        if($role_as == 1){
            header('Location: index.php');  // Redirect Admin
        } else {
            header('Location: ../index.php');  // Redirect Normal User
        }
        exit();
    }
    

    else{
        $_SESSION['status'] = "invalid email/password";
        header('Location: login.php');
    }
}
else{
    $_SESSION['status'] = "Login Failed";
    header('Location: login.php');
}

?>