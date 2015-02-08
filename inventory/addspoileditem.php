<?php include_once('checklogin.php'); ?>
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
<link rel="stylesheet" type="text/css" href="inc/jqueryUI/css/smoothness/jquery-ui-1.10.3.custom.min.css">

<script type="text/javascript" src="inc/datatable/js/jquery.js"></script>
<script type="text/javascript" src="inc/jqueryUI/js/jquery-ui-1.10.3.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="inc/formValidation/css/validationEngine.jquery.css" />
<script type="text/javascript" src="inc/formValidation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="inc/formValidation/js/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#TransDate" ).datepicker({dateFormat: "yy-m-dd"});
  });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $("#frmAddspoiledItem").validationEngine();
        });
    </script>
<?php
include_once('classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<h3>Set Spoiled Item</h3>
<form action="processaddspoileditem.php" method="POST" name="frmAddspoiledItem" id="frmAddspoiledItem" enctype="multipart/form-data">
    <input type="hidden" name="ItemId" value="<?php echo $_GET['ItemId'];?>">
    <table class="formtable">
        <tr>
            <td style="width:20%">Trans Date</td>
            <td>:</td>
            <td><input type="text" class="validate[required, custom[date]]" name="TransDate" id="TransDate"></td>
        </tr>
        <tr>
            <td valign="top">Note</td>
            <td valign="top">:</td>
            <td><textarea name="Note" class="validate[required]"></textarea> </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="save"></td>
        </tr>
    </table>
</form>

                   