<?php 
	require "model.php"; 
	$model = new Model();

	$data = $model->getRowById($_GET['id'], 'ingredient');
	$result  = '';
	if(isset($_POST['provenance']))
	{
		$result = $model->addStock($_POST);
	}

	if(isset($_POST['updatestock']))
	{
		$result = $model->reStock($_POST['stid'], $_POST['updatestock']);
	}
?>
<?php require "tmptop.php"; ?>
			<h4>View Ingredient #<?= $_GET['id']; ?></h4>
			<hr>


			<table class="table table-bordered">
				<tr>
					<th>Ingredient Id</th>
					<td><?= $data['id']; ?></td>
				</tr>
				<tr>
					<th>Ingredient Title</th>
					<td><?= $data['ititle']; ?></td>
				</tr>
				<tr>
					<th>Ingredient Status</th>
					<td>
						<div class="sttoggle">
									<?= 
										$data['istatus'] ? 
											'<span class="label label-success">Visible</span>' : '<span class="label label-danger">Hidden</span>'; 
									?>
									<small>
										<?php if($data['istatus']): ?>
											<a 
												href="ingredients.php?stchange=<?=$data['id']; ?>&title=<?=$data['ititle']; ?>&status=0" 
												onclick="return confirm('Are you sure to change status of this item?');" 
												class="text-danger"
											>
												<i class="glyphicon glyphicon-eye-open"></i> Make Hidden
											</a>
										<?php else: ?>
											<a 
											href="ingredients.php?stchange=<?=$data['id']; ?>&title=<?=$data['ititle']; ?>&status=1" 
												onclick="return confirm('Are you sure to change status of this item?');" 
												class="text-success"
											>
												<i class="glyphicon glyphicon-eye-open"></i> Make Visible
											</a>
										<?php endif; ?>
									</small>
								</div>
					</td>
				</tr>
				<tr>
					<th>Ingredient Thumbnail</th>
					<td>
						<img src="../img/<?= $data['ithumbnail']; ?>" width="200" alt="">
					</td>
				</tr>
			</table>


			<h4 class="pull-left">Ingredient Stock</h4>
				<button class="btn btn-default btn-sm pull-right" id="tastock"> 
					<i class="glyphicon glyphicon-plus"></i>
					Add Stock
				</button>
				<br>
				<br>

				<div class="newstock" id="newstock">
					<h5 class="">Add New Stock <a href="#" id="clnewstock" class="pull-right">&times;</a></h5>
					<hr>
					<form action="" method="post">
						<div class="row">
							<div class="col-sm-4">
								<label>Supplier</label>
								<select name="supplier" id="" class="form-control">
									<?php foreach($model->getAllFrom("supplier") as $sup): ?>
										<option value="<?=$sup['id']; ?>"><?=$sup['sname']; ?></option>
									<?php endforeach; ?>
								</select>
								<br>
							</div>
							<input type="hidden" name="ingredient" value="<?=$data['id']; ?>">
							<div class="col-sm-4">
								<label>Provenance</label>
								<input type="text" class="form-control" name="provenance">
								<br>
							</div>
							<div class="col-sm-4">
								<label>&nbsp;</label>
								<button class="btn-block btn-primary btn">Add Stock</button>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>Price</label>
								<input type="text" class="form-control" name="price">
							</div>
							<div class="col-sm-4">
								<label>Stock</label>
								<input type="text" class="form-control" name="stock">
							</div>
							<div class="col-sm-4">

							</div>
						</div>
					</form>
				</div>

				<?php if($result !=""): ?>
					<div class="alert alert-warning"><?= $result; ?></div>
				<?php endif; ?>

				<table class="table table-striped">
					<tr>
						<th>S.No</th>
						<th>Supplier Name</th>
						<th>Provenance</th>
						<th width="200">In Stock</th>
						<th>price</th>
					</tr>
					
					<?php $i=1; foreach ($model->getStockReportByIngredient($data['id']) as $stock): ?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$stock['sname']; ?></td>
							<td><?=$stock['provenance']; ?></td>
							<td>
								<form class="row" action="" method="post">
								<div class="col-sm-12">
								<div class="input-group">
							      <input type="text" class="form-control" name="updatestock" value="<?= $stock['instock']; ?>">
							      <input type="hidden" value="<?= $stock['stid']; ?>" name="stid">
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="submit">Restock</button>
							      </span>
							    </div><!-- /input-group -->	
							    </div>
								</form>
							</td>
							<td><?=$stock['price']; ?>&euro;</td>
						</tr>
					<?php $i++; endforeach; ?>
					
					
				</table>


				<div style="padding-bottom: 200px;"></div>
			<?php require "tmpbottom.php"; ?>
				