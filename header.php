<!DOCTYPE html>
<html>
<head>
	<?php mutheme_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="header">
	<div class="container clearfix">
		<h2 class="logo">
			<a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
				<img src="<?php echo mutheme_image( 'logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="102"
				     height="30"/>
			</a>
		</h2>

		<div class="global-nav left">
			<ul class="gnul">
				<li class="gnli <?php if ( is_home() ) {
					echo "current";
				} ?>">
					<a class="gna" href="<?php bloginfo( 'url' ); ?>" title="首页"><span>首页</span></a>
				</li>
				<li class="gnli dropdown<?php if ( is_single() ) {
					echo " current";
				} ?>">
					<a class="gna dropdown-link" href="javascript:;">
						<span>导航</span>
					</a>

					<div class="dropdown-arrow1"></div>
					<div class="dropdown-arrow2"></div>
					<div class="submenu">
						<div class="tab-content">
							<table>
								<tbody>
								<tr class="trline">
									<td class="tdleft">分类</td>
									<td class="tdright">
										<div class="tab-categories">
											<ul>
												<?php wp_list_categories( '&title_li=' ); ?>
											</ul>
										</div>
									</td>
								</tr>
								<tr class="trline">
									<td class="tdleft">页面</td>
									<td class="tdright">
										<?php wp_nav_menu( array(
											'theme_location'  => 'global-menu',
											'container_class' => 'tab-categories'
										) ); ?>
									</td>
								</tr>
								<tr>
									<td class="tdleft">标签</td>
									<td class="tdright">
										<div class="tab-tags">
											<?php wp_tag_cloud( array(
												'unit'     => 'px',
												'smallest' => 12,
												'largest'  => 12,
												'number'   => mutheme_settings( 'tag_number' ),
												'format'   => 'flat',
												'orderby'  => 'count',
												'order'    => 'DESC'
											) ); ?>
										</div>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="global-nav global-custom-nav left">
			<?php wp_nav_menu( array(
				'theme_location'  => 'top-menu',
				'container_class' => 'top-menu'
			) ); ?>
		</div>
		<form method="get" class="search-form" action="<?php bloginfo( 'home' ); ?>/">
			<input type="text" name="s" class="search-input" size="15"/>
			<button type="submit" class="search-submit">
				<span class="mutheme-search"></span>
			</button>
		</form>
	</div>
</div>
<!-- #header -->
<div id="content">
	<div class="container clearfix">