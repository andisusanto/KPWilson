<?php include_once('checklogin.php'); ?>
<?php
session_start();
include_once('classes/LocationType.php');
include_once('classes/Location.php');
include_once('classes/Item.php');
include_once('classes/ItemLocationMutation.php');
include_once('classes/ItemLocationHistory.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {

	// initialize auto number
	$LastCode = ItemLocationMutation::LoadCollection($Conn, '1 = 1', 'Code DESC', 1, 1);
	if (Count($LastCode) != 0){
		foreach ($LastCode as $ItemLocationMutation) {
			$Code = "M-". str_pad((substr($ItemLocationMutation->Code, -3)+1), 3, '0', STR_PAD_LEFT);
		}
	}else{ $Code = 'M-001';}

	// check same data validation
	$ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Item = ".$_POST['Item']." AND Since = '".$_POST['EffectiveDate']."'");
	if (Count($ItemLocationHistorys) > 0){
		throw new Exception("Item has a similiar date history");
	}

	// save between history
	$ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Item = ".$_POST['Item']." AND Since < '".$_POST['EffectiveDate']."'", "Since DESC");
	if (Count($ItemLocationHistorys) > 0){
		$ItemLocationHistorys[0]->Until = date('Y-m-d', strtotime($_POST['EffectiveDate']. '- 1 day'));
		$ItemLocationHistorys[0]->Update();
	}
	
	// create history record
	$ItemLocationHistory = new ItemLocationHistory($Conn);
	$ItemLocationHistory->Since = $_POST['EffectiveDate'];
	$ItemLocationHistory->Item = $_POST['Item'];
	$ItemLocationHistory->Location = $_POST['ToLocation'];
	$ItemLocationHistory->Admin = $_SESSION['CurrentAdminId'];
	
	// Until Date for new between record
   	$ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Item = ".$_POST['Item']." AND Since > '".$_POST['EffectiveDate']."'", "Since ASC");
	if (Count($ItemLocationHistorys) > 0){
		$ItemLocationHistory->Until = date('Y-m-d', strtotime($ItemLocationHistorys[0]->Since. '- 1 day'));
	}
	$ItemLocationHistory->Save();

	// create trasaction record
	$ItemLocationMutation = new ItemLocationMutation($Conn);
	$ItemLocationMutation->ToLocation = $_POST['ToLocation'];
	$ItemLocationMutation->EffectiveDate = $_POST['EffectiveDate'];
	$ItemLocationMutation->Item = $_POST['Item'];
	$ItemLocationMutation->Code = $Code;
	$ItemLocationMutation->Note = $_POST['Note'];
	$ItemLocationMutation->TransDate = $_POST['TransDate'];
	$ItemLocationMutation->Admin = $_SESSION['CurrentAdminId'];
	$ItemLocationMutation->ItemLocationHistory = $ItemLocationHistory->get_Id();
   	$ItemLocationMutation->Save();

   	// update item status
   	$Location = Location::GetObjectByKey($Conn, $_POST['ToLocation']);
   	if($Location->Type == 2){
   		$UpdateItemStatus = 0;
   	}else{
   		$UpdateItemStatus = 1;
   	}
   	$Item = Item::GetObjectByKey($Conn, $_POST['Item']);
   	$Item->Status = $UpdateItemStatus;
   	$Item->Update();

   	$Conn->Commit();
   
   header('location:viewmutation.php');
} catch (Exception $e) {
   echo $e;
   //include('error_handler.php');
}
?>