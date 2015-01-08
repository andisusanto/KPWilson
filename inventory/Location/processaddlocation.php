<?php
include_once('../classes/Location.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = new Location($Conn);
   $Location->Code = $_POST['Code'];
$Location->Name = $_POST['Name'];
$Location->IsActive = ($_POST['IsActive'] == 'on') ? 1 : 0;

   $Location->Save();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>