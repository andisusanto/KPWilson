<?php
include_once('../classes/Item.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Item = Item::GetObjectByKey($Conn, $_POST['Id']);
   $Item->Name = $_POST['Name'];
$Item->AdditionalInfo = $_POST['AdditionalInfo'];
$Item->Status = $_POST['Status'];
$Item->Code = $_POST['Code'];

   $Item->Update();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>