<?php
    include_once('classes/Admin.php');
    $Conn = Connection::get_DefaultConnection();
    $userName = $_POST['txtUserName'];
    $password = $_POST['txtPassword'];
    try{
        $admin = Admin::GetObjectByUserName($Conn,$userName);
        if($admin != NULL && $admin->ComparePassword($password)){
            session_start();
            $_SESSION['CurrentAdminId'] = $admin->get_Id();
            if($admin->ChangePasswordOnLogIn==TRUE){
                $_SESSION['changepassword'] = TRUE;
            }
            header('location:index.php');
        }else{
            throw new Exception("Username or password does not match!");
        }
    } catch (Exception $e) {
        include('error_handler.php');
    }
?>