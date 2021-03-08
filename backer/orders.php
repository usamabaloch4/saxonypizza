<?php 
	require "model.php"; 
	$model = new Model();

	if(isset($_GET['delete']) && $_GET['delete'] != '')
	{
		$model->deleteById($_GET['delete'], 'basepizza');
		header("location: basepizza.php");
	}
?>
<?php require "tmptop.php"; ?>
			<h4 class="pull-left">Orders</h4>
				<br>
				<br>
				<table class="table table-striped">
					<tr>
						<th>S.No</th>
						<th>Customer Name</th>
						<th>Customer Phone</th>
						<th>Ordered On</th>
						<th>Action</th>
					</tr>
					<?php $i=1; foreach($model->getAllFrom("orders", "status=1") as $order): ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $order['customername']; ?></td>
						<td><?= $order['customerphone']; ?></td>
						<td><?= date("d-m-Y H:i", strtotime($order['orderedon'])); ?></td>
						<td>
							<a href="vieworder.php?id=<?=$order['id']; ?>">
								<i class="glyphicon glyphicon-info-sign"></i>
							</a>
						</td>
					</tr>
					<?php $i++; endforeach; ?>
				</table>
			<?php require "tmpbottom.php"; ?>
				