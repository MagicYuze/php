<?php 
	echo '
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet">首页</span></a></li>	
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>用户管理<span class="hidden-tablet"></span> <span class="label">2</span></a>
							<ul>
								<li><a class="submenu" href="showUser.php"><i class="icon-eye-open"></i>查看用户<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="editUser.php"><i class="icon-signin"></i><span class="hidden-tablet">添加用户</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>品牌管理<span class="hidden-tablet"></span> <span class="label">2</span></a>
							<ul>
								<li><a class="submenu" href="showCategory.php"><i class="icon-eye-open"></i>查看品牌<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="editCategory.php"><i class="icon-signin"></i><span class="hidden-tablet">添加品牌</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>手机管理<span class="hidden-tablet"></span> <span class="label">2</span></a>
							<ul>
								<li><a class="submenu" href="showGoods.php"><i class="icon-eye-open">查看手机</i><span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="editGoods.php"><i class="icon-signin"></i><span class="hidden-tablet">添加手机</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>订单管理<span class="hidden-tablet"></span> <span class="label">5</span></a>
							<ul>
								<li><a class="submenu" href="searchOrder.php"><i class="icon-eye-open"></i>查询订单<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="showOrder.php?method=check&state=3"><i class="icon-eye-open"></i>所有订单<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="showOrder.php?method=check&state=0"><i class="icon-shopping-cart"></i>待发货订单<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="showOrder.php?method=check&state=1"><i class="icon-truck"></i><span class="hidden-tablet">待收货订单</span></a></li><li><a class="submenu" href="showOrder.php?method=check&state=2"><i class="icon-ok"></i>已完成订单<span class="hidden-tablet"></span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>评论管理<span class="hidden-tablet"></span> <span class="label">3</span></a>
							<ul>
								<li><a class="submenu" href="showComment.php"><i class="icon-eye-open"></i>查看所有评论<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="searchComment.php?type=手机"><i class="icon-eye-open"></i>查询手机评论<span class="hidden-tablet"></span></a></li>
								<li><a class="submenu" href="searchComment.php?type=用户"><i class="icon-eye-open"></i>查询用户评论<span class="hidden-tablet"></span></a></li>
							</ul>	
						</li>
						<li><a href="login.php?del"><i class="icon-lock"></i><span class="hidden-tablet">退出登录</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
	';
 ?>