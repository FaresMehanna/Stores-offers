<?php
	//for security reasons
	if(empty($GLOBALS['data']) || empty($GLOBALS['cats']))
		throw new RuntimeException("Template : No data for posts was found");
		
	$data = $GLOBALS['data'];
	$cats = $GLOBALS['cats'];
	$filename =  basename(__FILE__, '.php');
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Posts on Fairouz</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
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
				<li class="active">Posts</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fairouz's active posts</h1>
			</div>
		</div><!--/.row-->
				
		<div class="row">
			<?php
				foreach($cats as $cat){
					echo'
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">'.$cat['name'].'</div>
							<div class="panel-body">
								<table data-toggle="table">
								    <thead>
								    <tr>
								        <th data-field="id" data-align="right">available</th>
								        <th data-field="name"><center>Post Name</center></th>
								        <th data-field="price">Your Price</th>
								    </tr>
								    </thead>
								    <tbody>';
								    foreach($data as $post){
								    	if($post['cat_id'] == $cat['id']){
								    		echo '
								    			<tr>
								    				<td data-field="id" data-align="right">'.$post['available'].'</td>
								    				<td data-field="name"><a href="singlepost.php?id='.$post['id'].'"><center>'.$post['name'].'</center></a></td>
								    				<td data-field="price">'.$post['price'].'</td>
								    			</tr>
								    		';
								    	}
								    }
								    echo '</tbody>
								</table>
							</div>
						</div>
					</div>
					';
				}
			?>
		</div><!--/.row-->	
		
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
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
