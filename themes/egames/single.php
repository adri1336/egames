<?php
    get_header();
?>
<section class="section-light first-section">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <?php
                the_post();
                $postID = get_the_ID();
                add_post_visits_counter($postID); ?>
                
                <!-- Title -->
                <h1 class="font-weight-bold"><?php the_title(); ?></h1>
                <h4><?php the_excerpt(); ?></h4>

                <!-- Author -->
                <p class="lead">
                    <span>
                        <?php _e('Escrito por', 'egames'); ?> 
                        <a href="<?php echo get_author_posts_url(get_the_author_ID(), get_the_author()); ?>"><?php the_author(); ?></a>
                        <?php _e('el', 'egames'); ?> <?php echo get_the_date("d F Y") . " " . get_the_time(); ?>
                    </span>
                    <span style="float: right;"><?php echo get_post_visits_counter($postID) . " " . __('visualizaciones', 'egames'); ?></span>
                </p>

                <hr>

                <!-- Preview Image the_post_thumbnail -->
                <img class="img-fluid rounded w-100" src="<?php echo get_the_post_thumbnail_url() ?>">

                <!-- Post Content -->
                <p><?php the_content(); ?></p>

                <!-- Tags -->
                <hr>
                <p>
                    <span>
                        <?php
                            $categories = wp_get_post_categories($postID);
                            foreach($categories as $category) :
                                $cat = get_category($category);
                                echo "<a href='" . get_category_link(get_cat_ID($cat->name)) . "'><span class='badge " . getBadgeClassByCategory($cat->name) . " p-2'>$cat->name</span></a> ";
                            endforeach;
                        ?>
                    </span>
                    <span style="float: right;">
                        <a href="<?php echo get_permalink(get_page_by_title("noticias")); ?>" class="font-weight-bold">← <?php _e('Volver a noticias', 'egames'); ?></a>
                    </span>
                </p>
                    
                <!-- Posts relacionados -->
                <div class="container">
                    <div class="row">
                        <?php
                        $args = array(
                            "posts_per_page" => 3,
                            "orderby" => "date",
                            "order" => "DESC",
                            "post__not_in" => array($postID),
                            "category__in" => $categories
                        ); 
                        $custom_query = new WP_Query($args);
                        if($custom_query->have_posts()) :
                            while($custom_query->have_posts()) :
                                $custom_query->the_post(); ?>
                                <div class="col p-0 related-posts-box">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <div class="related-posts-img-box">
                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" class="related-posts-img">
                                        </div>
                                        <div class="related-posts-title">
                                            <h6>
                                                <?php echo wp_trim_words(get_the_title(), 5, "..."); ?>
                                            </h6>
                                        </div>
                                    </a>
                                </div><?php
                            endwhile;
                        endif;
                    ?>              
                    </div>
                </div>
                <hr>
                <?php
                    $args = array(
                        "posts_per_page" => 1,
                        "post__in" => array($postID),
                    ); 
                    $custom_query = new WP_Query($args);
                    if($custom_query->have_posts()) :
                        $custom_query->the_post();
                        comments_template();
                    endif;
                ?>

                <!-- Comment List -->
                <?php/* wp_list_comments("type=comment&callback=format_comment"); */?>
            </div>
            <div class="col-4" style="margin-top: 10px;">
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