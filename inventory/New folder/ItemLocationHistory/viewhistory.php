<a href="addform.php">add new</a>
<table>
   <thead>
       <tr>
            <th>Item</th>
            <th>Location</th>
            <th>Since</th>
            <th>Until</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/ItemLocationHistory.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn);
           foreach($ItemLocationHistorys as $ItemLocationHistory){ ?>
       <tr>
                <td><?php echo $ItemLocationHistory->Item; ?></td>
                <td><?php echo $ItemLocationHistory->Location; ?></td>
                <td><?php echo $ItemLocationHistory->Since; ?></td>
                <td><?php echo $ItemLocationHistory->Until; ?></td>

               <td>
                   <div>
                       <a href="editform.php?Id=<?php echo $ItemLocationHistory->get_Id(); ?>">edit</a>
                       <a href="processdelete.php?Id=<?php echo $ItemLocationHistory->get_Id(); ?>">delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>