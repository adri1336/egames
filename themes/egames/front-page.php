<?php
	get_header();
?>

<script type="application/javascript">
	front_page = true;
</script>

<!-- Front Page Header -->
<div id="front-page-header" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/img/bg-img/<?php echo rand(1, 3); ?>.jpg)">
	<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-8 border-box">
				<h1 class="font-weight-bold"><?php _e('EGames', 'egames'); ?></h1>
				<span class="subheading"><?php _e('EGames es una portal y tienda sobre videojuegos, podrás informarte de las últimas noticias y comprar los mejores videojuegos.', 'egames'); ?></span>
			</div>
		</div>
	</div>
</div>

<!-- Sección: últimas noticias y top 10 ventas -->
<section class="section-light">
	<div class="container">
		<div class="row">
			<div class="col-8">
				<div class="row section-title">
					<div class="col p-0">
						<h1><?php _e('Noticias recientes', 'egames'); ?></h1>
						<h6><a href="<?php echo get_permalink(get_option("page_for_posts")); ?>"><?php _e('Ver todas', 'egames'); ?></a></h6>
					</div>
				</div>
				<div class="row recent-news-top-col">
					<div class="container">
						<?php
							$args = array(
								"posts_per_page" => 3,
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
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row section-title">
					<div class="col p-0">
						<h1><?php _e('Top ventas', 'egames'); ?></h1>
						<h6><a href="<?php echo get_page_link(get_page_by_title("juegos")->ID); ?>"><?php _e('Ver todos', 'egames'); ?></a></h6>
					</div>
				</div>
				<div class="row recent-news-top-col">
					<div class="row">
						<div class="container">
							<?php
								$args = array(
									"posts_per_page" => 6,
									"post_type" => "egames",
									"meta_key" => "sales",
									"orderby" => "meta_value_num",
									"order" => "DESC",
									"update_post_term_cache" => false,
									"update_post_meta_cache" => false, 
									"nopaging" => false,
									"meta_query" => array(
										array(
											"key" => "for_sale",
											"value" => "1",
											"compare" => "=",
											"type" => "NUMERIC"
										)
									)
								); 
								$custom_query = new WP_Query($args);
								if($custom_query->have_posts()) :
									while($custom_query->have_posts()) :
										$custom_query->the_post(); ?>
										<div class="row section-title">
											<div class="col-sm-5">
												<div class="top10-img-box">
													<a href="<?php echo get_post_permalink(); ?>">
														<img src="<?php echo get_post_meta(get_the_ID(), "box_image_url", true); ?>" class="top10-img">
													</a>
												</div>
											</div>
											<div class="col top10-box">
												<h5 class="font-weight-bold">
													<a href="<?php echo get_post_permalink(); ?>">
														<?php echo get_the_title(); ?>
													</a>
												</h5>
												<span class="text-upper-title">
													<?php
														$platforms = get_post_meta(get_the_ID(), "platforms", true);
														foreach($platforms as $platform) :
															echo "<a href='" . get_term_link(get_cat_ID("$platform")) . "'>$platform </a> ";
														endforeach;
													?>
												</span>
												<span class="text-upper-title top10-price"><?php echo get_post_meta(get_the_ID(), "price", true); ?>€</span>
												<hr>
												<a href="<?php echo get_post_permalink(); ?>"><button type="button" class="btn btn-warning w-100 top10-button"><?php _e('Ver análisis', 'egames'); ?></button></a>
												<a href="<?php echo get_post_permalink(); ?>"><button type="button" class="btn btn-success w-100 top10-button"><?php _e('Comprar', 'egames'); ?></button></a>
											</div>
										</div>
										<?php
									endwhile;
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Sección: últimos análisis -->
<section class="section-dark">
	<div class="container">
		<div class="row section-title">
			<div class="col p-0">
				<h1><?php _e('Últimos videojuegos', 'egames'); ?></h1>
				<h6><a href="<?php echo get_page_link(get_page_by_title("juegos")->ID); ?>"><?php _e('Ver todos', 'egames'); ?></a></h6>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<div class="row h-100">
					<div class="col-5 last-reviews-col">
						<div class="container last-reviews-box">
							<?php
								$count = 1;
								$args = array(
									"posts_per_page" => 10,
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
										<div
											class="row last-review-box" 
											onmouseenter="onMouseEnterReviewBox(this)"
											onmouseleave="onMouseLeaveReviewBox(this, <?php echo $count; ?>)"
											onclick="onMouseClickReviewBox(this, <?php echo $count; ?>, '<?php echo get_the_post_thumbnail_url(); ?>', '<?php echo get_post_meta(get_the_ID(), 'youtube_id', true); ?>')"
										>
											<div class="col">
												<a href="<?php echo get_post_permalink(); ?>">
													<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="last-review-image">
												</a>
											</div>
											<div class="col-6 align-self-center">
												<h5 class="font-weight-bold">
													<a href="<?php echo get_post_permalink(); ?>">
														<?php
															echo get_the_title();
														?>
													</a>
												</h5>
												<h6>
													<?php
														$platforms = get_post_meta(get_the_ID(), "platforms", true);
														foreach($platforms as $platform) :
															echo "<a href='" . get_term_link(get_cat_ID("$platform")) . "'>$platform</a> ";
														endforeach;
													?>
												</h6>
											</div>
											<div class="col text-center">
												<span class="rating">
													<?php
														echo get_post_meta(get_the_ID(), "score", true) . "/10";
													?>
												</span>
											</div>
										</div>
										<?php
										$count ++;
									endwhile;
								endif;
							?>
						</div>
					</div>
					<div id="last-review-video-box" class="col-7">
						<iframe id="last-review-video-frame" src="" class="last-review-video" frameborder="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	get_footer();
?>