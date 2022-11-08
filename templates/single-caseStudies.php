<?php

get_header();?>

<?php
// Start the loop.
while (have_posts()):
    the_post();
    $cptpress_cs_cat = get_the_terms($post->ID, 'case-study-category');

    ?>


	<article id="atat-<?php echo get_the_ID(); ?>" class="atat-single">
			<div class="atat-header">
	            <?php if (has_post_thumbnail()): ?>
	            <div class="atat-image">
	                <?php the_post_thumbnail('large');?>
	            </div>
	            <?php endif;?>
	    </div>
        <div class="atat-footer">
                        <span class="atat-cat"><strong>Categories:</strong>
                <?php
foreach ($cptpress_cs_cat as $key => $value) {
    echo $value->name;
    echo ", ";
}
?>
            </span>
            <h2 class="atat-title"><?php the_title();?></h2>
            <?php if (!empty(get_the_content())): ?>
            <?php the_content();?>
            <?php endif;?>
        </div>
</article>

<?php endwhile;?>
<?php get_footer();?>
