<?php include_once('checklogin.php'); ?>
<?php 
	include_once('classes/Connection.php');
	include_once('classes/Item.php');
	include_once('classes/Location.php');
	include_once('classes/ItemLocationHistory.php');

	$ItemId = $_POST['Item'];
	$Conn = Connection::get_DefaultConnection();
	$Item = Item::GetObjectByKey($Conn, $ItemId);
?>

<html>
	<head>
		<title>Report Viewer</title>
		<link rel="stylesheet" type="text/css" href="css/weefer_inventory_report.css">
	</head>
	<body>
		<div class="report">
			<h1>Asset Current Status Report</h1>
			<h3>
				Date: <?php echo date("Y-m-d H:i:s") ?><br />
				Item: <?php echo $Item->Name.' ('.$Item->Code.')' ?>
			</h3>
			<table border="0">
				<tr>
					<th>No</th>
					<th>Location</th>
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
							WHERE Item.Id = ".$ItemId."
							ORDER BY ItemLocationHistory.Since ASC";
					$Datas = mysqli_query($Conn, $Query);
					$i = 1;
					while ($Records = mysqli_fetch_array($Datas)){
						echo '<tr>
								<td>'.$i.'</td>
								<td>'.$Records['Location'].'</td>
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
