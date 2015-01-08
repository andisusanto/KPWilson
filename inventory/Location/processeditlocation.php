<?php
include_once('../classes/Location.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = Location::GetObjectByKey($Conn, $_POST['Id']);
   $Location->Code = $_POST['Code'];
$Location->Name = $_POST['Name'];
$Location->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;

   $Location->Update();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>