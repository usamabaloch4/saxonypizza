<?php 
	require "model.php"; 
	$model = new Model();
	$result = '';
	if(isset($_POST['sname']))
	{
		$result = $model->updateSupplier($_GET['id'],$_POST);
		if($result == 'success')
			header('location: suppliers.php');

	}
	$data = $model->getRowById($_GET['id'], 'supplier');
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Update Supplier</h4>
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
					<input type="text" class="form-control" name="sname" value="<?= $data['sname']; ?>"><br>
				</div>
				<div>
					<label>Supplier Phone</label>
					<input type="text" class="form-control" name="sphone" value="<?= $data['sphone']; ?>"><br>
				</div>
				<div>
					<label>Supplier Address</label>
					<textarea rows="5" class="form-control" name="saddress" ><?= $data['saddress']; ?></textarea><br>
				</div>

				<div>
					
				</div>

			</div>
			<div class="col-sm-6">
				<label for="">&nbsp;</label>
				<button class="btn btn-primary btn-block">
					Update Supplier
				</button>
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				