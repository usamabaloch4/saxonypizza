
		</div>
	</div>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
	  AOS.init();
	</script>
	<script>
		

		$(".bps").click(function(){
			item = $(this);
			$("#bpid").val(item.attr("pid"));
			$("a[href='#ingredinets'").tab("show");
		});

		$("#inglink").click(function(e){
			if($("#bpid").val() == "")
			{
				showALert("Please select a base pizza.");
				return false;
			}
			else
				return true;

		});

		$("#atclink").click(function(e){
			if($("#bpid").val() == "")
			{
				showALert("Please select a base pizza.");
				return false;
			}
			else if($(".stir:checked").length < 1)
			{
				showALert("Please select atleast one ingredinets");
				return false;
			}
			else
				return true;

		});

		$(".pbox:visible").addClass("animate__animated animate__bounce animate__delay-2s");

		function showALert(message)
		{
			$("#alertmsg").html(message);
			$("#alertmodal").modal("show");
		}
	</script>
</body>
</html>
	