<?php
include_once('../classes/ItemLocationMutation.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ItemLocationMutation = ItemLocationMutation::GetObjectByKey($Conn, $_GET['Id']);
?>
<form action="processedit.php" method="POST" name="frmUpdateItemLocationMutation" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $ItemLocationMutation->get_Id();?>">
    <div>ToLocation :         <select name="ToLocation">
       <?php
          $Locations = Location::LoadCollection($Conn);
          foreach ($Locations as $Location) {
       	if($ItemLocationMutation->ToLocation==$Location->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Location->get_Id()" $isSelected>".$Location->Name."</option>";
           }
       ?>
       </select>    </div>
    <div>EffectiveDate : <input type="text" name="EffectiveDate" value="<?php echo $ItemLocationMutation->EffectiveDate; ?>" >    </div>
    <div>Item :         <select name="Item">
       <?php
          $Items = Item::LoadCollection($Conn);
          foreach ($Items as $Item) {
       	if($ItemLocationMutation->Item==$Item->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Item->get_Id()" $isSelected>".$Item->Name."</option>";
           }
       ?>
       </select>    </div>

   <input type="submit" value="save">
</form>