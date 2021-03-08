<?php
require "tmptop.php";
$result = '';
if(isset($_POST['cname']))
{
	$result = $model->placeOrder($_POST);
	if($result == 'success')
		header("location: success.php");

}


$gtotal = 0;
?>

			<div class="ptitle">
				<h3>Here's</h3>
				<h1>Your Shopping Cart</h1>
				<h3>With your order details.</h3>
			</div>
			<?php if(isset($_SESSION['orderid']) && $_SESSION['orderid'] !=""): ?>
			<div>
				<table class="table table-bordered">
					<tr>
						<th>S.No</th>
						<th>Base Pizza </th>
						<th>Price</th>
						<th>Ingredients</th>
						<th>Subtotal</th>
					</tr>
					<?php 
						$i=1; 
						foreach($model->getCartItems($_SESSION['orderid']) as $item): 
							$subtotal = $item['price'];
					?>
						<tr>
							<td><?= $i; ?></td>
							<td><?=$item['itemtitle']; ?></td>
							<td><?= $item['price']; ?>&euro;</td>
							<td>
								<ul>
									<li style="list-style: none;"><strong>Ingredient</strong> <strong class="pull-right">Price</strong></li>
								<?php 
									foreach($item['ingredients'] as $ing)
									{
										$subtotal += $ing['price'];
										echo '<li>'.$ing['itemtitle'].' <small>('.$ing['provenance'].')</small> <span class="pull-right">'. $ing['price'].'&euro;</span></li>';
									}
								?>
								</ul>
							</td>
							<th><?= $subtotal; ?>&euro;</th>
						</tr>
					<?php 
						$i++; 
						$gtotal += $subtotal;
						endforeach; 
					?>
				</table>

				<div class="row">
					<div class="col-sm-8">
						<h4>Provide your data to checkout.</h4>
						<hr>

						<?php if($result !=""): ?>
							<div class="alert alert-danger"><?=$result; ?></div>
						<?php endif; ?>

						<form action="" method="post">
							<input type="hidden" name="oid" value="<?= $_SESSION['orderid']; ?>">
							<div class="row">
								<div class="col-md-8">
									<label>Your Name:</label>
									<input type="text" class="form-control" name="cname" value="<?= @$_POST['cname']; ?>">
									<br>
						
									<label>Your Phone:</label>
									<input type="text" class="form-control" name="cphone" value="<?= @$_POST['cphone']; ?>">
									<br>
								
									<label>Your Address:</label>
									<textarea class="form-control" name="caddress" rows="5"><?= @$_POST['caddress']; ?></textarea>
								</div>
								<div class="col-md-4">
									<label>&nbsp;</label><br>
									<button class="btn btn-primary btn-block">Place Order</button>
								</div>
							</div>
						</form>
						
					</div>
					<div class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">Grand Total</div>
							<div class="panel-body">
								<h1><?= $gtotal; ?>&euro;</h1>
								<small>Here's your total bill inclusive all taxes.</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php else: ?>
				<h4 class="text-center alert alert-warning">There's no item in your shopping cart.</h4>
			<?php endif; ?>

			<div style="height: 500px;"></div>

			<div>


<?php require "tmpbottom.php"; ?>