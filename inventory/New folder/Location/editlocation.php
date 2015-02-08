<?php
include_once('../classes/Location.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Location = Location::GetObjectByKey($Conn, $_GET['Id']);
?>
<form action="processedit.php" method="POST" name="frmUpdateLocation" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $Location->get_Id();?>">
    <div>Code : <input type="text" name="Code" value="<?php echo $Location->Code; ?>" >    </div>
    <div>Name : <input type="text" name="Name" value="<?php echo $Location->Name; ?>" >    </div>
    <div>IsActive : <input type="checkbox" name="IsActive"  <?php if($Location->IsActive){echo "Checked";}else{echo "";} ?>>    </div>

   <input type="submit" value="save">
</form>