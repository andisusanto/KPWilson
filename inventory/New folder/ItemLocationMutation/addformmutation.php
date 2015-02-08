<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<form action="processadd.php" method="POST" name="frmAddItemLocationMutation" enctype="multipart/form-data">
    <div>ToLocation : 
        <select name="ToLocation">
       <?php
           include_once('../classes/Location.php');
           $Locations = Location::LoadCollection($Conn);
           foreach ($Locations as $Location) { ?>
               <option value=" <?php echo $Location->get_Id();?>"> <?php echo $Location->Name;?></option>
           <?php }?>
       ?>
       </select>    </div>
    <div>EffectiveDate : <input type="text" name="EffectiveDate">    </div>
    <div>Item : 
        <select name="Item">
       <?php
           include_once('../classes/Item.php');
           $Items = Item::LoadCollection($Conn);
           foreach ($Items as $Item) { ?>
               <option value=" <?php echo $Item->get_Id();?>"> <?php echo $Item->Name;?></option>
           <?php }?>
       ?>
       </select>    </div>

   <input type="submit" value="save">
</form>