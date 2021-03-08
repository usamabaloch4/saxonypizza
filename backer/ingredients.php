<?php 
	require "model.php"; 
	$model = new Model();

	if(isset($_GET['delete']) && $_GET['delete'] != '')
	{
		$model->deleteById($_GET['delete'], 'ingredient');
		header("location: ingredients.php");
	}
	if(isset($_GET['stchange']) && $_GET['stchange'] != '')
	{
		$result = $model->updateIngredient($_GET['title'], $_GET['status'], $_GET['stchange']);
		header("location: ingredients.php");
	}
?>
<?php require "tmptop.php"; ?>
			<h4 class="pull-left">Ingredients</h4>
				<a href="addingredient.php" class="btn btn-default btn-sm pull-right"> 
					<i class="glyphicon glyphicon-plus"></i>
					Add New
				</a>
				<br>
				<br>
				<table class="table table-striped">
					<tr>
						<th>S.No</th>
						<th>Ingredient Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					

					<?php $i=1; foreach($model->getAllFrom('ingredient') as $ingredient): ?>
						<tr>
							<td><?= $i; ?></td>
							<td><?= $ingredient['ititle']; ?></td>
							<td>
								<div class="sttoggle">
									<?= 
										$ingredient['istatus'] ? 
											'<span class="label label-success">Visible</span>' : '<span class="label label-danger">Hidden</span>'; 
									?>
									<br>
									<small>
										<?php if($ingredient['istatus']): ?>
											<a 
												href="ingredients.php?stchange=<?=$ingredient['id']; ?>&title=<?=$ingredient['ititle']; ?>&status=0" 
												onclick="return confirm('Are you sure to change status of this item?');" 
												class="text-danger"
											>
												<i class="glyphicon glyphicon-eye-open"></i> Make Hidden
											</a>
										<?php else: ?>
											<a 
											href="ingredients.php?stchange=<?=$ingredient['id']; ?>&title=<?=$ingredient['ititle']; ?>&status=1" 
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
								<a href="viewingredient.php?id=<?=$ingredient['id']; ?>">
									<i class="glyphicon glyphicon-info-sign"></i>
								</a>
								<a href="updateingredient.php?id=<?=$ingredient['id']; ?>">
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								<a href="ingredients.php?delete=<?=$ingredient['id']; ?>" onclick="return confirm('Are you sure to delete this item?');">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							</td>
						</tr>
					<?php $i++; endforeach; ?>
					
				</table>
			<?php require "tmpbottom.php"; ?>
				