<?php 
	require "model.php"; 
	$model = new Model();

	$order = $model->getRowById($_GET['id'], 'orders');
?>
<?php require "tmptop.php"; ?>
			<h4 class="pull-left">Order #<?=$_GET['id']; ?></h4>
				<br>
				<br>
				<table class="table table-striped">
					<tr>
						<th width="180">Order Id</th>
						<td><?=$order['id']; ?></td>
					</tr>
					<tr>
						<th>Customer Name</th>
						<td><?=$order['customername']; ?></td>
					</tr>
					<tr>
						<th>Customer Phone</th>
						<td><?=$order['customerphone']; ?></td>
					</tr>
					<tr>
						<th>Customer address</th>
						<td><?=$order['customeraddress']; ?></td>
					</tr>
					<tr>
						<th>Order Items</th>
						<td>
							<?php $i=1; foreach ($model->getCartItems($order['id']) as $pizza): ?>
								<h4><?= $i.'. '.$pizza['itemtitle']; ?> Pizza</h4>
								<ul>
									<li style="list-style: none;"><strong>Ingredient &nbsp;&nbsp;&nbsp; Provenance</strong></li>
									<?php foreach ($pizza['ingredients'] as $ing):?>
										<li><?= $ing['itemtitle'].' &nbsp;&nbsp;&nbsp; '.$ing['provenance']; ?></li>
									<?php endforeach; ?>
								</ul>
							<?php $i++; endforeach; ?>
						</td>
					</tr>
					<tr>
						<th>Ordered On</th>
						<td><?=$order['orderedon']; ?></td>
					</tr>

				</table>
			<?php require "tmpbottom.php"; ?>
				