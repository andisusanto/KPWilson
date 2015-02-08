<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<form action="processadd.php" method="POST" name="frmAddItemLocationHistory" enctype="multipart/form-data">
    <div>Since : <input type="text" name="Since">    </div>
    <div>Until : <input type="text" name="Until">    </div>
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
    <div>Location : 
        <select name="Location">
       <?php
           include_once('../classes/Location.php');
           $Locations = Location::LoadCollection($Conn);
           foreach ($Locations as $Location) { ?>
               <option value=" <?php echo $Location->get_Id();?>"> <?php echo $Location->Name;?></option>
           <?php }?>
       ?>
       </select>    </div>

   <input type="submit" value="save">
</form>