<?php
session_start();
include_once('classes/SpoiledItem.php');
include_once('classes/Item.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
	
	$SpoiledItem = new SpoiledItem($Conn);
	$SpoiledItem->Item = $_POST['ItemId'];
	$SpoiledItem->TransDate = $_POST['TransDate'];
	$SpoiledItem->Note = $_POST['Note'];
	$SpoiledItem->Admin = $_SESSION['CurrentAdminId'];

	$Item = Item::GetObjectByKey($Conn, $_POST['ItemId']);
	$Item->Condition = 0;
	$Item->Update();

   $SpoiledItem->Save();
   $Conn->Commit();
   header('location:ViewItem.php');
} catch (Exception $e) {
   echo $e;
   //include('error_handler.php');
}
?>