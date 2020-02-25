<?php
	get_header();
	$title_archives = "";
	if(have_posts()) :
		if(is_category()) : $title_archives = __('Categoría', 'egames') . ": <span class='searchwords2'>" . single_cat_title('', false) . "</span>";
		elseif(is_tag()) : $title_archives = __('Etiqueta', 'egames') . ": <span class='searchwords2'>" . single_tag_title('', false) . "</span>";
		elseif(is_author()) :
			the_post();
			$title_archives = __('Autor', 'egames') . ": <span class='vcard'><a class'url fn n searchwords' href='"
								. get_author_posts_url( get_the_author_meta("ID") )
								. "' title='" . esc_attr( get_the_author() ) . "' rel='me'>"
								. get_the_author() . "</a></span>";

			rewind_posts();
		elseif(is_day()) : $title_archives = __('Fecha', 'egames') . ": <span class='searchwords'>" . get_the_date() . "</span>";
		elseif(is_month()) : $title_archives = __('Fecha', 'egames') . ": <span class='searchwords'>" . get_the_date('F Y') . "</span>";
		elseif(is_year()) : $title_archives = __('Fecha', 'egames') . ": <span class='searchwords'>" . get_the_date('Y') . "</span>";
		else : $title_archives = __('Archivo', 'egames');
		endif;
	endif;
?>

<section class="section-light first-section">
	<div class="container search-box">
		<div class="row">
			<div class="col">
				<div class="post-preview">
					<h2 class="font-weight-bold"><?php echo $title_archives; $counter = 1; ?></h2>
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
						$args = array(
							"mid_size" => 2,
							"screen_reader_text" => " "
						);
						the_posts_pagination($args);
						echo "</div></div>";
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	get_footer();
?>