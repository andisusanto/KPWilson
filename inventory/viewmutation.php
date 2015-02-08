<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">

<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">


<div class="viewdata">
    <h3>Item Mutation</h3>
  <a href="addformmutation.php">New Item Mutation</a>
  <div>&nbsp;</div>
<table id="viewdata" class="hover" width="100%">
   <thead>
       <tr>
            <th>Code</th>
            <th>Transaction Date</th>
            <th>Item</th>
            <th>ToLocation</th>
            <th>Effective Date</th>
            <th>Note</th>
            <th>Actions</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/ItemLocationMutation.php');
           include_once('classes/Item.php');
           include_once('classes/Location.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ItemLocationMutations = ItemLocationMutation::LoadCollection($Conn);
           foreach($ItemLocationMutations as $ItemLocationMutation){ ?>
       <tr>
                <td><?php echo $ItemLocationMutation->Code; ?></td>
                <td><?php echo date_format(New DateTime($ItemLocationMutation->TransDate), 'Y-m-d'); ?></td>
                <td><?php 
                  $MutationItem = Item::GetObjectByKey($Conn, $ItemLocationMutation->Item);
                  echo $MutationItem->Name ?>
                </td>
                <td><?php 
                  $MutationLocation = Location::GetObjectByKey($Conn, $ItemLocationMutation->ToLocation);
                  echo $MutationLocation->Name; ?>
                </td>
                <td><?php echo date_format(New DateTime($ItemLocationMutation->EffectiveDate), 'Y-m-d'); ?></td>
                <td><?php echo $ItemLocationMutation->Note; ?></td>
               <td>
                   <div>
                       <!--<a href="editformmutation.php?Id=<?php echo $ItemLocationMutation->get_Id(); ?>">edit</a>-->
                       <a href="processdeletemutation.php?Id=<?php echo $ItemLocationMutation->get_Id(); ?>">delete</a>
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