<?php 
	require "model.php"; 
	$model = new Model();
	if(isset($_GET['delete']) && $_GET['delete'] != '')
	{
		$model->deleteById($_GET['delete'], 'supplier');
		header("location: suppliers.php");
	}
	if(isset($_GET['stchange']) && $_GET['stchange'] != '')
	{
		$result = $model->changeStatus($_GET['status'], $_GET['stchange'], 'supplier');
		header("location: suppliers.php");
	}
?>
<?php require "tmptop.php"; ?>


			<h4 class="pull-left">Suppliers</h4>
				<a href="addsupplier.php" class="btn btn-default btn-sm pull-right"> 
					<i class="glyphicon glyphicon-plus"></i>
					Add New
				</a>
				<br>
				<br>
				<table class="table table-striped">
					<tr>
						<th>S.No</th>
						<th>Supplier Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php $i=1; foreach($model->getAllFrom("supplier") as $supplier): ?>
						<tr>
							<td><?= $i; ?></td>
							<td><?= $supplier['sname']; ?></td>
							<td><?= $supplier['sphone']; ?></td>
							<td><?= $supplier['saddress']; ?></td>
							<td>
								<div class="sttoggle">
									<?= 
										$supplier['status'] ? 
											'<span class="label label-success">Visible</span>' : '<span class="label label-danger">Hidden</span>'; 
									?>
									<br>
									<small>
										<?php if($supplier['status']): ?>
											<a 
												href="suppliers.php?stchange=<?=$supplier['id']; ?>&status=0" 
												onclick="return confirm('Are you sure to change status of this item?');" 
												class="text-danger"
											>
												<i class="glyphicon glyphicon-eye-open"></i> Make Hidden
											</a>
										<?php else: ?>
											<a 
											href="suppliers.php?stchange=<?=$supplier['id']; ?>&status=1" 
												onclick="return confirm('Are you sure to change status of this item?');" 
												class="text-success"
											>
												<i class="glyphicon glyphicon-eye-open"></i> Make Visible
											</a>
										<?php endif; ?>
									</small>
								</div>

							</td>
							<td>
								<!-- <a href="">
									<i class="glyphicon glyphicon-eye-open"></i>
								</a> -->
								<a href="updatesupplier.php?id=<?= $supplier['id']; ?>">
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								<a href="suppliers.php?delete=<?= $supplier['id']; ?>">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							</td>
						</tr>
					<?php $i++; endforeach; ?>
				</table>
			<?php require "tmpbottom.php"; ?>
				