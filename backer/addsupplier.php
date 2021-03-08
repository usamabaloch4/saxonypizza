<?php 
	require "model.php"; 
	$model = new Model();
	$result = '';
	if(isset($_POST['sname']))
	{
		$result = $model->addSupplier($_POST);
		if($result == 'success')
			header('location: suppliers.php');

	}
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Add Supplier</h4>
	<br>
	<hr>

	<?php if($result !=""): ?>
		<div class="alert alert-danger">
			<?= $result; ?>
		</div>
	<?php endif; ?>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6">
				<div>
					<label>Supplier Name</label>
					<input type="text" class="form-control" name="sname" value="<?= @$_POST['sname']; ?>"><br>
				</div>
				<div>
					<label>Supplier Phone</label>
					<input type="text" class="form-control" name="sphone" value="<?= @$_POST['sphone']; ?>"><br>
				</div>
				<div>
					<label>Supplier Address</label>
					<textarea rows="5" class="form-control" name="saddress" ><?= @$_POST['saddress']; ?></textarea><br>
				</div>

				<div>
					
				</div>

			</div>
			<div class="col-sm-6">
				<label for="">&nbsp;</label>
				<button class="btn btn-primary btn-block">
					Add Supplier
				</button>
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				