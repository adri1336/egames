<?php
	get_header();
?>

<section class="section-light first-section">

    <?php
		$posts_per_page = get_option("posts_per_page");
        $total_posts = wp_count_posts('egames')->publish;

		$paged = get_query_var("paged") > 1 ? get_query_var("paged") : 1;
		$total_pages = ceil($total_posts / $posts_per_page);
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="container">
                        <div class="row">
                        <?php
                            $currentLetter;
                            $args = array(
                                "posts_per_page" => $posts_per_page,
                                "paged" => "$paged",
                                "post_type" => "egames",
                                "orderby" => "title",
                                "order" => "ASC"                                
                            ); 
                            $custom_query = new WP_Query($args);
                            if($custom_query->have_posts()) :
                                while($custom_query->have_posts()) :
                                    $custom_query->the_post();
                                    
                                    $game_title = get_the_title();
                                    $letter = preg_replace("/[^A-Z]/", "#", strtoupper($game_title[0]));
                                    if(is_null($currentLetter) || $currentLetter != $letter) :
                                        $currentLetter = $letter;
                                        echo "<div class='w-100'><div class='col'><h1 class='font-weight-bold'>$currentLetter</h1></div></div>";
                                    endif; ?>
                                    <div class="col-3 game-box">
                                        <div class="game-img">
                                            <a href="<?php echo get_post_permalink(); ?>">
                                                <img src="<?php echo get_post_meta(get_the_ID(), "box_image_url", true); ?>">
                                                <h6 class="game-title">
                                                    <?php echo $game_title; ?>
                                                </h6>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                        ?>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <?php
                                    if($paged > 1) : ?>
                                        <a href="<?php echo get_permalink(get_page_by_title('juegos')) . 'page/' . ($paged - 1) . '/' ?>">
                                    <?php endif; ?>
                                        <button type="button" class="btn btn-warning w-100 <?php if($paged <= 1) echo "disabled"; ?>"><?php _e('ANTERIOR', 'egames'); ?></button>
                                    <?php
                                    if($paged > 1) : ?>
                                        </a>
                                    <?php endif;
                                ?>
                            </div>
                            <div class="col align-self-center text-center">
                                <?php 
                                    if($total_pages == 0) :
                                        echo "<span class='page-numbers' style='border-bottom: 1px solid rgb(26, 217, 219);'>1</span>";
                                    else :
                                        for($i = 1; $i <= $total_pages; $i ++) :
                                            if($paged == $i) : echo "<span class='page-numbers' style='border-bottom: 1px solid rgb(26, 217, 219);'>$i</span> ";
                                            else : echo "<a class='page-numbers' href='" . get_permalink(get_page_by_title("juegos")) . "page/$i/'>$i</a> ";
                                            endif;
                                        endfor;
                                    endif;
                                ?>
                            </div>
                            <div class="col-3">
                                <?php
                                    if($total_pages > 1 && $paged < $total_pages) : ?>
                                        <a href="<?php echo get_permalink(get_page_by_title('juegos')) . 'page/' . ($paged + 1) . '/' ?>">
                                    <?php endif; ?>
                                        <button type="button" class="btn btn-warning w-100 <?php if($paged >= $total_pages) echo "disabled"; ?>"><?php _e('SIGUIENTE', 'egames'); ?></button>
                                    <?php
                                    if($total_pages > 1 && $paged < $total_pages) : ?>
                                        </a>
                                    <?php endif;
                                ?>
                            </div>
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