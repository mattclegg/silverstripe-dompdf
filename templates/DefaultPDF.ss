<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Default PDF</title>
		<style>
			* {
				font-family:helvetica;
				padding:0;
				margin:0;
			}
			ul{
				padding:10px 20px;
			}
			  .text p {padding-bottom:20px;}
			hr{
				border: 1px solid #566E78;
				margin: 5px 0 20px;
			}
		</style>
	</head>
<% with Page %>
	<body>
		<div style="margin:20px 50px 0; width:700px;   ">
			<div style="width:700px; height:100px; position:absolute; top:100px; left:60px;">
				<h1 style="font-weight:bold; padding:10px 0;">$Title</h1>
			</div>
			<div style="height:1000px; text-align:center; ">
				$Content
			</div>
		</div>
	</body>
<% end_with %>
</html>

