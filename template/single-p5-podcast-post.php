<?php
/*
Template Name Posts: single-p5-podcast-post
*/
?>
<?php get_header(); ?>
<div class="main p5-podcast-posts">
	<?php wp_reset_postdata(); ?>

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="p5-podcast-post">

				<?php //get_template_part( 'content', get_post_format() ); ?>

				<h1 class="p5-podcast-post-name">Title : <?php the_title(); ?></h1>
				<p class="p5-podcast-post-description">Excerpt : <?php the_excerpt(); ?></p>
				<ul>
					<li>desc : <?php the_excerpt(); ?></li>
					<li>Image : <?php the_post_thumbnail(); ?></li>
					<?php 
						
						$custom = get_post_custom(the_ID());
						foreach ( $custom as $key => $value ) {
							if($key === "mp3") {
    							echo "<li>". $key . " => " . $value[0] . "<li />";
							}
							elseif($key === "duration") {
    							echo "<li>". $key . " => " . $value[0] . "<li />";
							}
							elseif($key === "subtitle") {
    							echo "<li>". $key . " => " . $value[0] . "<li />";
							}
							elseif($key === "order") {
    							echo "<li>". $key . " => " . $value[0] . "<li />";
							}
    					}

   					?>
				</ul>
				<p class="postmetadata">Posted in <?php the_category(', '); ?></p>
	    	</div>
	    <?php endwhile; ?>
  <?php endif; ?>

</div>
<?php get_footer(); ?>