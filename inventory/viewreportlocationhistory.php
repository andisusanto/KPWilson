<?php include_once('checklogin.php'); ?>
<?php 
	include_once('classes/Connection.php');
	include_once('classes/Item.php');
	include_once('classes/Location.php');
	include_once('classes/ItemLocationHistory.php');

	$LocationId = $_POST['Location'];
	$FromDate = $_POST['FromDate'];
	$ToDate = $_POST['ToDate'];
	$Conn = Connection::get_DefaultConnection();
	$Location = Location::GetObjectByKey($Conn, $LocationId);
	if(isset($FromDate) && isset($ToDate)){
		$FilterDate = "";
	} else { $FilterDate = "AND ItemLocationHistory.Since BETWEEN '".$FromDate."' AND '".$ToDate."'";}
?>	
<html>
	<head>
		<title>Report Viewer</title>
		<link rel="stylesheet" type="text/css" href="css/weefer_inventory_report.css">
	</head>
	<body>
		<div class="report">
			<h1>Asset Point Transaction History Report</h1>
			<h3>
				<?php
				if ($FilterDate == ""){echo "No Date Filtering <br />";}
				else{
					echo "From Date: ".$FromDate." <br />
						To Date: ".$ToDate." <br />";
				}?>
				Mutation Point: <?php echo $Location->Name.' ('.$Location->Code.')' ?>
			</h3>
			<table border="0">
				<tr>
					<th>No</th>
					<th>Item Code</th>
					<th>Item Name</th>
					<th>Since</th>
					<th>Until</th>
					<th>Asset Mutation TransNo</th>
				</tr>
				<?php 
					
					$Query ="SELECT Item.Code AS ItemCode, Item.Name AS ItemName, ItemLocationHistory.Since, IFNULL( ItemLocationHistory.Until,  'Current' ) AS Until, Location.Name AS Location, ItemLocationMutation.Id AS ItemLocationMutationId
							FROM ItemLocationHistory
							INNER JOIN Item ON Item.Id = ItemLocationHistory.Item
							LEFT JOIN Location ON Location.Id = ItemLocationhistory.Location
							LEFT JOIN ItemLocationMutation ON ItemLocationMutation.ItemLocationHistory = ItemLocationHistory.Id
							WHERE Location.Id = ".$LocationId." ".$FilterDate."
							ORDER BY ItemLocationhistory.Since Desc";
					$Datas = mysqli_query($Conn, $Query);
					$i = 1;
					while ($Records = mysqli_fetch_array($Datas)){
						echo '<tr>
								<td>'.$i.'</td>
								<td>'.$Records['ItemCode'].'</td>
								<td>'.$Records['ItemName'].'</td>
								<td>'.$Records['Since'].'</td>
								<td>'.$Records['Until'].'</td>
								<td>'.$Records['ItemLocationMutationId'].'</td>
							</tr>';
						$i++;
					}
				?>
			</table>
		</div>

	</body>
</html>
