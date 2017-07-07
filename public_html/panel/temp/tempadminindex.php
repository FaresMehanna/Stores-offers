<?php
	
	if(empty($GLOBALS['stores']))
		throw new Exception("Template : No data found");
	$stores = &$GLOBALS['stores'];
	$filename =  basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin panel</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/datepicker3.css" rel="stylesheet">
<link href="../css/bootstrap-table.css" rel="stylesheet">
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
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Main Page</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Daily page views</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Stores</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="tables/data2.json" >
						    <thead>
						    <tr>
						        <th>Store name</th>
						        <th>clicks</th>
						        <th>visitors</th>
						        <th>pageviews</th>
						        <th>Country</th>
						        <th>advertisements</th>
						        <th>Store URL</th>
						        <th>LogIn</th>
						    </tr>
						    </thead>
						    <tbody>
						    	<?php
						    		foreach ($stores as $store)
							    	echo'
							    	<tr>
							    		<td>'.$store['name'].'</td>
							    		<td>'.$store['bench']['clicks'].'</td>
							    		<td>'.$store['bench']['visitors'].'</td>
							    		<td>'.$store['bench']['pages'].'</td>
							    		<td>'.$store['country_name'].'</td>
							    		<td>'.$store['bench']['numAvailable'].'</td>
							    		<td><a href ="'.urldecode($store['website_url']).'">'.substr(urldecode($store['website_url']),0,50).'</a></td>
							    		<td><a href="elog.php?id='.$store['id'].'">LogIn</a></td>
							    	</tr>
						    	';
						    	?>
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
	</div><!--/.main-->

	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script type="text/javascript">
		var lineChartData = {
			labels : [
						<?php
							$x = "";
							$dailyData = $stores[0]['days'];
							foreach ($dailyData as $day) {
								$x .= "\"".$day['day']."\",";
							}
							$x = substr($x,0,strlen($x)-1);
							echo $x;
						?>
			],

			datasets : [
								<?php
									$x = "";
									$i = 0;

									foreach ($stores as $store) {
										$i++;
									$one = 48*$i % 255;
									$two = 164*$i % 255;
									$three = 200*$i % 255;
										$x .= '{
					label: "'.$store['name'].'",
					fillColor : "rgba('.$one.', '.$two.', '.$three.', 0.2)",
					strokeColor : "rgba('.$one.', '.$two.', '.$three.', 1)",
					pointColor : "rgba('.$one.', '.$two.', '.$three.', 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba('.$one.', '.$two.', '.$three.', 1)",
					data : [';						
										foreach ($store['days'] as $day) {
											$x .= $day['num'].",";
										}
										$x = substr($x,0,strlen($x)-1);
										$x .= "]\n},\n";
									}
									$x = substr($x,0,strlen($x)-1);
									echo $x;
								?>
					]
				}
		window.onload = function(){
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true
			});	
		};
		</script>	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/bootstrap-table.js"></script>
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
