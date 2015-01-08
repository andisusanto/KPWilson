<?php
    include_once('checklogin.php');
    include_once('checkchangepassword.php');
    include_once('classes/Admin.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/weefer_inventory.css" />
<link rel="stylesheet" type="text/css" href="inc/jqueryUI/css/smoothness/jquery-ui-1.10.3.custom.css" />
<script type="text/javascript" src="inc/jqueryUI/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="inc/jqueryUI/js/jquery-ui-1.10.3.custom.js"></script>
<script>
	$(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			activeHeader: "ui-icon-circle-arrow-s"
		};
		
		$( "#accordion" ).accordion({
			icons: icons,
			heightStyle: "content"
			});
	
		$( "#toggle" ).button().click(function() {
	
			if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
				$( "#accordion" ).accordion( "option", "icons", null );
			} else {
				$( "#accordion" ).accordion( "option", "icons", icons );
				}
		});
	});
</script>

<title>Adminitrator Page</title>
</head>

<body class="home">

<div id="wrap">

	<div id="main">
		
        <div class="header">
        	<div class="logo"><img style="margin-top:0px" src="images/logo.png" width='300' /></div>
            <div class="navigation">
            	<ul>
                	<li><a href="index.php">HOME</a></li>
                    <li>|</li>
                    <li><a href="logout.php">LOG OUT ( 
                    	<?php
                            $Conn = Connection::get_DefaultConnection();
                    		$admin = Admin::GetObjectByKey($Conn, $_SESSION['CurrentAdminId']);
                            echo $admin->UserName;
                    	?>
                      )</a></li>
                </ul>
            </div>
        </div>
        
        <div class="left">
        	<!--<div id="accordion">
            	
                <h3>Master Data Setup</h3>
                <div>
                    <a href='viewitem.php' target='mainframe'>Item</a><br />
                    <a href='viewlocation.php' target='mainframe'>Location</a><br />
                </div>
                <h3>Transaction</h3>
                <div>
                	<a href='viewmutation.php' target='mainframe'>Mutation</a><br />
                </div>
                
        </div>-->

                    <a href='viewitem.php' target='mainframe'>Item</a><br />
                    <a href='viewlocation.php' target='mainframe'>Location</a><br />
                    <a href='viewmutation.php' target='mainframe'>Lend Transaction</a><br />
                    <a href='viewspoileditem.php' target='mainframe'>Spoiled Item</a><br />                
        </div>
        <div class="right"><iframe name="mainframe" src="viewhistory.php" frameborder="0"></iframe></div>
        
    </div>    

</div>

<div id="footer"></div>
			
</body>
</html>