<!DOCTYPE html>
<html>
<head>
<title>Check | Reiches14</title>
{{HTML::script('assets/js/jquery-1.9.0.min.js')}}
<script type="text/javascript">

 	function checkThis() {
     		$.ajax({
			'url': 'checkSkill',
			'type' : 'post',
			'data' : "Archit",
			'success': function (data) {
				JSON.parse(data, function(k, v) {
					console.log(k+" => "+v);
				});
			},
		});
 	}

</script>
</head>
<body>
	<button onclick="checkThis()"></button>
</body>
</html>