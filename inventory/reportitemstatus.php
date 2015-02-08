<?php include_once('checklogin.php'); ?>
<html>
	<head>
		<title>Report Viewer</title>
		<link rel="stylesheet" type="text/css" href="css/weefer_inventory_report.css">
	</head>
	<body>
		<div class="report">
			<h1>Asset Current Status Report</h1>
			<h3>Date: <?php echo date("Y-m-d H:i:s") ?></h3>
			<table border="0">
				<tr>
					<th>No</th>
					<th>Asset Code</th>
					<th>Asset Name</th>
					<th>Asset Current Location</th>
					<th>Since</th>
					<th>Asset Mutation TransNo</th>
				</tr>
				<?php 
					include_once('classes/Connection.php');
					include_once('classes/Item.php');
					include_once('classes/Location.php');
					include_once('classes/ItemLocationHistory.php');

					$Conn = Connection::get_DefaultConnection();
					$Query ="SELECT Item.Code AS ItemCode, Item.Name AS ItemName, IFNULL(Location.Name, 'Still have no transaction') AS Location, IFNULL(ItemLocationMutation.Id, '-') AS ItemLocationMutationId, ItemLocationHistory.Since
							FROM ITEM
							LEFT JOIN ItemLocationHistory ON ItemLocationHistory.Item = Item.Id AND ItemLocationHistory.Until IS NULL
							LEFT JOIN ItemLocationMutation ON ItemLocationMutation.ItemLocationHistory = ItemLocationHistory.Id
							LEFT JOIN Location ON Location.Id = ItemLocationhistory.Location
							WHERE Item.`Condition` = 1";
					$Datas = mysqli_query($Conn, $Query);
					$i = 1;
					while ($Records = mysqli_fetch_array($Datas)){
						echo '<tr>
								<td>'.$i.'</td>
								<td>'.$Records['ItemCode'].'</td>
								<td>'.$Records['ItemName'].'</td>
								<td>'.$Records['Location'].'</td>
								<td>'.$Records['Since'].'</td>
								<td>'.$Records['ItemLocationMutationId'].'</td>
							</tr>';
						$i++;
					}
				?>
			</table>
		</div>

	</body>
</html>
