<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>


<?php
include_once('classes/Location.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$Location = Location::GetObjectByKey($Conn, $_GET['Id']);
?>
<h3>Edit Location Information</h3>
<form action="processeditlocation.php" method="POST" name="frmUpdateLocation" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $Location->get_Id();?>">


   <table class="formtable">
        <tr>
            <td style="width:20%">Code</td>
            <td>:</td>
            <td><input type="text" name="Code" value="<?php echo $Location->Code; ?>"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><input type="text" name="Name" value="<?php echo $Location->Name; ?>"></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td>:</td>
            <td><input type="text" name="ContactNumber" value="<?php echo $Location->ContactNumber; ?>"></td>
        </tr>
        <tr>
            <td valign="top">Address</td>
            <td valign="top">:</td>
            <td><textarea name="Address"><?php echo $Location->Address; ?></textarea> </td>
        </tr>
        <tr>
            <td>Type</td>
            <td>:</td>
            <td>
                <select name="Type">
                    <?php
                       include_once('classes/LocationType.php');
                       $LocationTypes = LocationType::LoadCollection($Conn);
                       foreach ($LocationTypes as $LocationType) { 
                        if($Location->Type == $LocationType->get_Id()){$isSelected = 'selected';}else{$isSelected = '';}?>
                           <option value="<?php echo $LocationType->get_Id();?>" <?php echo $isSelected; ?>> <?php echo $LocationType->Name;?></option>
                    <?php }?>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="save"></td>
        </tr>
    </table>

</form>