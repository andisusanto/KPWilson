<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/Location.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = Location::GetObjectByKey($Conn, $_POST['Id']);
   $Location->Code = $_POST['Code'];
$Location->Name = $_POST['Name'];
$Location->ContactNumber = $_POST['ContactNumber'];
$Location->Address = $_POST['Address'];
$Location->Type = $_POST['Type'];

   $Location->Update();
   $Conn->Commit();
   header('location:viewlocation.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>