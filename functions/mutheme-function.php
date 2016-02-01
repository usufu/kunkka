<?php
/**
 * @name Mutheme function
 * @description Kunkka theme basic functions
 * @version     1.0.0
 * @author      mufeng (http://mufeng.me)
 * @url https://mufeng.me/wordpress-mobile-theme-kunkka.html
 * @package     Kunkka
 **/

/**
 * Theme comment walker
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function mutheme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	global $commentcount;

	if ( ! $commentcount ) {
		$page         = ( ! empty( $in_comment_loop ) ) ? get_query_var( 'cpage' ) - 1 : get_page_of_comment( $comment->comment_ID, $args ) - 1;
		$cpp          = get_option( 'comments_per_page' );
		$commentcount = $cpp * $page;
	}

	if ( ! $comment->comment_parent ) {
		//$email  = $comment->comment_author_email;
		$avatar = get_avatar( $comment, $size = '50' );
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-avatar"><?php echo $avatar; ?></div>
					<span class="comment-floor"><?php ++ $commentcount;
						switch ( $commentcount ) {
							case 1:
								print_r( "沙发" );
								break;
							case 2:
								print_r( "板凳" );
								break;
							case 3:
								print_r( "地板" );
								break;
							default:
								printf( __( '%s楼' ), $commentcount );
						} ?></span>

			<div class="comment-data">
				<span class="comment-span <?php if ( $comment->user_id == 1 ) {
					echo "comment-author";
				} ?>"><?php printf( __( '%s' ), get_comment_author_link() ) ?></span>
				<span
					class="comment-span comment-date"><?php echo mutheme_time_since( abs( strtotime( $comment->comment_date_gmt . "GMT" ) ), true ); ?></span>
			</div>
			<div class="comment-text"><?php comment_text() ?></div>
			<div class="comment-reply"><?php comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => __( '回复' )
				) ) ) ?></div>
		</div>
	<?php } else {
		?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body comment-children-body">
			<div class="comment-avatar"><?php echo get_avatar( $comment, $size = '30' ); ?></div>
			<span
				class="comment-floor"><?php comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => __( '回复' )
				) ) ) ?></span>

			<div class="comment-data">
				<span class="comment-span <?php if ( $comment->user_id == 1 ) {
					echo "comment-author";
				} ?>">
					<?php
					$parent_id      = $comment->comment_parent;
					$comment_parent = get_comment( $parent_id );
					printf( __( '%s' ), get_comment_author_link() );
					?>
				</span>
				<span
					class="comment-span comment-date"><?php echo mutheme_time_since( abs( strtotime( $comment->comment_date_gmt . "GMT" ) ), true ); ?></span>
			</div>
			<div class="comment-text">
				<span class="comment-to"><a href="<?php echo "#comment-" . $parent_id; ?>"
				                            title="<?php echo mb_strimwidth( strip_tags( apply_filters( 'the_content', $comment_parent->comment_content ) ), 0, 100, "..." ); ?>">@<?php echo $comment_parent->comment_author; ?></a>：</span>
				<?php echo get_comment_text(); ?>
			</div>
		</div>
	<?php }
}

add_filter( 'get_avatar', 'mutheme_avatar', 10, 3 );
function mutheme_avatar( $avatar ) {
	if ( ! is_admin() ) {
		$avatar = str_replace( 'src=', 'src="' . mutheme_cdn( mutheme_image( 'placeholder.png' ) ) . '" data-original=', $avatar );
	}

	if ( mutheme_settings( 'avatar' ) == 1 ) {
		$avatar = str_replace( array(
			"www.gravatar.com",
			"0.gravatar.com",
			"1.gravatar.com",
			"2.gravatar.com"
		), "gravatar.duoshuo.com", $avatar );
	}

	return $avatar;
}