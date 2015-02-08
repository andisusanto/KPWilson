<?php
include_once('../classes/ItemLocationHistory.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   ItemLocationHistory::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>