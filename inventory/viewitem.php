<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">
<div class="viewdata">
<h3>Company Asset Data</h3>
<a class="linkbutton" href="additem.php">Add New Asset</a>
<div>&nbsp;</div>
<table id="viewdata" class="hover">
   <thead>
       <tr>
            <th>Code</th>
            <th>Name</th>
            <th>AdditionalInfo</th>
            <th>Condition</th>
            <th>Status</th>
           <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/Item.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $Items = Item::LoadCollection($Conn);
           foreach($Items as $Item){ ?>
       <tr>
                <td><?php echo $Item->Code; ?></td>
                <td><?php echo $Item->Name; ?></td>
                <td><?php echo $Item->AdditionalInfo; ?></td>
                <td><?php echo ($Item->Condition == 0) ? 'Spoiled' : 'Okay'; ?></td>
                <td><?php if($Item->Status == 0){
                            echo 'Available';
                          }
                          elseif ($Item->Status == 1){
                            echo 'Rented';
                          }else{
                            echo 'Unavailable';
                          } ?></td>

               <td>
                   <div>
                       <?php
                       
                        if ($Item->Condition != 0) {
                          //if ($Item->Status == 0){echo '<a href="addformmutation.php?ItemId='.$Item->get_Id().'">Loan</a>';}
                          echo '
                          <a href="addformmutation.php?ItemId='.$Item->get_Id().'">Loan</a>
                          <a href="addspoileditem.php?ItemId='.$Item->get_Id().'">Spoiled</a>
                               <a href="edititem.php?Id='.$Item->get_Id().'">edit</a>';
                        }else{
                          echo '<a href="spoileditemdetail.php?Id='.$Item->get_Id().'">Spoiled Info</a>';
                        }
                       
                       ?>
                       <a href="processdeleteitem.php?Id=<?php echo $Item->get_Id(); ?>">delete</a>
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