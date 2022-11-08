<?php get_header();?>



		<?php if (have_posts()): ?>
<div class="atat-page-main">
			<div class="atat-page-header">
				<?php
the_archive_title('<h1 class="page-title">', '</h1>');
?>
			</div><!-- .page-header -->
<div class="ata-cards" id="ata-main-sec">
            <?php
// Start the loop.
while (have_posts()):
    the_post();
    $cptpress_portfolio_cat = get_the_terms($post->ID, 'portfolio-category');
    $cptpress_cs_cat = get_the_terms($post->ID, 'case-study-category');
    $cptpress_cl_cat = get_the_terms($post->ID, 'client-category');
    $cptpress_profession = get_the_terms($post->ID, 'profession');

    ?>

				<article id="atat-<?php echo get_the_ID(); ?>" class="atat-article atat-archive">
						<div class="atat-header">
				            <?php if (has_post_thumbnail()): ?>
				            <div class="atat-image">
	<?php if ($_SERVER['REQUEST_URI'] === '/portfolio/'): ?>
	<span class="atat-cat">
	<?php
    if (!empty($cptpress_portfolio_cat)) {
        foreach ($cptpress_portfolio_cat as $key => $value) {

            $cptpress_portfolio_link = get_term_link($value->slug, 'portfolio-category');
            echo "<a href='$cptpress_portfolio_link'>";
            echo $value->name;
            echo ", ";
            echo "</a>";
        }

    }

    ?>
	</span>
	<?php endif;?>

<?php if ($_SERVER['REQUEST_URI'] === '/team/'): ?>
<span class="atat-cat">
<?php
if (!empty($cptpress_profession)) {
    foreach ($cptpress_profession as $key => $value) {

        $cptpress_profession_link = get_term_link($value->slug, 'profession');
        echo "<a href='$cptpress_profession_link'>";
        echo $value->name;
        echo ", ";
        echo "</a>";

    }

}

?>
</span>
<?php endif;?>

<?php if ($_SERVER['REQUEST_URI'] === '/case-studies/'): ?>
<span class="atat-cat">
<?php
if (!empty($cptpress_cs_cat)) {
    foreach ($cptpress_cs_cat as $key => $value) {

        $cptpress_cs_cat_link = get_term_link($value->slug, 'case-study-category');
        echo "<a href='$cptpress_cs_cat_link'>";
        echo $value->name;
        echo ", ";
        echo "</a>";

    }

}

?>
</span>
<?php endif;?>

                <?php if ($_SERVER['REQUEST_URI'] === '/client/'): ?>
<span class="atat-cat">
<?php
if (!empty($cptpress_cl_cat)) {
    foreach ($cptpress_cl_cat as $key => $value) {

        $cptpress_cl_cat_link = get_term_link($value->slug, 'client-category');
        echo "<a href='$cptpress_cl_cat_link'>";
        echo $value->name;
        echo ", ";
        echo "</a>";

    }

}

?>
</span>
<?php endif;?>

	                <a href="<?php the_permalink();?>" class="atat-img-link">
	                    <img src="<?php the_post_thumbnail_url('large');?>" alt="<?php the_title();?>">
	                </a>
	            </div>
	            <?php endif;?>
            <?php the_title(sprintf('<h2 class="blog-entry-title"><a href="%s" rel="blogmark">', esc_url(get_permalink())), '</a></h2>');?>
	    </div>

        <?php if (has_excerpt()): ?>
        <div class="atat-content-footer">
                <div class="atat-excerpt" >
                    <?php the_excerpt();?>
                </div>

            </div>
            <?php endif;?>
</article> <!-- #post-<?php the_ID();?> -->

<?php

endwhile;
?>

</div>

<?php
// Previous/next page navigation.
the_posts_pagination(
    array(
        'prev_text' => __('Previous page', 'cptpress'),
        'next_text' => __('Next page', 'cptpress'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'cptpress') . ' </span>',
    )
);

// If no content, include the "No posts found" template.
else:
    echo "Nothing Found!";

endif;?>


</div>
<?php get_footer();?>
