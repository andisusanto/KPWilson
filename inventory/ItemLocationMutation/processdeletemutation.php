<?php
include_once('../classes/ItemLocationMutation.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   ItemLocationMutation::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:index.php');
} catch (Exception $e) {
   include('../error_handler.php');
}
?>