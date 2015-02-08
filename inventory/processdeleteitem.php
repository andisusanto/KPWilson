<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/Item.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Item::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
 header('location:viewitem.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>