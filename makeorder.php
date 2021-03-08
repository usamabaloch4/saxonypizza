<?php
require "tmptop.php";


$result = '';

if(isset($_POST['choice']))
{
	if(!empty($_SESSION['incorder']))
		$result = $model->reOrder($_POST);
	else	
		$result = $model->addToCart($_POST);
	if($result == 'success')
		header("location: ". $_POST['choice']);	
}
?>
			<div class="ptitle">
				<h3>Customize</h3>
				<h1>Your Order Here</h1>
				<h3>In just two steps.!</h3>
			</div>

			<?php if($result != ''): ?>
				<?php foreach ($result as $value): ?>
					<div class="alert alert-warning"><?=$value; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<div  data-aos="fade-up">
			<div class="steps" id="steps">
				<ul class="nav nav-pills nav-justified" role="tablist">
					<li class="<?= ($result == "" ? 'active' : ''); ?>"><a href="#basepizzas" role="tab" data-toggle="tab">Select Base Pizza</a></li>
					<li class="<?= ($result != "" ? 'active' : ''); ?>">
						<a href="#ingredinets" id="inglink" role="tab"  data-toggle="tab">Choose Ingredients</a>
					</li>
					<li>
						<a href="#addtocart" role="tab" data-toggle="tab" id="atclink">
							<i class="glyphicon glyphicon-shopping-cart"></i> Add To Cart
						</a>
					</li>
				</ul>
			</div>

			<form action="" method="post">

				<input type="hidden" name="basepizza" value="<?= @$_POST['basepizza']; ?>" id="bpid">

				<div class="tab-content">

					<div class="basepizzas tab-pane <?= ($result == "" ? 'active' : 'fade'); ?>" role="tabpanel" style="" id="basepizzas">
						<div class="row">
							<?php foreach ($model->getAllFrom('basepizza') as $pizza):?>
								<div class="col-md-6">
									<div class="pitem" id="pitem">
										<div class="img">
											<img src="img/<?=$pizza['thumbnail'];?>" alt="" class="img-rounded img-responsive">
										</div>
										<div class="details">
											<h4><?= $pizza['ptitle']; ?></h4>
											<p>Size: <?= $pizza['psize']; ?></p>
											<strong>Price: <?= $pizza['price']; ?> Euro</strong>

											<button class="btn btn-black bps" type="button" pid="<?=$pizza['id']; ?>">
												<i class="glyphicon glyphicon-check"></i>
												Select & Customize
											</button>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

					</div>

					<div class="ingredinets  tab-pane  <?= ($result != "" ? 'active' : 'fade'); ?>" id="ingredinets"  role="tabpanel">
						<div class="row">
							<?php $i=0; foreach ($model->getAllFrom('ingredient', 'istatus=1') as $ingredient):?>
								<div class="col-md-3">
									<div class="iitem">
										<div class="img">
											<img src="img/<?=$ingredient['ithumbnail'];?>" alt="" class="img-circle img-responsive">
										</div>
										<div class="idetails">
											<h4><?= $ingredient['ititle']; ?></h4>

											<div class="provenances text-left">
												<Strong>Provenances</Strong>
												<?php foreach($model->getAllFrom('stock', "iid=$ingredient[id] and instock > 0") as $provenance): ?>

													<label style="display: block;" class="stitem">
														<input 
																type="radio" 
																name="ingredient[<?=$i; ?>]" 
																class="stir" 
																value="<?=$provenance['id']; ?>"

																<?php 
																	if(isset($_POST['ingredient'][$i]) && $_POST['ingredient'][$i] == $provenance['id']) 
																		echo "checked"; 
																?>
														>
														<span class="btn btn-default btn-sm btn-block"><?= $provenance['provenance']; ?>
														 &nbsp;&nbsp;&nbsp; <?= $provenance['price']; ?>&euro;
														</span>
													</label>
												<?php endforeach; ?>
											</div>
										</div>


									</div>
								</div>
							<?php $i++; endforeach; ?>
						</div>

					</div>


					<div class="tab-pane addtocart" id="addtocart">
						<div class="text-center">
							<h3>Your Composition is ready!</h3>
							<p>Great! you have made your delicious composition, if you want to order an other compostition click to continue shopping otherwise click to "To Shopping Cart" button to redirect you to your shopping cart for checkout.</p>
							<br>
							<button class="btn btn-default" type="submit" name="choice" value="makeorder.php">Continue Shopping</button>
							<button class="btn btn-black" type="submit" name="choice" value="cart.php"><i class="glyphicon glyphicon-shopping-cart"></i> To Shopping Cart</button>
						</div>
					</div>




				</div>


			</form>
			</div>

			<div style="height: 500px;"></div>

			<div>

<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Caution.!</h4>
      </div>
      <div class="modal-body">
        <p id="alertmsg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require "tmpbottom.php"; ?>