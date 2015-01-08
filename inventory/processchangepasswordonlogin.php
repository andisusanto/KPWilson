<?php
    include_once('checklogin.php');
?>
<?php
    try{
        $password = $_POST['txtPassword'];
        $confirmpassword = $_POST['txtConfirmPassword'];
        if ($password == $confirmpassword){
            include_once('classes/Admin.php');
            include_once('classes/Connection.php');
            $Conn = Connection::get_DefaultConnection();
            $tmpAdmin = Admin::GetObjectByKey($Conn,$_SESSION['CurrentAdminId']);
            $tmpAdmin->SetPassword($password);
            $tmpAdmin->ChangePasswordOnLogIn = FALSE;
            $tmpAdmin->Update();
            $Conn->Commit();
            unset($_SESSION['changepassword']);
            header('location:index.php');
        }else{
            throw new Exception();
        }
    } catch (Exception $e) {
        include('error_handler.php');
    }

?>