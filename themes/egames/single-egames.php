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

                <!-- Author -->
                <div class="row">
                    <div class="col">
                        <p class="lead">
                            <?php _e('Escrito por', 'egames'); ?> 
                            <a href="<?php echo get_author_posts_url(get_the_author_ID(), get_the_author()); ?>"><?php the_author(); ?></a>
                            <?php _e('el', 'egames'); ?> <?php echo get_the_date("d F Y") . " " . get_the_time(); ?>
                        </p>
                    </div>
                    <div class="col-2 text-right">
                        <p class="lead"><?php echo get_post_meta($postID, "score", true) ?>/10</p>
                    </div>
                </div>
                <?php
                    $for_sale = get_post_meta(get_the_ID(), "for_sale", true);
                    if($for_sale) :
                        ?>
                        <div class="row">
                            <div class="col-4">
                                <img src="<?php echo get_post_meta(get_the_ID(), "box_image_url", true) ?>" class="w-100"/>
                            </div>
                            <div class="col-8 align-self-center">
                                <h2><?php _e('En venta', 'egames'); ?></h2>
                                <h5 style="color: rgb(83, 137, 224);"><?php echo get_post_meta(get_the_ID(), "price", true); ?>€</h5><br>
                                <?php
                                    $stock = get_post_meta(get_the_ID(), "stock", true);
                                ?>

                                <p>
                                    <?php echo __('Fecha de lanzamiento:', 'egames') . " " . get_post_meta($postID, "release_date", true) ?><br>
                                    <?php echo __('Desarrollador:', 'egames') . " " . get_post_meta($postID, "developer", true) ?><br>
                                    
                                    <?php
                                    echo __('Plataforma(s):', 'egames') . " ";
                                    $platforms = get_post_meta($postID, "platforms", true);
                                    foreach($platforms as $platform) :
                                        echo "$platform ";
                                    endforeach;
                                    ?><br>

                                    <?php
                                    echo __('Género(s):', 'egames') . " ";
                                    $genres = get_post_meta($postID, "genres", true);
                                    foreach($genres as $genre) :
                                        echo "$genre ";
                                    endforeach;
                                    ?><br>
                                </p>

                                <!--<h6>Uds. disponibles: <?php /*echo $stock;*/ ?></h6>-->
                                <h6><?php echo __('Uds. vendidas:', 'egames') . " " . get_post_meta(get_the_ID(), "sales", true); ?></h6>
                                <?php
                                    if($stock > 0) echo "<button type='button' class='btn btn-success w-50'>" . __('Comprar', 'egames') . "</button>";
                                    else echo "<button type='button' class='btn btn-danger w-50'>" . __('Sin stock', 'egames') . "</button>";
                                ?>
                            </div>
                        </div>
                        <?php
                    endif;
                ?>

                <hr>

                <!-- Preview Image the_post_thumbnail -->
                <img class="img-fluid rounded w-100" src="<?php echo get_the_post_thumbnail_url() ?>">

                <!-- Post Content -->
                <p><?php the_content(); ?></p>

                <?php if(get_post_meta($postID, "youtube_id", true) != "") : ?>
                <div class="row">
                    <div class="col">
                        <iframe src="https://www.youtube.com/embed/<?php echo get_post_meta($postID, "youtube_id", true) ?>" style="width: 100%; height: 500px;"></iframe>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tags -->
                <hr>
                <p>
                    <span style="float: right;">
                        <a href="<?php echo get_permalink(get_page_by_title("juegos")); ?>" class="font-weight-bold">← <?php _e('Volver a juegos', 'egames'); ?></a>
                    </span><br>
                </p>
                    
                <!-- Posts relacionados -->
                <div class="container">
                    <div class="row">
                        <?php
                        $args = array(
                            "posts_per_page" => 3,
                            "post_type" => "egames",
                            "orderby" => "date",
                            "order" => "DESC",
                            "post__not_in" => array($postID)
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