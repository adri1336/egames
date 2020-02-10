<?php
	get_header();
?>

<section class="section-light first-section">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="container">
                        <div class="row">
                    <?php
                        $counter = 0;
                        $args = array(
                            "posts_per_page" => -1,
                            "post_type" => "egames",
                            "orderby" => "title",
                            "order" => "ASC"
                        ); 
                        $custom_query = new WP_Query($args);
                        if($custom_query->have_posts()) :
                            while($custom_query->have_posts()) :
                                $custom_query->the_post(); ?>
                                <div class="col p-0 game-box">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <img src="<?php echo get_post_meta(get_the_ID(), "box_image_url", true); ?>">
                                        <h6 class="game-title">
                                            <?php echo get_the_title(); ?>
                                        </h6>
                                    </a>
                                </div>
                                <?php
                                $counter ++;
                                if($counter >= 4) :
                                    echo "<div class='w-100 top-separator'></div>";
                                    $counter = 0;
                                endif;
                            endwhile;
                        endif;
                    ?>
                    </div>
                    </div>
				</div>
            </div>
            <div class="col-4">
                <?php
                    get_sidebar();
				?>
            </div>
        </div>
    </div>
</section>

<?php
	get_footer();
?>