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
			<h4 class="pull-left">Base Pizza</h4>
				<a href="addpizza.php" class="btn btn-default btn-sm pull-right">
					<i class="glyphicon glyphicon-plus"></i>
					Add New
				</a>
				<br>
				<br>
				<table class="table table-striped">
					<tr>
						<th>S.No</th>
						<th>Pizza Title</th>
						<th>Size</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
					<?php $i=1; foreach($model->getAllFrom("basepizza") as $basepizza): ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $basepizza['ptitle']; ?></td>
						<td><?= $basepizza['psize']; ?></td>
						<td><?= $basepizza['price']; ?> Euro</td>
						<td>
							<a href="updatepizza.php?id=<?=$basepizza['id']; ?>">
								<i class="glyphicon glyphicon-pencil"></i>
							</a>
							<a href="basepizza.php?delete=<?=$basepizza['id']; ?>" onclick="return confirm('Are you sure to delete this item?');">
								<i class="glyphicon glyphicon-trash"></i>
							</a>
						</td>
					</tr>
					<?php $i++; endforeach; ?>
				</table>
			<?php require "tmpbottom.php"; ?>
				