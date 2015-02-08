<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/ItemLocationMutation.php');
include_once('classes/ItemLocationHistory.php');
include_once('classes/Location.php');
include_once('classes/Item.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
	$OnDeletingMutationRecord = ItemLocationMutation::GetObjectByKey($Conn, $_GET['Id']);
	$OnDeletingHistoryRecord = ItemLocationHistory::GetObjectByKey($Conn, $OnDeletingMutationRecord->ItemLocationHistory);

	$ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Item = ".$OnDeletingHistoryRecord->Item." AND Since < '".$OnDeletingHistoryRecord->Since."'", "Since DESC");
	if (Count($ItemLocationHistorys) > 0){
		$ItemLocationHistorys[0]->Until = $OnDeletingHistoryRecord->Until;
		$ItemLocationHistorys[0]->Update();
	}

	// update item status
	$ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Item = ".$OnDeletingHistoryRecord->Item." AND Since < '".date('Y-m-d')."'", "Since DESC");
   	$Location = Location::GetObjectByKey($Conn, $ItemLocationHistorys[0]->Location);
   	if($Location->Type == 2){
   		$UpdateItemStatus = 0;
   	}else{
   		$UpdateItemStatus = 1;
   	}
   	$Item = Item::GetObjectByKey($Conn, $OnDeletingHistoryRecord->Item);
   	$Item->Status = $UpdateItemStatus;
   	$Item->Update();


   	ItemLocationHistory::Delete($Conn, $OnDeletingMutationRecord->ItemLocationHistory);
   	ItemLocationMutation::Delete($Conn, $_GET['Id']);
   	$Conn->Commit();
    header('location:viewmutation.php');
} catch (Exception $e) {
   include('error_handler.php');
}
?>