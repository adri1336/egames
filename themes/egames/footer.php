		<!-- Footer -->
		<footer>
			<div class="container h-100">			
				<div class="row align-items-center h-100">
					<div class="col">
						<h5><?php _e('Tema creado por Adrián Ortega Rodríguez', 'egames'); ?></h5>
						<h6><?php _e('Funciona con', 'egames'); ?> <a href="https://es.wordpress.com/">WordPress</a></h6>
					</div>
					<div class="col text-right">
						<a href="<?php echo get_page_link(get_page_by_title("archives")->ID); ?>"><?php _e('Archivos', 'egames'); ?></a><br>
						<?php
							$args = array(
								"id" => "myLocale",
								"languages" => get_available_languages(),
								"show_available_translations" => false
							);
							wp_dropdown_languages($args);
						?>
					</div>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>