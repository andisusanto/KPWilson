<?php
include_once('../classes/ItemLocationHistory.php');
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
$ItemLocationHistory = ItemLocationHistory::GetObjectByKey($Conn, $_GET['Id']);
?>
<form action="processedit.php" method="POST" name="frmUpdateItemLocationHistory" enctype="multipart/form-data">
   <input type="hidden" name="Id" value="<?php echo $ItemLocationHistory->get_Id();?>">
    <div>Since : <input type="text" name="Since" value="<?php echo $ItemLocationHistory->Since; ?>" >    </div>
    <div>Until : <input type="text" name="Until" value="<?php echo $ItemLocationHistory->Until; ?>" >    </div>
    <div>Item :         <select name="Item">
       <?php
          $Items = Item::LoadCollection($Conn);
          foreach ($Items as $Item) {
       	if($ItemLocationHistory->Item==$Item->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Item->get_Id()" $isSelected>".$Item->Name."</option>";
           }
       ?>
       </select>    </div>
    <div>Location :         <select name="Location">
       <?php
          $Locations = Location::LoadCollection($Conn);
          foreach ($Locations as $Location) {
       	if($ItemLocationHistory->Location==$Location->get_Id()){
              $isSelected = 'selected';
          }else{
              $isSelected = '';
          }
               echo "<option value=".$Location->get_Id()" $isSelected>".$Location->Name."</option>";
           }
       ?>
       </select>    </div>

   <input type="submit" value="save">
</form>