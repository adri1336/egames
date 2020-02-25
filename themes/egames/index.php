<?php
	get_header();
?>

<section class="section-light first-section">
	<!-- Post destacado -->
	<?php
		$posts_per_page = get_option("posts_per_page");
		$total_posts = $wp_query->found_posts;

		$paged = get_query_var("paged") > 1 ? get_query_var("paged") : 1;
		$total_pages = $wp_query->max_num_pages;
		
		if($paged == 1 && (($total_posts - 1) <= $posts_per_page)) :
			$total_pages --;
		endif;
	?>

	<?php if($paged <= 1) : ?>
		<div class="container">
			<div class="row">
				<div class="col p-0">
					<?php
						$args = array(
							"posts_per_page" => 1,
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
								<div class="featured-post-box">
									<div class="featured-post-img-box">
										<a href="<?php echo get_post_permalink(); ?>">
											<img src="<?php echo get_the_post_thumbnail_url() ?>" class="featured-post-img">
										</a>
									</div>
									<div class="featured-post-title">
										<a href="<?php echo get_post_permalink(); ?>">
											<h2>
												<?php echo get_the_title(); ?>
											</h2>
										</a>
									</div>
								</div>
							<?php
							if(!add_option("featured_post_id", get_the_id())) :
								update_option("featured_post_id", get_the_id());
							endif;
							endwhile;
						endif;
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row top-separator">
			<div class="col-8">
				<?php
					$args = array(
						"posts_per_page" => $posts_per_page,
						"paged" => "$paged",
						"orderby" => "date",
						"order" => "DESC",
						"update_post_term_cache" => false,
						"update_post_meta_cache" => false,
						"post__not_in" => array(get_option("featured_post_id"))
					); 
					$custom_query = new WP_Query($args);
					if($custom_query->have_posts()) :
						while($custom_query->have_posts()) :
							$custom_query->the_post(); ?>
							<div class="row section-title">
								<div class="recent-new-img-box">
									<a href="<?php echo get_post_permalink(); ?>">
										<img src="<?php echo get_the_post_thumbnail_url() ?>" class="recent-new-img">
									</a>
								</div>
								<div class="col recent-new-box">
									<h4 class="font-weight-bold recent-new-title">
										<a href="<?php echo get_post_permalink(); ?>">
											<?php
												echo get_the_title();
											?>
										</a>
									</h4>
									<span class="text-upper-title">
										<?php _e('Escrito por', 'egames'); ?> <a href="<?php echo get_author_posts_url(get_the_author_ID(), get_the_author()); ?>"><?php the_author(); ?></a>
									</span>
									<span class="recent-new-comments text-upper-title">											
										<?php echo get_comments_number() . " " . __('comentarios', 'egames'); ?>
									</span>
									<hr>
									<p class="text-justify">
										<?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?>
									</p>
								</div>
							</div>
							<?php
						endwhile;
					endif;
				?>				
				<div class="row">
					<div class="col-3 p-0">
						<?php
							if($paged > 1) : ?>
								<a href="<?php echo get_permalink(get_page_by_title('noticias')) . 'page/' . ($paged - 1) . '/' ?>">
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
									else : echo "<a class='page-numbers' href='" . get_permalink(get_page_by_title("noticias")) . "page/$i/'>$i</a> ";
									endif;
								endfor;
							endif;
						?>
					</div>
					<div class="col-3 p-0">
						<?php
							if($total_pages > 1 && $paged < $total_pages) : ?>
								<a href="<?php echo get_permalink(get_page_by_title('noticias')) . 'page/' . ($paged + 1) . '/' ?>">
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