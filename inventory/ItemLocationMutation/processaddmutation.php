<?php
include_once('../classes/ItemLocationMutation.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ItemLocationMutation = new ItemLocationMutation($Conn);
   $ItemLocationMutation->ToLocation = $_POST['ToLocation'];
$ItemLocationMutation->EffectiveDate = $_POST['EffectiveDate'];
$ItemLocationMutation->Item = $_POST['Item'];

   $ItemLocationMutation->Save();
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>