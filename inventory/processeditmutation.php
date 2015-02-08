<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/ItemLocationMutation.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ItemLocationMutation = ItemLocationMutation::GetObjectByKey($Conn, $_POST['Id']);
   $ItemLocationMutation->ToLocation = $_POST['ToLocation'];
	$ItemLocationMutation->EffectiveDate = $_POST['EffectiveDate'];
	$ItemLocationMutation->Item = $_POST['Item'];
	$ItemLocationMutation->Code = $_POST['Code'];
	$ItemLocationMutation->Note = $_POST['Note'];
	$ItemLocationMutation->TransDate = $_POST['TransDate'];
	$ItemLocationMutation->Admin = $_SESSION['CurrentAdminId'];

   $ItemLocationMutation->Update();
   $Conn->Commit();
   header('location:viewmutation.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>