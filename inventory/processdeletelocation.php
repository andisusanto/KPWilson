<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/Location.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   Location::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
header('location:viewlocation.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>