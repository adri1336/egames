<?php
    get_header();
?>

<section class="section-light first-section">
    <div class="container search-box">
        <div class="row">
            <div class="col">
                <?php if($wp_the_query->post_count <= 0) : ?>
                    <h2><?php _e('No se han encontrado posts', 'egames'); ?></h2>
                    <h1 class="display-1">:/</h1>
                <?php else : $counter = 1; ?>
                    <h2 class="font-weight-bold"><?php _e('Búsqueda', 'egames'); ?></h2>
                    <table class="top-separator">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php _e('Fecha', 'egames'); ?></th>
                                <th><?php _e('Autor', 'egames'); ?></th>
                                <th><?php _e('Título', 'egames'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while( have_posts() ) : the_post(); ?>
                                <tr class="p-1">
                                    <td scope="row" class="font-weight-bold"><?php echo $counter++; ?></td>
                                    <td><?php the_time('M j, Y'); ?></td>
                                    <td><a href="<?php echo get_author_posts_url(get_the_author_ID(), get_the_author()); ?>"><?php the_author(); ?></a></td>
                                    <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php
                    echo "<div class='row h-100 d-flex top-separator'><div class='col'>";
                    //SEARCH
                    $args = array(
                        "mid_size" => 2,
                        "screen_reader_text" => " "
                    );
                    the_posts_pagination($args);
                    echo "</div></div>";
                    endif;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
	get_footer();
?>