<?php include_once('checklogin.php'); ?>
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
include_once('classes/Location.php');
include_once('classes/Item.php');
include_once('classes/ItemLocationMutation.php');
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ItemLocationMutation = ItemLocationMutation::GetObjectByKey($Conn, $_GET['Id']);
?>
<form action="processeditmutation.php" method="POST" name="frmUpdateItemLocationMutation" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $ItemLocationMutation->get_Id();?>">
    <div>Code : <input readonly type="text" name="Code" value="<?php echo $ItemLocationMutation->Code ?>"></div>
    <div>Transaction Date : <input type="text" name="TransDate" id="TransDate" value="<?php echo $ItemLocationMutation->TransDate ?>">    </div>
    <div>Item :         <select name="Item">
       <?php
          $Items = Item::LoadCollection($Conn);
          foreach ($Items as $Item) {
        if($ItemLocationMutation->Item==$Item->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Item->get_Id()." $isSelected>".$Item->Name."</option>";
           }
       ?>
       </select>    </div>
    <div>ToLocation :         <select name="ToLocation">
       <?php
          $Locations = Location::LoadCollection($Conn);
          foreach ($Locations as $Location) {
       	if($ItemLocationMutation->ToLocation==$Location->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Location->get_Id()." $isSelected>".$Location->Name."</option>";
           }
       ?>
       </select>    </div>
    <div>EffectiveDate : <input type="text" name="EffectiveDate" id="EffectiveDate" value="<?php echo $ItemLocationMutation->EffectiveDate; ?>" >    </div>
    
       <div>Note : <br>
        <textarea class="ckeditor" name="Note"><?php echo $ItemLocationMutation->Note ?></textarea>    </div>
        <script type="text/javascript">
            CKEDITOR.replace( 'Note', {
                            width:700,
                            height:150,
                            toolbar: [
                                [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
                                [ 'FontSize', 'TextColor', 'BGColor' ],['Table']
                                    ]
                                });
                
        </script>

   <input type="submit" value="save">
</form>