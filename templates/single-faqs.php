<?php get_header();?>

<?php
// Start the loop.
while (have_posts()):
    the_post();
    ?>

<article id="atat-<?php echo get_the_ID(); ?>" class="atat-single">
    <div class="atat-footer">
        <h2 class="atat-title"><?php the_title();?></h2>
        <?php if (!empty(get_the_content())): ?>
        <?php the_content();?>
        <?php endif;?>
    </div>
</article>

<?php endwhile;?>
<?php get_footer();?>
