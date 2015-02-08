<?php
include_once('../classes/Item.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Item = Item::GetObjectByKey($Conn, $_GET['Id']);
?>
<form action="processedit.php" method="POST" name="frmUpdateItem" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $Item->get_Id();?>">
    <div>Name : <input type="text" name="Name" value="<?php echo $Item->Name; ?>" >    </div>
    <div>AdditionalInfo : <input type="text" name="AdditionalInfo" value="<?php echo $Item->AdditionalInfo; ?>" >    </div>
    <div>Status : <input type="text" name="Status" value="<?php echo $Item->Status; ?>" >    </div>
    <div>Code : <input type="text" name="Code" value="<?php echo $Item->Code; ?>" >    </div>

   <input type="submit" value="save">
</form>