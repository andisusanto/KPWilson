<?php
include_once('../classes/Item.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Item = new Item($Conn);
   $Item->Name = $_POST['Name'];
$Item->AdditionalInfo = $_POST['AdditionalInfo'];
$Item->Status = $_POST['Status'];
$Item->Code = $_POST['Code'];

   $Item->Save();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>