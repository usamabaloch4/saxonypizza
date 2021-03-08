<?php 
	require "model.php"; 
	$model = new Model();
	$result = '';
	if(isset($_POST['ititle']))
	{
		$result = $model->addIngredient($_POST['ititle'], $_FILES['ithumbnail']);
		if($result == 'success')
			header('location: ingredients.php');

	}
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Add Ingredient</h4>
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
					<label>Ingredient Title</label>
					<input type="text" class="form-control" name="ititle" value="<?= @$_POST['ititle']; ?>"><br>
				</div>
				<div>
					<label>Thumbnail</label>
					<input type="file" class="form-control" name="ithumbnail">
				</div>


			</div>
			<div class="col-sm-6">
				<br>
				<button class="btn btn-primary btn-block">
					Add Ingredient
				</button>
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				