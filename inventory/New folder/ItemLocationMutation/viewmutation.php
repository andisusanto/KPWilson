<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<div class="viewdata">
  <a href="addformmutation.php">add new</a>
<table>
   <thead>
       <tr>
            <th>EffectiveDate</th>
            <th>Item</th>
            <th>ToLocation</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/ItemLocationMutation.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ItemLocationMutations = ItemLocationMutation::LoadCollection($Conn);
           foreach($ItemLocationMutations as $ItemLocationMutation){ ?>
       <tr>
                <td><?php echo $ItemLocationMutation->EffectiveDate; ?></td>
                <td><?php echo $ItemLocationMutation->Item; ?></td>
                <td><?php echo $ItemLocationMutation->ToLocation; ?></td>

               <td>
                   <div>
                       <a href="editformmutation.php?Id=<?php echo $ItemLocationMutation->get_Id(); ?>">edit</a>
                       <a href="processdeletemutation.php?Id=<?php echo $ItemLocationMutation->get_Id(); ?>">delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>
</div>