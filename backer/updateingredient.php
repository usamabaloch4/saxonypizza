<?php 
	require "model.php"; 
	$model = new Model();
	$result = '';
	if(isset($_POST['ititle']))
	{
		$result = $model->updateIngredient($_POST['ititle'], $_POST['istatus'], $_GET['id']);
		if($result == 'success')
			header('location: ingredients.php');

	}



	$data = $model->getRowById($_GET['id'], 'ingredient');
?>
<?php require "tmptop.php"; ?>
	<h4 class="pull-left">Edit Ingredient</h4>
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
					<input type="text" class="form-control" name="ititle" value="<?= $data['ititle']; ?>"><br>
				</div>
				<div>
					<label>Thumbnail</label>
					<img src="../img/<?=$data['ithumbnail']; ?>" alt="" width="300">
				</div>

				<input type="hidden" name="istatus" value="<?= $data['istatus']; ?>">


			</div>
			<div class="col-sm-6">
				<br>
				<button class="btn btn-primary btn-block">
					Update Ingredient
				</button>
			</div>
		</div>
	</form>
				
<?php require "tmpbottom.php"; ?>
				