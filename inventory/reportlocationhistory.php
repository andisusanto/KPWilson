<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/jqueryUI/css/smoothness/jquery-ui-1.10.3.custom.min.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/jqueryUI/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#FromDate" ).datepicker({dateFormat: "yy-m-dd"});
    $( "#ToDate" ).datepicker({dateFormat: "yy-m-dd"});
  });
</script>

<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<h3>Mutation History Report Parameter</h3>
<form action="viewreportlocationhistory.php" method="POST" enctype="multipart/form-data" target="_blank">
          
   <table class="formtable">
        <tr>
            <td>Mutation Point</td>
            <td>:</td>
            <td>
              <select name="Location">
               <?php
                   include_once('classes/Location.php');
                   $Locations = Location::LoadCollection($Conn);
                   foreach ($Locations as $Location) { ?>
                       <option value=" <?php echo $Location->get_Id();?>"> <?php echo $Location->Name;?></option>
                   <?php }?>
               ?>
               </select>
             </td>
        </tr>
        <tr>
            <td>From Date</td>
            <td>:</td>
            <td><input type="text" name="FromDate" id="FromDate"></td>
        </tr>
        <tr>
            <td>To Date</td>
            <td>:</td>
            <td><input type="text" name="ToDate" id="ToDate"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="Generate Report"></td>
        </tr>
    </table>
</form>