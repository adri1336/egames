<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>EGames</title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
		<?php wp_head(); ?>
	</head>

	<body>
		<script type="application/javascript">
			var front_page = false;
		</script>

		<header id="navbar" class="fixed-top fixed">
			<div class="container">
				<div class="row">
					<div class="col d-flex align-self-center p-0">
						<a class="nav-link" href="<?php echo get_home_url(); ?>" <?php if(is_front_page()) echo "style='border-bottom: 1px solid rgb(26, 217, 219);'"; ?>>Inicio</a>
						<a class="nav-link" href="<?php echo get_permalink(get_page_by_title("noticias")); ?>" <?php if(get_query_var("pagename") == "noticias") echo "style='border-bottom: 1px solid rgb(26, 217, 219);'"; ?>>Noticias</a>
						<a class="nav-link" href="<?php echo get_page_link(get_page_by_title("juegos")->ID); ?>" <?php if(get_query_var("pagename") == "juegos") echo "style='border-bottom: 1px solid rgb(26, 217, 219);'"; ?>>Juegos</a>
						<?php
						if(is_user_logged_in()) :
							$user = wp_get_current_user();
							?>
							<a class="nav-link" href="<?php echo get_author_posts_url($user->ID); ?>" <?php if($_SERVER['REQUEST_URI'] == "/wordpress/author/" . $user->nickname . "/") echo "style='border-bottom: 1px solid rgb(26, 217, 219);'"; ?>><?php echo $user->display_name; ?></a>
							<?php
						else :
							?>
							<a class="nav-link" href="<?php echo wp_login_url(); ?>">Iniciar sesión</a>
							<?php
						endif;
						?>
					</div>
					<div class="col-2 align-self-center text-center p-0">
						<a href="<?php echo get_home_url(); ?>">
							<img id="navbar-img" class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/img/logo2.png">
						</a>
					</div>
					<div class="col align-self-center p-0">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</header>