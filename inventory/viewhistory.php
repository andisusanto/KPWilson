<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">

<div class="viewdata">

    <h3>Item Mutation History</h3>
   <div>&nbsp;</div>
<table id="viewdata" class="hover" width="100%">
   <thead>
       <tr>
            <th>Item</th>
            <th>Location</th>
            <th>Since</th>
            <th>Until</th>
           
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/ItemLocationHistory.php');
           include_once('classes/ItemLocationMutation.php');
           include_once('classes/Item.php');
           include_once('classes/Location.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Location <> 17 AND Location <> 18");
           foreach($ItemLocationHistorys as $ItemLocationHistory){ ?>
       <tr>
                <td><?php 
                  $Item = Item::GetObjectByKey($Conn, $ItemLocationHistory->Item);
                  echo $Item->Name; ?>
                </td>
                <td><?php 
                  $Location = Location::GetObjectByKey($Conn, $ItemLocationHistory->Location);
                  echo $Location->Name; ?>
                </td>
                <td><?php echo date_format(New DateTime($ItemLocationHistory->Since), 'Y-m-d'); ?></td>
                <td>
                  <?php 
                    if (is_null($ItemLocationHistory->Until)){$Until = "Ongoing";}else{$Until = date_format(New DateTime($ItemLocationHistory->Until), 'Y-m-d');}
                    echo $Until 
                  ?>
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