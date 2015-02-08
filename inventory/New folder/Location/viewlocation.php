<a href="addform.php">add new</a>
<table>
   <thead>
       <tr>
            <th>Code</th>
            <th>IsActive</th>
            <th>Name</th>

           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('../classes/Location.php');
           include_once('../classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Locations = Location::LoadCollection($Conn);
           foreach($Locations as $Location){ ?>
       <tr>
                <td><?php echo $Location->Code; ?></td>
                <td><?php echo $Location->IsActive; ?></td>
                <td><?php echo $Location->Name; ?></td>

               <td>
                   <div>
                       <a href="editform.php?Id=<?php echo $Location->get_Id(); ?>">edit</a>
                       <a href="processdelete.php?Id=<?php echo $Location->get_Id(); ?>">delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>