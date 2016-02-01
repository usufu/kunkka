<?php get_header(); ?>
	<div id="primary">
		<?php if ( have_posts() ):while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="single-post">
				<div class="post-header">
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"
					                          title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<div class="post-meta">
					<ul class="inline-ul">
						<li class="inline-li">
							<?php the_time( 'Y/m/d' ); ?>
						</li>
						<li class="inline-li">
							<span class="post-span">·</span>
						</li>
						<li class="inline-li">
							<?php the_category( ' , ' ); ?>
						</li>
						<?php mutheme_views(); ?>
						<li class="inline-li">
							<span class="post-span">·</span>
						</li>
						<li class="inline-li">
							<?php comments_popup_link( '0 reply', '1 reply', '% replies' ); ?>
						</li>
						<?php mutheme_likes(); ?>
					</ul>
				</div>
				<div class="post-body clearfix">
					<div class="post-content"><?php the_content( '' ); ?></div>
				</div>
				<div class="post-tags">
					<?php the_tags(); ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
		<?php comments_template(); ?>
	</div>
	<!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>