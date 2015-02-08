<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<form action="processadd.php" method="POST" name="frmAddItem" enctype="multipart/form-data">
    <div>Name : <input type="text" name="Name">    </div>
    <div>AdditionalInfo : <input type="text" name="AdditionalInfo">    </div>
    <div>Status : <input type="text" name="Status">    </div>
    <div>Code : <input type="text" name="Code">    </div>

   <input type="submit" value="save">
</form>