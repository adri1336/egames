<?php
    get_header();
    $authors = get_users();
?>

<section class="section-light first-section">
	<div class="container">
        <div class="card-columns">
            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Noticias', 'egames'); ?></h4>
                    <ul>
                        <?php
                            $args=array(
                                'type' => 'postbypost',
                                'limit' => 8,
                            );
                            wp_get_archives($args);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Autores', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_list_authors('optioncount=1&hide_empty=0');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Videojuegos por autor', 'egames'); ?></h4>
                    <ul>
                        <?php
                            foreach($authors as $author) :
                                echo "<li>" . "<a href=" . get_author_posts_url($author->ID) . ">$author->display_name (" . count_user_posts($author->ID, "egames") . ")</a></li>";
                            endforeach;
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Categorías', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_list_categories('title_li');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Páginas', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_list_pages('title_li');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Posts diarios', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_get_archives(["type" => "daily"]);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Posts semanales', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_get_archives(["type" => "weekly"]);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Posts mensuales', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_get_archives(["type" => "monthly"]);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Posts anuales', 'egames'); ?></h4>
                    <ul>
                        <?php
                            wp_get_archives(["type" => "yearly"]);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title"><?php _e('Videojuegos', 'egames'); ?></h4>
                    <ul>
                        <?php
                            $args=array(
                                'type' => 'postbypost',
                                'post_type' => 'egames',
                                'limit' => 5,
                            );
                            wp_get_archives($args);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
	</div>
</section>

<?php
	get_footer();
?>