<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" type="text/css" href="inc/formValidation/css/validationEngine.jquery.css" />
<script type="text/javascript" src="inc/formValidation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="inc/formValidation/js/languages/jquery.validationEngine-en.js"></script>


<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddLocation").validationEngine();
        });
    </script>
<h3>New Asset Point Information</h3>
<form action="processaddlocation.php" method="POST" name="frmAddLocation" id="frmAddLocation" enctype="multipart/form-data">

   <table class="formtable">
        <tr>
            <td style="width:20%">Code</td>
            <td>:</td>
            <td><input type="text" class="validate[required]" name="Code"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><input type="text" class="validate[required]" name="Name"></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td>:</td>
            <td><input type="text" name="ContactNumber"></td>
        </tr>
        <tr>
            <td valign="top">Address</td>
            <td valign="top">:</td>
            <td><textarea name="Address"></textarea> </td>
        </tr>
        <tr>
            <td>Type</td>
            <td>:</td>
            <td>
                <select name="Type">
                    <?php
                       include_once('classes/LocationType.php');
                       $LocationTypes = LocationType::LoadCollection($Conn);
                       foreach ($LocationTypes as $LocationType) { ?>
                           <option value=" <?php echo $LocationType->get_Id();?>"> <?php echo $LocationType->Name;?></option>
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