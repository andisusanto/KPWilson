<?php
include_once('../classes/Connection.php');
$Conn = Connection::get_DefaultConnection();
?>
<form action="processadd.php" method="POST" name="frmAddLocation" enctype="multipart/form-data">
    <div>Code : <input type="text" name="Code">    </div>
    <div>Name : <input type="text" name="Name">    </div>
    <div>IsActive : <input type="checkbox" name="IsActive">    </div>

   <input type="submit" value="save">
</form>