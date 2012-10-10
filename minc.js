    	function preview(clicked) {
			var clicked  = $(clicked);
			
			$.ajax({
				"url":"minc_setup.php",
				"data":"fetch="+clicked.data("id"),
				"success":function(response) {
			
					var firstLine = response.split('\n')[0];
					var code      = response.replace(firstLine+"\n","");
				
					$("#content").val(code);
					$("#contentid").val(clicked.data("id"));
					$("#contentsummary").val(firstLine);
				}
			});
		}