<?php
	$postsData = $GLOBALS['postsData'];
	$benchmarksData = $GLOBALS['benchmarksData'];
	$postsBenchData = $GLOBALS['postsBenchData'];
	$dailyData = $GLOBALS['dailyData'];
	$filename =  basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fairouz - Dashboard</title>

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
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Fairouz Panel</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
<!--
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$benchmarksData['clicks']?></div>
							<div class="text-muted">Total clicks</div>
						</div>
					</div>
				</div>
			</div>
-->
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$benchmarksData['numAvailable']?></div>
							<div class="text-muted">Advertisement</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$benchmarksData['visitors']?></div>
							<div class="text-muted">Users</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$benchmarksData['pages']?></div>
							<div class="text-muted">Page Views</div>
						</div>
					</div>
				</div>
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
			<div  class="col-xs-6 col-md-9" >
				<?php
					foreach ($postsData as $post) {
						echo '
							<div class="col-xs-6 col-md-3">
								<div class="panel panel-default">
									<div class="panel-body easypiechart-panel">
										<h4>'.$post['name'].'</h4>';
										if(isset($postsBenchData[$post['post_id']]))
											echo '<div class="easypiechart" data-percent="'.round($postsBenchData[$post['post_id']],3).'" ><span class="percent">'.round($postsBenchData[$post['post_id']],3).'%</span>';
										else
											echo '<div class="easypiechart" data-percent="0.000" ><span class="percent">0.000%</span>';
										echo '</div>
									</div>
								</div>
							</div>
						';
					}
				?>
			</div>
			<div class="col-md-3">
			
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Active Posts on Fairouz</div>
					<div class="panel-body">
						<ul class="todo-list">
							<?php
								foreach ($postsData as $post) {
									echo '
										<li class="todo-list-item">
											<div class="checkbox">
												<label>'.$post['name'].'</label>
											</div>
											<div class="pull-right action-buttons">
												<a href="singlepost.php?id='.$post['id'].'"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
											</div>
										</li>
									';
								}
								?>

						</ul>
					</div>
					<div class="panel-footer">
							<label>Fairouz</label>
					</div>
				</div>
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script type="text/javascript">
		var lineChartData = {
			labels : [
						<?php
							$x = "";
							for($i=0;$i<count($dailyData);$i++){
								$day = $dailyData[$i];
								$x .= "\"".$day['day']."\",";
							}
							$x = substr($x,0,strlen($x)-1);
							echo $x;
						?>
			],
			datasets : [
				{
					label: "Daily benchmarks",
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 1)",
					pointColor : "rgba(48, 164, 255, 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(48, 164, 255, 1)",
					data : [
								<?php
									$x = "";
									for($i=0;$i<count($dailyData);$i++){
										$day = $dailyData[$i];
										$x .= $day['num'].",";
									}
									$x = substr($x,0,strlen($x)-1);
									echo $x;
								?>
					]
				}
			]

		}
		window.onload = function(){
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true
			});	
};
		</script>	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

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
