<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">

<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<h3>New Item Information</h3>
<form action="processadditem.php" method="POST" name="frmAddItem" enctype="multipart/form-data">
    <table class="formtable">
        <tr>
            <td style="width:20%">Code</td>
            <td>:</td>
            <td><input type="text" name="Code"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><input type="text" name="Name"></td>
        </tr>
        <tr>
            <td valign="top">Additional Information</td>
            <td valign="top">:</td>
            <td><textarea name="AdditionalInfo"></textarea> </td>
        </tr>
      
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="save"></td>
        </tr>
    </table>
</form>

                   