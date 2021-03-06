<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">

<?php
include_once('classes/Location.php');
include_once('classes/ItemLocationHistory.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   
   $ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Location = ".$_GET['Id']." AND Until IS NULL");
	if (Count($ItemLocationHistorys) > 0){
		echo "<h3>Can't Set Inactive because assets hasn't returned, please check it again</h3>";
		echo "<div class='viewdata'><a href='viewlocation.php'>Back to Location</a></div>";
	}else{

	   $Location = Location::GetObjectByKey($Conn, $_GET['Id']);
	   $Location->IsActive = 0;

	   $Location->Update();
   		$Conn->Commit();
   		header('location:viewlocation.php');
   	}
} catch (Exception $e) {
   include('error_handler.php');
}
?>