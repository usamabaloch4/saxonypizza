</div>
		</div>
	</div>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#tastock").click(function(){
				$("#newstock").slideDown();
			});

			$("#clnewstock").click(function(e){
				e.preventDefault();
				$("#newstock").slideUp();
			});
		});
	</script>
</body>
</html>