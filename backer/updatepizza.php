<?php 
	require "model.php"; 
	$model = new Model();
	$data = $model->getPizzaById($_GET['id']);
	$result = '';
	if(isset($_POST['ptitle']))
	{
		$result = $model->updatePizza($_GET['id'], $_POST);
		if($result == 'success')
			header('location: basepizza.php');

	}
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Edit Pizza</h4>
	<br>
	<hr>

	<?php if($result !=""): ?>
		<div class="alert alert-danger">
			<?= $result; ?>
		</div>
	<?php endif; ?>

	<form action="" method="post">
		<div class="row">
			<div class="col-sm-6">
				<div>
					<label>Pizza Title</label>
					<input type="text" class="form-control" name="ptitle" value="<?= $data['ptitle']; ?>"><br>
				</div>
				<div>
					<label>Pizza Size</label>
					<input type="text" class="form-control" name="psize" value="<?= $data['psize']; ?>"><br>
				</div>
				<div>
					<label>Pizza Price</label>
					<input type="text" class="form-control" name="price" value="<?= $data['price']; ?>"><br>
					<input type="hidden" name="thumbnail" value="<?= $data['thumbnail']; ?>"><br>
				</div>

				<div>
					<button class="btn btn-primary btn-block">
						Add Pizza
					</button>
				</div>

			</div>
			<div class="col-sm-6">
				<label>Thumbnail</label>
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				