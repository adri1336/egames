
		<!-- Footer -->
		<footer>
			<section class="section-footer">
				<div class="container">			
					<div class="row h-100">
						<div class="col">
							<h5>Tema creado por Adrián Ortega Rodríguez</h5>
							<h6>Funciona con <a href="https://es.wordpress.com/">WordPress</a></h6>
						</div>
						<div class="col text-right">
							<a href="<?php echo get_page_link(get_page_by_title("archives")->ID); ?>">Archivos</a>
						</div>
					</div>
				</div>
			</section>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>