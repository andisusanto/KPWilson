<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">
<?php
  include_once('classes/ItemLocationHistory.php');
           include_once('classes/ItemLocationMutation.php');
           include_once('classes/Item.php');
           include_once('classes/Location.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();

           $Location = Location::GetObjectByKey($Conn, $_GET['Id']);
           ?>
<div class="viewdata">

    <h3>Assets That Have Not Been Returned By <?php echo $Location->Name ?></h3>

<a class="linkbutton" href="viewlocation.php">Back to Asset Point</a>
   <div>&nbsp;</div>
<table id="viewdata" class="hover" width="100%">
   <thead>
       <tr>
            <th>Item</th>
            <th>Since</th>
            <th>Asset Mutation Code</th>
       </tr>
   </thead>
   <tbody>
       <?php
           
           $ItemLocationHistorys = ItemLocationHistory::LoadCollection($Conn, "Location = ".$_GET['Id']." AND Until IS NULL");
           foreach($ItemLocationHistorys as $ItemLocationHistory){ ?>
       <tr>
                <td><?php 
                  $Item = Item::GetObjectByKey($Conn, $ItemLocationHistory->Item);
                  echo $Item->Name; ?>
                </td>
                
                <td><?php echo date_format(New DateTime($ItemLocationHistory->Since), 'Y-m-d'); ?></td>
                <td>
                  <?php 
                    $ItemLocationMutation = ItemLocationMutation::GetObjectByHistoryKey($Conn, $ItemLocationHistory->get_Id());
                    echo $ItemLocationMutation->Code; 
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