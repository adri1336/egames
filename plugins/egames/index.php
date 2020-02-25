<?php
	/*
		Plugin Name: egames
		Version: 1.0.0
		Author: Adrián Ortega Rodríguez
    */

    function egames()
	{
		wp_register_script("egames", plugin_dir_url(_FILE_) . "java.js", array("jquery"), null, t);
		wp_enqueue_script("egames");

		wp_register_script("egames-style", plugin_dir_url(_FILE_) . "style.css");
		wp_enqueue_script("egames-style");
	}
	add_action("admin_init", "egames");
	add_action("wp_enqueue_scripts", "egames");
	
	function my_plugin_init()
	{
		load_plugin_textdomain("egames", false, dirname(plugin_basename(__FILE__))); 
	}
	add_action('init', 'my_plugin_init');

	function plugin_custom_post_type()
	{
		$supports = array(
			"title",
			"editor",
			"author",
			"comments",
			"category",
			"revisions",
			"thumbnail"
		);

		$labels = array(
			"name" => __("Juegos", "egames"),
			"singular_name" => __("Juego", "egames"),
			"menu_name" => __("Juegos", "egames"),
			"name_admin_bar" => __("Juegos", "egames"),
			"add_new" => __("Añadir juego", "egames"),
			"add_new_item" => __("Añadir juego", "egames"),
			"new_item" => __("Añadir juego", "egames"),
			"edit_item" => __("Editar juego", "egames"),
			"view_item" => __("Ver juego", "egames"),
			"all_items" => __("Todos los juegos", "egames"),
			"search_items" => __("Buscar juegos", "egames"),
			"not_found" => __("No se han encontrado juegos...", "egames")
		);

		$args = array(
			"supports" => $supports,
			"labels" => $labels,
			"public" => true,
			"query_var" => true,
			"rewrite" => array("slug" => "game"),
			"has_archive" => true,
			"hierarchical" => false,
			"show_in_menu" => true,
			"menu_position" => 5,
			/*"taxonomies" => array("category"),*/
			"menu_icon" => get_template_directory_uri() . "/assets/img/gamepad.svg"
		);
		register_post_type("egames", $args);
	}
	add_action("init", "plugin_custom_post_type");

	function create_game_info_metabox()
	{
		$screens = array("egames");
		foreach($screens as $screen)
		{
			add_meta_box(
				"info_metabox",
				"Información",
				"info_metabox_callback",
				$screen,
				"normal"
			);

			add_meta_box(
				"shop_metabox",
				"Tienda",
				"shop_metabox_callback",
				$screen,
				"normal"
			);
		}
	}
	add_action("add_meta_boxes", "create_game_info_metabox");

	function info_metabox_callback($post)
	{
		wp_nonce_field(basename(__FILE__), "info_metabox_nonce");
		$release_date = get_post_meta($post->ID, "release_date", true);
		$platforms = get_post_meta($post->ID, "platforms", true);
		$genres = get_post_meta($post->ID, "genres", true);
		$developer = get_post_meta($post->ID, "developer", true);
		$youtube_id = get_post_meta($post->ID, "youtube_id", true);
		$score = get_post_meta($post->ID, "score", true);

		?>
		<div class="metabox">
			<table class="form-table">
				<tr>
					<th><label for="release_date"><?php _e('Fecha de lanzamiento', 'egames'); ?></label></th>
					<td>
						<input type="date" id="release_date" name="release_date" value="<?php echo esc_attr($release_date) ?>">
						<br/>
					</td>
				</tr>
				<tr>
					<th><label for="platforms"><?php _e('Plataformas', 'egames'); ?></label></th>
					<td>
						<br/>
						<input type="checkbox" id="platforms" name="platforms[]" value="PS4" <?php if(in_array("PS4", $platforms)) echo "checked"; ?>> PS4<br/>
						<input type="checkbox" id="platforms" name="platforms[]" value="Xbox One" <?php if(in_array("Xbox One", $platforms)) echo "checked"; ?>> Xbox One<br/>
						<input type="checkbox" id="platforms" name="platforms[]" value="Nintendo Switch" <?php if(in_array("Nintendo Switch", $platforms)) echo "checked"; ?>> Nintendo Switch<br/>
						<input type="checkbox" id="platforms" name="platforms[]" value="PC" <?php if(in_array("PC", $platforms)) echo "checked"; ?>> PC<br/>
					</td>
				</tr>
				<tr>
					<th><label for="genres"><?php _e('Géneros', 'egames'); ?></label></th>
					<td>
						<br/>
						<input type="checkbox" id="genres" name="genres[]" value="action" <?php if(in_array("action", $genres)) echo "checked"; ?>> <?php _e('Acción', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="shooter" <?php if(in_array("shooter", $genres)) echo "checked"; ?>> <?php _e('Shooter', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="adventure" <?php if(in_array("adventure", $genres)) echo "checked"; ?>> <?php _e('Aventura', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="casual" <?php if(in_array("casual", $genres)) echo "checked"; ?>> <?php _e('Casual', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="driving" <?php if(in_array("driving", $genres)) echo "checked"; ?>> <?php _e('Conducción', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="sports" <?php if(in_array("sports", $genres)) echo "checked"; ?>> <?php _e('Deportes', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="strategy" <?php if(in_array("strategy", $genres)) echo "checked"; ?>> <?php _e('Estrategia', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="mmo" <?php if(in_array("mmo", $genres)) echo "checked"; ?>> <?php _e('MMO', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="roleplay" <?php if(in_array("roleplay", $genres)) echo "checked"; ?>> <?php _e('Rol', 'egames'); ?><br/>
						<input type="checkbox" id="genres" name="genres[]" value="simulation" <?php if(in_array("simulation", $genres)) echo "checked"; ?>> <?php _e('Simulación', 'egames'); ?><br/>
						
					</td>
				</tr>
				<tr>
					<th><label for="developer"><?php _e('Desarrollador', 'egames'); ?></label></th>
					<td>
						<input type="text" id="developer" name="developer" value="<?php echo esc_attr($developer) ?>">
						<br/>
					</td>
				</tr>
				<tr>
					<th><label for="youtube_id"><?php _e('ID YouTube', 'egames'); ?></label></th>
					<td>
						<input type="text" id="youtube_id" name="youtube_id" value="<?php echo esc_attr($youtube_id) ?>">
						<br/>
						<span class="description"><?php _e('Por ejemplo: QkkoHAzjnUs', 'egames'); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="score"><?php _e('Puntuación', 'egames'); ?></label></th>
					<td>
						<input type="number" step=".01" min="0" max="10" id="score" name="score" value="<?php echo esc_attr($score) ?>">
						<br/>
						<span class="description"><?php _e('Puntuación máxima: 10', 'egames'); ?></span>
					</td>
				</tr>
			</table>
		</div>
		<?php
	}

	function shop_metabox_callback($post)
	{
		wp_nonce_field(basename(__FILE__), "shop_metabox_nonce");
		$for_sale = get_post_meta($post->ID, "for_sale", true);
		$price = get_post_meta($post->ID, "price", true);
		$box_image_url = get_post_meta($post->ID, "box_image_url", true);
		$stock = get_post_meta($post->ID, "stock", true);
		$sales = get_post_meta($post->ID, "sales", true);

		?>
		<div class="metabox">
			<table class="form-table">
				<tr>
					<th><label for="for_sale"><?php _e('Vender', 'egames'); ?></label></th>
					<td>
						<input type="checkbox" id="for_sale" name="for_sale" value="1" <?php if($for_sale) echo "checked"; ?>>
						<br/>
						<span class="description"><?php _e('Marca esta casilla para vender el juego', 'egames'); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="price"><?php _e('Precio', 'egames'); ?></label></th>
					<td>
						<input type="number" step=".01" min="0" id="price" name="price" value="<?php echo esc_attr($price) ?>">
						<br/>
					</td>
				</tr>
				<tr>
					<th><label for="box_image_url"><?php _e('Imágen carátula URL', 'egames'); ?></label></th>
					<td>
						<input type="text" id="box_image_url" name="box_image_url" value="<?php echo esc_attr($box_image_url) ?>">
						<br/>
					</td>
				</tr>
				<tr>
					<th><label for="stock"><?php _e('Disponibilidad', 'egames'); ?></label></th>
					<td>
						<input type="number" min="0" id="stock" name="stock" value="<?php echo esc_attr($stock) ?>">
						<br/>
					</td>
				</tr>
				<tr>
					<th><label for="sales"><?php _e('Ventas', 'egames'); ?></label></th>
					<td>
						<input type="number" min="0" id="sales" name="sales" value="<?php echo esc_attr($sales) ?>">
						<br/>
					</td>
				</tr>
			</table>
		</div>
		<?php
	}

	function save_game_metabox_fields($post_id)
	{
		if(!wp_verify_nonce($_POST["info_metabox_nonce"], basename(__FILE__)))
			return;

		$release_date = $_POST["release_date"];
		update_post_meta($post_id, "release_date", $release_date);

		$platforms = $_POST["platforms"];
		update_post_meta($post_id, "platforms", $platforms);
		
		$genres = $_POST["genres"];
		update_post_meta($post_id, "genres", $genres);
		
		$developer = $_POST["developer"];
		update_post_meta($post_id, "developer", $developer);

		$youtube_id = $_POST["youtube_id"];
		update_post_meta($post_id, "youtube_id", $youtube_id);
			
		$score = sanitize_text_field($_POST["score"]);
		update_post_meta($post_id, "score", $score);

		if(wp_verify_nonce($_POST["shop_metabox_nonce"], basename(__FILE__)))
		{
			$for_sale = sanitize_text_field($_POST["for_sale"]);
			update_post_meta($post_id, "for_sale", $for_sale);

			$price = sanitize_text_field($_POST["price"]);
			update_post_meta($post_id, "price", $price);

			$box_image_url = sanitize_text_field($_POST["box_image_url"]);
			update_post_meta($post_id, "box_image_url", $box_image_url);

			$stock = sanitize_text_field($_POST["stock"]);
			update_post_meta($post_id, "stock", $stock);

			$sales = sanitize_text_field($_POST["sales"]);
			update_post_meta($post_id, "sales", $sales);
		}
	}
	add_action("save_post", "save_game_metabox_fields");
?>