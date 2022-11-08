<?php

get_header();?>

<?php
// Start the loop.
while (have_posts()):
    the_post();
    $cptpress_profession = get_the_terms($post->ID, 'profession');

    $cptpress_email = get_post_meta($post->ID, '_team_email', true);
    $cptpress_website = get_post_meta($post->ID, '_team_website', true);
    $cptpress_fb_link = get_post_meta($post->ID, '_team_facebook', true);
    $cptpress_twit_link = get_post_meta($post->ID, '_team_twitter', true);
    $cptpress_insta_link = get_post_meta($post->ID, '_team_instagram', true);
    $cptpress_linked_link = get_post_meta($post->ID, '_team_linkedin', true);
    $cptpress_git_link = get_post_meta($post->ID, '_team_github', true);

    $meta_icons = array(
        'atat_person_website_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/worldwide.png" alt="worldwide">',
        'atat_person_email_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/email.png" alt="email">',
        'atat_person_fb_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/facebook.png" alt="facebook">',
        'atat_person_inst_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/instagram.png" alt="instagram">',
        'atat_person_twitter_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/twitter.png" alt="twitter">',
        'atat_person_in_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/linkedin.png" alt="linkedin">',
        'atat_person_git_link' => '<img src="' . plugin_dir_url(__DIR__) . '/vendor/icons/github.png" alt="github">',
    );

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
        <?php if (!empty($cptpress_profession)): ?>
                        <span class="atat-cat"><strong>Professions:</strong>
                <?php
foreach ($cptpress_profession as $key => $value) {
    echo $value->name;
    echo ", ";
}
?>
            </span>
<?php endif;?>

<?php if (!empty($cptpress_number) || 
    !empty($cptpress_email) || 
    !empty($cptpress_website) || 
    !empty($cptpress_fb_link) || 
    !empty($cptpress_twit_link) || 
    !empty($cptpress_insta_link) || 
    !empty($cptpress_git_link)): ?>

<ul class="atat-socials">

    <?php if(!empty($cptpress_email)): ?>
       <?php echo "<li> <a href=mailto:" . $cptpress_email . ">" . $meta_icons['atat_person_email_link']. "</a></li>" ?>
    <?php endif; ?>

    <?php if (!empty($cptpress_website)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_website . ">" . $meta_icons['atat_person_website_link'] . "</a></li>" ?>
    <?php endif;?>

    <?php if (!empty($cptpress_fb_link)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_fb_link . ">" . $meta_icons['atat_person_fb_link'] . "</a></li>" ?>
    <?php endif;?>

    <?php if (!empty($cptpress_twit_link)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_twit_link . ">" . $meta_icons['atat_person_twitter_link'] . "</a></li>" ?>
    <?php endif;?>

    <?php if (!empty($cptpress_insta_link)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_insta_link . ">" . $meta_icons['atat_person_inst_link'] . "</a></li>" ?>
    <?php endif;?>

    <?php if (!empty($cptpress_linked_link)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_linked_link . ">" . $meta_icons['atat_person_in_link'] . "</a></li>" ?>
    <?php endif;?>

    <?php if (!empty($cptpress_git_link)): ?>
       <?php echo "<li> <a target='_blank' href=" . $cptpress_git_link . ">" . $meta_icons['atat_person_git_link'] . "</a></li>" ?>
    <?php endif;?>

</ul>
    <?php endif; ?>

        <h2 class="atat-title"><?php the_title();?></h2>
            <?php if (!empty(get_the_content())): ?>
            <?php the_content();?>
            <?php endif;?>
        </div>
</article>

<?php endwhile;?>
<?php get_footer();?>
