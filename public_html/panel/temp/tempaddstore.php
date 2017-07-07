<?php
	if(empty($GLOBALS['countries']))
		throw new Exception("template : No information found");
		
	$countries = $GLOBALS['countries'];
	$filename =  basename(__FILE__, '.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add store to Fairouz</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/datepicker3.css" rel="stylesheet">
<link href="../css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<? include 'Adminheader.php' ?>
	
	<? include 'Adminleft-header.php' ?>

		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add store</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add store</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Add store</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form" method="post" action="addstore.php">
							
								<div class="form-group">
									<label>Store Name</label>
									<input name="name" class="form-control">
								</div>
									
								<div class="form-group">
									<label>Website URL</label>
									<input name="url" class="form-control">
								</div>

								<div class="form-group">
									<label>Username</label>
									<input name="username" class="form-control">
								</div>

								<div class="form-group">
									<label>email</label>
									<input name = "email" class="form-control">
								</div>

								<div class="form-group">
									<label>Password</label>
									<input name="password" type="password" class="form-control">
								</div>							
							</div>
							<div class="col-md-6">

								<div class="form-group">
									<label>country</label>
									<?php
										foreach ($countries as $country) {
											echo'
									<div class="radio">
										<label>
											<input type="radio" name="country" id="optionsRadios1" value="'.$country['id'].'" checked>'.$country['name'].'
										</label>
									</div>
											';
										}
									?>
								</div>

								<button type="submit" class="btn btn-primary">Submit Button</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->

	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>