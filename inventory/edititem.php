<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>

<?php
include_once('classes/Item.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Item = Item::GetObjectByKey($Conn, $_GET['Id']);
?>

<h3>Edit Asset Information</h3>
<form action="processedititem.php" method="POST" name="frmUpdateItem" enctype="multipart/form-data">
<input type="hidden" name="Id" value="<?php echo $Item->get_Id();?>">
    <table class="formtable">
        <tr>
            <td style="width:20%">Code</td>
            <td>:</td>
            <td><input type="text" name="Code" value="<?php echo $Item->Code; ?>"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><input type="text" name="Name" value="<?php echo $Item->Name; ?>"></td>
        </tr>
        <tr>
            <td valign="top">Additional Information</td>
            <td valign="top">:</td>
            <td><textarea name="AdditionalInfo"><?php echo $Item->AdditionalInfo; ?></textarea> </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="save"></td>
        </tr>
    </table>
</form>