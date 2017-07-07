	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li <?php
			if($filename  == "tempadminindex")
				echo 'class="active"';
			?>
			><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li <?
			if($filename  == "tempaddpost")
				echo 'class="active"';
			?>><a href="addpost.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Add post</a></li>
			<li <?
			if($filename  == "tempaddstore")
				echo 'class="active"';
			?>><a href="addstore.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Add store</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="http://www.h-dslr.com/"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Fairouz</a></li>
		</ul>
		<div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
	</div><!--/.sidebar-->