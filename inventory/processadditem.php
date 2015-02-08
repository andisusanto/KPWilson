<?php include_once('checklogin.php'); ?>
<?php
include_once('classes/Item.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Item = new Item($Conn);
   $Item->Name = $_POST['Name'];
	$Item->AdditionalInfo = $_POST['AdditionalInfo'];
	$Item->Code = $_POST['Code'];
	$Item->Condition = 1;
	$Item->Status = 0;

   $Item->Save();
   $Conn->Commit();
  header('location:viewitem.php');
} catch (Exception $e) {
  echo $e;
}
?>