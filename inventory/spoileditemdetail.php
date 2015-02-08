<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/jqueryUI/css/smoothness/jquery-ui-1.10.3.custom.min.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/jqueryUI/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#TransDate" ).datepicker({dateFormat: "yy-m-dd"});
  });
</script>
<?php
include_once('classes/Connection.php');
include_once('classes/SpoiledItem.php');
$Conn = Connection::get_DefaultConnection();
$SpoiledItems = SpoiledItem::LoadCollection($Conn, "Item = ". $_GET['Id']);
foreach ($SpoiledItems as $SpoiledItem) { 
?>
<h3>Spoiled Item Transaction Information</h3>

    <table class="formtable">
        <tr>
            <td style="width:20%">Trans Date</td>
            <td>:</td>
            <td><input disabled type="text" name="TransDate" id="TransDate"  value="<?php echo $SpoiledItem->TransDate; ?>"></td>
        </tr>
        <tr>
            <td valign="top">Note</td>
            <td valign="top">:</td>
            <td><textarea disabled name="Note"><?php echo $SpoiledItem->Note; ?></textarea> </td>
        </tr>
        
    </table>

<?php
}
?>                   