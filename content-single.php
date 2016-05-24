<?php
/**
 * @package materializedmasonrypk
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<!-- content single -->
	<div class="card">
		<div class="entry-img">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<div class="entry-meta">
					<?php materializedmasonrypk_posted_on(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'materializedmasonrypk' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php materializedmasonrypk_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div> <!-- .entry-container -->
	</div> <!-- .card -->
</article><!-- #post-## -->
