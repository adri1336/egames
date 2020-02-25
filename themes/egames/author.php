<?php
    get_header();
    $user_meta = get_userdata($author);
?>

<section class="section-light first-section">
    <div class="container">
        <div class="row">
            <div class="col author-box">
                <div class="row">
                    <div class="col-4 author-img">
                        <?php
                        if(get_the_author_meta('userpic', $author) != "") : echo "<img src='" . get_the_author_meta('userpic', $author) . "'/>";
                        else : echo get_avatar($author);
                        endif;
                        ?>
                    </div>
                    <div class="col">
                        <h2 class="font-weight-bold">
                            <?php echo get_the_author_meta("display_name", $author); ?>
                            <h6><?php echo __('Registrado el', 'egames') . " " . get_the_author_meta("user_registered", $author); ?></h6>
                            <?php
                            $roles = $user_meta->roles;
                            foreach($roles as $role) :
                                echo "<span class='badge " . getBadgeClassByRole($role) . " p-2'>" . translate_user_role( $GLOBALS['wp_roles']->role_names[ $role ] ) . "</span> ";
                            endforeach;
                            ?>
                        </h2>
                        <hr>
                        <p>
                            <?php echo get_the_author_meta("user_description", $author); ?>
                        </p>
                    </div>
                </div>
                <?php if(get_current_user_id() == $author) : ?>
                    <div class="row top-separator">
                        <div class="col">
                            <a href="<?php echo admin_url(); ?>"><button type="button" class="btn btn-dark"><?php _e('Admin area', 'egames'); ?></button></a> <a href="<?php echo wp_logout_url(home_url()); ?>"><button type="button" class="btn btn-danger"><?php _e('Cerrar sesión', 'egames'); ?></button></a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row top-separator">
                    <div class="col">
                        <h2 class="font-weight-bold"><?php _e('Redes sociales', 'egames'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 align-self-center">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/social/psn.png"/>
                    </div>
                    <div class="col w-100">
                        <h6 class="font-weight-bold">PlayStation Network</h6>
                        <?php
                            if(get_the_author_meta("psn", $author) == "") : echo "<small>" . __('No tiene', 'egames') . "</small>";
                            else : echo "<small><i>" . get_the_author_meta("psn", $author) . "</i></small>";
                            endif;
                        ?>
                    </div>

                    <div class="col-1 align-self-center">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/social/xlive.png"/>
                    </div>
                    <div class="col w-100">
                        <h6 class="font-weight-bold">Xbox Live</h6>
                        <?php
                            if(get_the_author_meta("xlive", $author) == "") : echo "<small>" . __('No tiene', 'egames') . "</small>";
                            else : echo "<small><i>" . get_the_author_meta("xlive", $author) . "</i></small>";
                            endif;
                        ?>
                    </div>
                </div>

                <div class="row top-separator">
                    <div class="col-1 align-self-center">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/social/nswitch.png"/>
                    </div>
                    <div class="col w-100">
                        <h6 class="font-weight-bold">Nintendo Network</h6>
                        <?php
                            if(get_the_author_meta("nswitch", $author) == "") : echo "<small>" . __('No tiene', 'egames') . "</small>";
                            else : echo "<small><i>" . get_the_author_meta("nswitch", $author) . "</i></small>";
                            endif;
                        ?>
                    </div>

                    <div class="col-1 align-self-center">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/social/steam.png"/>
                    </div>
                    <div class="col w-100">
                        <h6 class="font-weight-bold">Steam</h6>
                        <?php
                            if(get_the_author_meta("steam", $author) == "") : echo "<small>" . __('No tiene', 'egames') . "</small>";
                            else : echo "<small><i>" . get_the_author_meta("steam", $author) . "</i></small>";
                            endif;
                        ?>
                    </div>
                </div>
                
                <div class="row top-separator">
                    <div class="col">
                        <h2 class="font-weight-bold"><?php _e('Últimos posts', 'egames'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <ul>                            
                            <?php
                            //wp_get_arhives();
                            $args = array(
                                "posts_per_page" => 10,
                                "orderby" => "date",
                                "order" => "DESC",
                                "author" => $author
                            );
                            $custom_query = new WP_Query($args);
                            if($custom_query->have_posts()) :
                                while($custom_query->have_posts()) :
                                    $custom_query->the_post(); ?>
                                        <li><a href="<?php echo get_post_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php
	get_footer();
?>