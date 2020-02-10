<?php
    get_header();
?>
<section class="section-light first-section">
    <div class="container search-box">
        <div class="row">
            <div class="col">
                <?php if($wp_the_query->post_count <= 0) : ?>
                    <h2>No se han encontrado posts</h2>
                    <h1 class="display-1">:/</h1>
                <?php else : $counter = 1; ?>
                    <h2 class="font-weight-bold">Búsqueda</h2>
                    <table class="top-separator">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Autor</th>
                                <th>Título</th>
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
	get_footer();
?>