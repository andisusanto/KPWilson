<a href="addform.php">add new</a>
<table>
   <thead>
       <tr>
            <th>AdditionalInfo</th>
            <th>Code</th>
            <th>Name</th>
            <th>Status</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Item.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Items = Item::LoadCollection($Conn);
           foreach($Items as $Item){ ?>
       <tr>
                <td><?php echo $Item->AdditionalInfo; ?></td>
                <td><?php echo $Item->Code; ?></td>
                <td><?php echo $Item->Name; ?></td>
                <td><?php echo $Item->Status; ?></td>

               <td>
                   <div>
                       <a href="editform.php?Id=<?php echo $Item->get_Id(); ?>">edit</a>
                       <a href="processdelete.php?Id=<?php echo $Item->get_Id(); ?>">delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>