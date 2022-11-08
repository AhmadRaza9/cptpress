<?php

get_header();?>

<?php
// Start the loop.
while (have_posts()):
    the_post();
    $cptpress_pc_primary_color = get_post_meta($post->ID, 'radiant_pc_primary_color', true);
    $cptpress_portfolio_cat = get_the_terms($post->ID, 'portfolio-category');

    ?>


	<article id="atat-<?php echo get_the_ID(); ?>" class="atat-single" style="background-color: <?php if(!empty($cptpress_pc_primary_color)){echo $cptpress_pc_primary_color;} ?>">
			<div class="atat-header">
	            <?php if (has_post_thumbnail()): ?>
	            <div class="atat-image">
	                <?php the_post_thumbnail('large');?>
	            </div>
	            <?php endif;?>
	    </div>
        <div class="atat-footer">
            <?php if(!empty($cptpress_portfolio_cat)): ?>
            <span class="atat-cat"><strong>Category:</strong>
                <?php
                    foreach ($cptpress_portfolio_cat as $key => $value) {
                        echo $value->name;
                        echo ", ";
                    }
                    ?>
            </span>
            <?php endif; ?>
            <h2 class="atat-title"><?php the_title();?></h2>
            <?php if (!empty(get_the_content())): ?>
            <?php the_content();?>
            <?php endif;?>
        </div>
</article>

<?php endwhile;?>
<?php get_footer();?>
