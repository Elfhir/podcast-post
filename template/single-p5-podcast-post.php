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

				<h1 class="p5-podcast-post-name">Title : <?php the_title(); ?></h1>
				<div class="p5-podcast-post-content">Content : <?php the_content(); ?></div>
				<div>
					
					<h2>Description : <?php the_excerpt(); ?></h2>
					<h3>Image<h3>


					<?php 
						// The image is in an Attachement Post with ID++
						echo wp_get_attachment_image( get_the_ID() + 1);
					?>


					<?php 
						// basic display of custom fields
						$custom = get_post_custom(get_the_ID());
						foreach ( $custom as $key => $value ) {
							if($key === "mp3") {
								echo "<h3>". $key . " song is " . $value[0] . "</h3>";
							}
							elseif($key === "duree") {
								echo "<h3>". $key . " is : " . $value[0] . " seconds.</h3>";
							}
							elseif($key === "subtitle") {
								echo "<h3>". $key . " is : " . $value[0] . "</h3>";
							}
							elseif($key === "order") {
								echo "<h3>". $key . " is : " . $value[0] . "</h3>";
							}
						}

					?>
				
				</div>
				<p class="postmetadata">Posted in <?php wp_get_post_categories(get_the_ID()); ?></p>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

</div>
<?php get_footer(); ?>