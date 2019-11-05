<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Intrinsic
 * @since 1.0
 */
?>
<article class="post no-results not-found">
	<div class="entry-content">		
		<header class="page-header">
			<h3 class="page-title"><?php esc_html_e( 'Nothing Found', 'intrinsic' ); ?></h3>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p class="page-not-found-icon">
	                <i class="far fa-frown-open"></i>
	            </p>
				<p>
				<?php
					/* translators: %1$s: Permalinks of Get Start */ 
					printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'intrinsic' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); 
				?>
				</p>

			<?php elseif ( is_search() ) : ?>
				<p class="page-not-found-icon">
	                <i class="far fa-frown-open"></i>
	            </p>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'intrinsic' ); ?></p>
				<?php get_search_form( ); ?>

			<?php else : ?>
				<p class="page-not-found-icon">
				    <i class="far fa-frown-open"></i>
				</p>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'intrinsic' ); ?></p>
				<?php get_search_form( ); ?>
			<?php endif; ?>
		</div><!-- .page-content -->
	</div><!--  /.entry-content -->
</article><!-- .no-results -->