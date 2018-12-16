<?php 
	echo '
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet">首页</span></a></li>	
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>分类管理<span class="hidden-tablet"></span> <span class="label">2</span></a>
							<ul>
								<li><a class="submenu" href="showCategory.php"><i class="icon-eye-open"></i>查看分类<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="editCategory.php"><i class="icon-signin"></i><span class="hidden-tablet">添加分类</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>商品管理<span class="hidden-tablet"></span> <span class="label">2</span></a>
							<ul>
								<li><a class="submenu" href="#"><i class="icon-eye-open">查看商品</i><span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="#"><i class="icon-signin"></i><span class="hidden-tablet">添加商品</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>订单管理<span class="hidden-tablet"></span> <span class="label">5</span></a>
							<ul>
								<li><a class="submenu" href="#"><i class="icon-eye-open"></i>所有订单<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="#"><i class="icon-spinner"></i><span class="hidden-tablet">未付款订单</span></a></li>
								<li><a class="submenu" href="#"><i class="icon-shopping-cart"></i>待发货订单<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="#"><i class="icon-truck"></i><span class="hidden-tablet">待收货订单</span></a></li><li><a class="submenu" href="#"><i class="icon-ok"></i>已完成订单<span class="hidden-tablet"></span></a></li>
							</ul>	
						</li>
						<li><a href="form.php"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a href="table.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="login.php"><i class="icon-lock"></i><span class="hidden-tablet">退出登录</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
	';
 ?>