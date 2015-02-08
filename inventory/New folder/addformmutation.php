<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/jqueryUI/css/smoothness/jquery-ui-1.10.3.custom.min.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="inc/jqueryUI/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#TransDate" ).datepicker({dateFormat: "yy-m-dd"});
    $( "#EffectiveDate" ).datepicker({dateFormat: "yy-m-dd"});
  });
</script>

<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
if (isset($_GET['ItemId'])){ $ItemId = $_GET['ItemId'];}else{ $ItemId = '';}
?>
<h3>Item Mutation</h3>
<form action="processaddmutation.php" method="POST" name="frmAddItemLocationMutation" enctype="multipart/form-data">
     
   <table class="formtable">
        <tr>
            <td style="width:20%">Code</td>
            <td>:</td>
            <td><input readonly type="text" name="Code" value="Auto No"></td>
        </tr>
        <tr>
            <td>TransDate</td>
            <td>:</td>
            <td><input type="text" name="TransDate" id="TransDate"></td>
        </tr>
        <tr>
            <td>Item</td>
            <td>:</td>
            <td>
              <?php
                 if ($ItemId != '') {
                  echo '
                    <input type="hidden" name="Item" value="'.$ItemId.'" />
                    <select name="ChoosenItem" disabled>';
                 }else{
                  echo '<select name="Item">';
                 }

                 include_once('classes/Item.php');
                 $Items = Item::LoadCollection($Conn, "`Condition` = 1");
                 foreach ($Items as $Item) { 
                  if($Item->get_Id() == $ItemId){
                    echo '<option value="'.$Item->get_Id().'" selected>'.$Item->Name.'</option>';
                  }else{
                  ?>

                     <option value=" <?php echo $Item->get_Id();?>"> <?php echo $Item->Name;?></option>
                 <?php }}?>
              ?>
              </select>
            </td>
        </tr>
        <tr>
            <td valign="top">ToLocation</td>
            <td valign="top">:</td>
            <td>
              <select name="ToLocation">
               <?php
                   include_once('classes/Location.php');
                   $Locations = Location::LoadCollection($Conn);
                   foreach ($Locations as $Location) { ?>
                       <option value=" <?php echo $Location->get_Id();?>"> <?php echo $Location->Name;?></option>
                   <?php }?>
               ?>
               </select>
             </td>
        </tr>
        <tr>
            <td>Effective Date</td>
            <td>:</td>
            <td><input type="text" name="EffectiveDate" id="EffectiveDate"></td>
        </tr>
        <tr>
            <td>Note</td>
            <td>:</td>
            <td><textarea name="Note"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="save"></td>
        </tr>
    </table>
</form>