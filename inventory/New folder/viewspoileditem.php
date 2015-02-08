<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/datatable/css/jquery.dataTables.min.css">

<div class="viewdata">

    <h3>List Spoiled Item</h3>
   <div>&nbsp;</div>
<table id="viewdata" class="hover" width="100%">
   <thead>
       <tr>
            <th>Item</th>
            <th>Transaction Date</th>
            <th>Note</th>
            <th>Action</th>
       </tr>
   </thead>
   <tbody>
       <?php
           include_once('classes/SpoiledItem.php');
           include_once('classes/Item.php');
           include_once('classes/Connection.php');
           $Conn = Connection::get_DefaultConnection();
           $SpoiledItems = SpoiledItem::LoadCollection($Conn);
           foreach($SpoiledItems as $SpoiledItem){ ?>
              <tr>
                <td><?php 
                  $Item = Item::GetObjectByKey($Conn, $SpoiledItem->Item);
                  echo $Item->Name; ?>
                </td>
                <td><?php echo date_format(New DateTime($SpoiledItem->TransDate), 'Y-m-d'); ?></td>
                <td><?php echo $SpoiledItem->Note ?>
                </td>
                <td>
                   <div>
                       <a href="spoileditemdetail.php?Id=<?php echo $SpoiledItem->Item; ?>">View Detail</a>
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