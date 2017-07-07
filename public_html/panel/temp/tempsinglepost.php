<?php
	//for security reasons
	if(empty($GLOBALS['postData']))
		throw new RuntimeException("Template : No data for post was found");
		
	$postData = $GLOBALS['postData'];
	$availableInf = $GLOBALS['availableInf'];
	$filename =  basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add to <?=$postData['name']?></title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>

	<? include 'header.php' ?>
		
	<? include 'left-menu.php' ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add to <?=$postData['name']?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?=$postData['name']?></h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					<?
						if($availableInf === false)
							echo "<label style=\"color:red\">".$postData['name']." isn't Available on your store </label>";
						else
							echo "<label style=\"color:green\">".$postData['name']." is Available on your store </label>";

					?>
					<?=$this->message?></div>
					<div class="panel-body">
						<form role="form" action="#" method="POST">
							<div class="col-md-6">							
								<div class="form-group">
									<label>Price</label>
									<input name="price" class="form-control" value="<?=$availableInf['price']?>">
								</div>
									<br>							
								<div class="form-group">
									<label>Link to the camera on your website</label>
									<input name="url" type="text" class="form-control" value="<?=urldecode($availableInf['url'])?>">
									<label>Leave it empty if you don't have website and we will redirect users to your main URL</label>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">Add</button>
								<button name="delete" value="DeLeTe" type="submit" class="btn btn-danger">Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
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
