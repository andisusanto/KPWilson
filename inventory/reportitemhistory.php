<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<h3>Asset History Report Parameter</h3>
<form action="viewreportitemhistory.php" method="POST" enctype="multipart/form-data" target="_blank">
     
   <table class="formtable">
        <tr>
            <td>Item</td>
            <td>:</td>
            <td><select name="Item">
              <?php
                include_once('classes/Item.php');
                $Items = Item::LoadCollection($Conn, "`Condition` = 1");
                foreach ($Items as $Item) { 
                ?>
                  <option value=" <?php echo $Item->get_Id();?>"> <?php echo $Item->Name;?></option>
                <?php }?>
              ?>
              </select>
            </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="Generate Report"></td>
        </tr>
    </table>
</form>