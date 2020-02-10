<div class="sidebar hidden-sm hidden-xs">
    
    <div class="widget last-entries section-title">
        <div class="widget-title">
            <h4 class="font-weight-bold">Noticias destacadas</h4>
        </div>
        <div class="container widget-content">
            <?php
                $args = array(
                    "posts_per_page" => 5,
                    "meta_key" => "post_visits_counter",
                    "orderby" => "meta_value_num",
                    "order" => "DESC",
                    "update_post_term_cache" => false,
                    "update_post_meta_cache" => false, 
                    "nopaging" => false
                ); 
                $custom_query = new WP_Query($args);
                if($custom_query->have_posts()) :
                    while($custom_query->have_posts()) :
                        $custom_query->the_post(); ?>
                            <div class="row top-separator">
                                <div class="col-auto p-0">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="last-review-image">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <h6 class="font-weight-bold p-1"><?php echo wp_trim_words(get_the_title(), 10, "..."); ?></h6>
                                    </a>
                                </div>
                            </div>
                        <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>

    <div class="widget categories section-title">
        <div class="widget-title">
            <h4 class="font-weight-bold">Categorías</h4>
        </div>
        <div class="container widget-content">
            <div class="row">
                <?php
                    $categories = get_categories();
                    foreach($categories as $cat)
                    {
                        echo "<a href='" . get_category_link(get_cat_ID($cat->name)) . "' style='padding-right: 5px; padding-bottom: 5px;'><span class='badge " . getBadgeClassByCategory($cat->name) . " p-2'>$cat->name</span></a> ";
                    }
                ?>
            </div>
        </div>
    </div> 

    <div class="widget last-entries section-title">
        <div class="widget-title">
            <h4 class="font-weight-bold">Últimos videojuegos</h4>
        </div>
        <div class="container widget-content">
            <?php
                $args = array(
                    "posts_per_page" => 5,
                    "post_type" => "egames",
                    "orderby" => "date",
                    "order" => "DESC",
                    "update_post_term_cache" => false,
                    "update_post_meta_cache" => false, 
                    "nopaging" => false
                ); 
                $custom_query = new WP_Query($args);
                if($custom_query->have_posts()) :
                    while($custom_query->have_posts()) :
                        $custom_query->the_post(); ?>
                            <div class="row sidebar-last-review-box last-review-box">
                                <div class="col-auto">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="last-review-image">
                                    </a>
                                </div>
                                <div class="col-8 align-self-center">
                                    <h6 class="font-weight-bold">
                                        <a href="<?php echo get_post_permalink(); ?>">
                                            <?php
                                                echo get_the_title();
                                            ?>
                                        </a>
                                    </h6>
                                    <div>
                                        <?php
                                            $platforms = get_post_meta(get_the_ID(), "platforms", true);
                                            foreach($platforms as $platform) :
                                                echo "<a href='" . get_term_link(get_cat_ID("$platform")) . "'>$platform</a> ";
                                            endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>

    <div class="widget last-entries section-title">
        <div class="widget-title">
            <h4 class="font-weight-bold">Últimas noticias</h4>
        </div>
        <div class="container widget-content">
            <?php
                $args = array(
                    "posts_per_page" => 5,
                    "orderby" => "date",
                    "order" => "DESC",
                    "update_post_term_cache" => false,
                    "update_post_meta_cache" => false, 
                    "nopaging" => false
                ); 
                $custom_query = new WP_Query($args);
                if($custom_query->have_posts()) :
                    while($custom_query->have_posts()) :
                        $custom_query->the_post(); ?>
                            <div class="row top-separator">
                                <div class="col-auto p-0">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="last-review-image">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo get_post_permalink(); ?>">
                                        <h6 class="font-weight-bold p-1"><?php echo wp_trim_words(get_the_title(), 10, "..."); ?></h6>
                                    </a>
                                </div>
                            </div>
                        <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>
    
</div>