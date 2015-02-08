<?php
include_once('classes/Location.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = new Location($Conn);
   $Location->Code = $_POST['Code'];
$Location->Name = $_POST['Name'];
$Location->IsActive = 1;
$Location->ContactNumber = $_POST['ContactNumber'];
$Location->Address = $_POST['Address'];
$Location->Type = $_POST['Type'];


   $Location->Save();
   $Conn->Commit();
   header('location:viewlocation.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>