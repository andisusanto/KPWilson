<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">

<div class="viewdata">
  <h3>Location Master Data</h3>
<a class="linkbutton" href="addlocation.php">Add New Location</a>
<div>&nbsp;</div>
<table id="viewdata" class="hover" width="100%">
   <thead>
       <tr>
            <th>Code</th>
            <th>Name</th>
            <th>ContactNumber</th>
            <th>Address</th>
            <th>Type</th>
            <th>IsActive</th>
           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/Location.php');
           include_once('classes/LocationType.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Locations = Location::LoadCollection($Conn);
           foreach($Locations as $Location){ ?>
       <tr>
                <td><?php echo $Location->Code; ?></td>
                
                <td><?php echo $Location->Name; ?></td>
                <td><?php echo $Location->ContactNumber; ?></td>
                <td><?php echo $Location->Address; ?></td>

                <td>
                  <?php
                    $LocationType = LocationType::GetObjectByKey($Conn, $Location->Type);
                    echo $LocationType->Name;
                  ?>
                   
                </td>
<td><?php echo ($Location->IsActive == 0)? 'Inactive' : 'Active'; ?></td>
               <td>
                   <div>
                       <a href="CheckLocationItem.php?Id=<?php echo $Location->get_Id(); ?>">Check</a>
                       <a href="ProsessSetInActive.php?Id=<?php echo $Location->get_Id(); ?>">Inactive</a>
                       <a href="editlocation.php?Id=<?php echo $Location->get_Id(); ?>">edit</a>
                       <a href="processdeletelocation.php?Id=<?php echo $Location->get_Id(); ?>">delete</a>
                   </div>
               </td>
       </tr>
           <?php } ?>
   </tbody>
</table>
</div>


<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#viewdata').dataTable( {
          "scrollX": true
      } );
  } );
</script>