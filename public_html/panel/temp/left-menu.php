	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li <?php
			if($filename  == "tempindex")
				echo 'class="active"';
			?>
			><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li <?
			if($filename  == "tempmystore")
				echo 'class="active"';
			?>><a href="mystore.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Store setting</a></li>
			<li <?
			if($filename  == "tempposts")
				echo 'class="active"';
			?>><a href="posts.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> All posts</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="http://www.h-dslr.com/"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Fairouz</a></li>
		</ul>
		<div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
	</div><!--/.sidebar-->