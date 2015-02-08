<?php
include_once('../classes/ItemLocationHistory.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ItemLocationHistory = ItemLocationHistory::GetObjectByKey($Conn, $_POST['Id']);
   $ItemLocationHistory->Since = $_POST['Since'];
$ItemLocationHistory->Until = $_POST['Until'];
$ItemLocationHistory->Item = $_POST['Item'];
$ItemLocationHistory->Location = $_POST['Location'];

   $ItemLocationHistory->Update();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>