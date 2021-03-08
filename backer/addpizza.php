<?php 
	require "model.php"; 
	$model = new Model();
	$result = '';
	if(isset($_POST['ptitle']))
	{
		$result = $model->addPizza($_POST, $_FILES['thumbnail']);
		if($result == 'success')
			header('location: basepizza.php');

	}
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Add Pizza</h4>
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
					<label>Pizza Title</label>
					<input type="text" class="form-control" name="ptitle" value="<?= @$_POST['ptitle']; ?>"><br>
				</div>
				<div>
					<label>Pizza Size</label>
					<input type="text" class="form-control" name="psize" value="<?= @$_POST['psize']; ?>"><br>
				</div>
				<div>
					<label>Pizza Price</label>
					<input type="text" class="form-control" name="price" value="0"><br>
				</div>

				<div>
					<button class="btn btn-primary btn-block">
						Add Pizza
					</button>
				</div>

			</div>
			<div class="col-sm-6">
				<label>Thumbnail</label>
				<input type="file" class="form-control" name="thumbnail">
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				