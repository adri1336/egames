<?php
	/* Añadir soporte al tema */
	add_theme_support("post-thumbnails");
	add_theme_support("post-formats", array("image", "audio", "video", "quote", "link", "gallery"));

	//Scripts
	function add_scripts_to_my_theme()
    {
		wp_register_script("navbar.js", get_template_directory_uri() . "/assets/js/navbar.js", null, null, true);
		wp_enqueue_script("navbar.js");

		wp_register_script("last-reviews.js", get_template_directory_uri() . "/assets/js/last-reviews.js", null, null, true);
		wp_enqueue_script("last-reviews.js");
    }
	add_action("wp_enqueue_scripts", "add_scripts_to_my_theme");
	
	function loadDirectory()
	{
		?>
			<script type="text/javascript">
				let theme_directory = "<?php echo get_template_directory_uri(); ?>";
			</script> 
		<?php
	} 
	add_action("wp_head", "loadDirectory");

	/* Funcionalidad */
	function custom_login_logo()
	{
		?>
		<style type="text/css">
			#login h1 a, .login h1 a
			{
				background-image: url("<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png");
			}
		</style>
		<?php
	}
	add_action("login_enqueue_scripts", "custom_login_logo");

	function my_login_logo_url()
	{
		return home_url();
	}
	add_filter("login_headerurl", "my_login_logo_url");

	/*
	DEPRECATED
	function my_login_logo_url_title()
	{
		return "EGames";
	}
	add_filter("login_headertitle", "my_login_logo_url_title");*/

	function login_checked_remember_me()
	{
		add_filter("login_footer", "rememberme_checked");
	}
	add_action("init", "login_checked_remember_me");

	function rememberme_checked()
	{
		echo "<script>document.getElementById('rememberme').checked = true;</script>";
	}

	//Cambia el mensaje de error cuando el login es incorrecto
	function custom_login_error_message()
	{
		return "Creedenciales no válidas";
	}
	add_filter("login_errors", "custom_login_error_message");

	function my_loginredirect($redirect_to, $request, $user)
	{
		/*if(isset($user->roles) && is_array($user->roles)) :
			if(in_array("administrator", $user->roles)) :
				return admin_url();
			else :
				return home_url() . "/members";
			endif;
			return home_url() . "/members";
		endif;*/
		return home_url();
	}
	add_filter("login_redirect", "my_loginredirect", 10, 3);

	//Contador de visitas
	function add_post_visits_counter($postID)
	{
		$update = true;
		$count_key = "post_visits_counter";
		$count = get_post_meta($postID, $count_key, true);
		
		if($count == "") :
			$update = false;
			$count = 0;
		endif;
		
		$count ++;
		if($update) update_post_meta($postID, $count_key, $count);
		else add_post_meta($postID, $count_key, $count);
	}

	function get_post_visits_counter($postID)
	{
		$count_key = "post_visits_counter";
		$count = get_post_meta($postID, $count_key, true);
		if($count == "") $count = 0;
		return $count;
	}

	//Color categorias
	function getBadgeClassByCategory($category)
	{
		switch($category)
		{
			case "Nintendo Switch":
			{
				return "badge-danger";
			}
			case "PC":
			{
				return "badge-secondary";	
			}
			case "PS4":
			{
				return "badge-primary";
			}
			case "Xbox One":
			{
				return "badge-success";
			}
			default:
			{
				return "badge-dark";
			}
		}
	}

		//Color roles
		function getBadgeClassByRole($role)
		{
			switch($role)
			{
				case "administrator":
				{
					return "badge-danger";
				}
				case "editor":
				{
					return "badge-primary";	
				}
				case "author":
				{
					return "badge-success";
				}
				case "contributor":
				{
					return "badge-success";
				}
				default:
				{
					return "badge-dark";
				}
			}
		}

	//Caja formulario para comentar
	function cutom_comment_form_defaults($defaults)
	{
		$defaults["title_reply"] = "<h4 class='text-upper-title'>Comentarios (" . get_comments_number() . ")</h4>";
		//$defaults["logged_in_as"] = "";
		$defaults["comment_field"] = "<textarea id='comment' name='comment' class='form-control w-100' rows='5' maxlength='65525' required='required'></textarea>";
		$defaults["submit_button"] = '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-dark" value="%4$s" style="margin-top: 10px;" />';
		return $defaults;
	}
	add_filter("comment_form_defaults", "cutom_comment_form_defaults");

	function customize_comment_form_field($fields)
	{
		//Fields
		$aux_fields["author"] = "
		<div class='form-row' style='margin-top: 5px'>
			<div class='col'>
				<input type='text' class='form-control' id='author' name='author' placeholder='Nombre *' required='required'>
			</div>
		";

		$aux_fields["email"] = "
			<div class='col'>
				<input type='text' class='form-control' id='email' name='email' placeholder='Correo electrónico *' required='required'>
			</div>
		</div>
		";
		
		//Checkboxes
		$aux_fields["cookies"] = "
		<div class='form-check' style='margin-top: 5px'>
			<p class='comment-form-public'>
				<input id='cookies' name='cookies' type='checkbox' class='form-check-input'/>
				<label class='form-check-label' for='cookies'>Guardar mi nombre, correo electrónico y sitio web en este navegador para la próxima vez que haga un comentario.</label>
			</p>
		";

		$aux_fields["consent"] = "
			<p class='comment-form-public'>
				<input id='consent' name='consent' type='checkbox' class='form-check-input' required='required'/>
				<label class='form-check-label' for='consent'>Marque esta casilla para darnos permiso para publicar públicamente su comentario. (Acepta nuestra política de privacidad) *</label>
			</p>
		</div>";
		return $aux_fields;
	}
	add_filter("comment_form_default_fields", "customize_comment_form_field");

	//Consentimiento politica de privacidad comentarios
	function save_comment_meta_checkbox($comment_id)
	{
		$save_meta_checkbox = $_POST["consent"];
		if($save_meta_checkbox == "on") : $value = "Acepto la política de privacidad";
		else : $value = "NO acepto la política de privacidad";
		endif;
		add_comment_meta($comment_id, "consent", $value, true);
	}
	add_action("comment_post", "save_comment_meta_checkbox", 1);

	function edit_comments_add_columns($columns)
	{
		$columns = array(
			"cb" => "<input type='checkbox'>",
			"author" => 'Autor',
			"comment" => "Comentario",
			"consent_column" => "Consentimiento",
			"response" => "Respuesta",
			"date" => "Fecha"
		);
		return $columns;
	}
	add_filter("manage_edit-comments_columns", "edit_comments_add_columns");

	function consent_column($col, $comment_id)
	{
		switch($col)
		{
			case "consent_column":
			{
				if($t = get_comment_meta($comment_id, "consent", true)) : echo esc_html($t);
				else : echo esc_html("");
				endif;
				break;	
			}
		}
	}
	add_action("manage_comments_custom_column", "consent_column", 10, 2);

	//Lista comentarios
	function custom_comments_list($comment, $args, $depth)
	{
		?>
		<li class="row section-title">
			<div class="col-auto p-0">
				<a href="<?php echo get_author_posts_url($comment->user_id); ?>">
					<?php
					if(get_the_author_meta('userpic', $comment->user_id) != "") : echo "<img src='" . get_the_author_meta('userpic', $comment->user_id) . "'/>";
					else : echo get_avatar( $comment, $args['avatar_size'] );
					endif;
					?>
				</a>
			</div>
			<div class="col">
				<a href="<?php echo get_author_posts_url($comment->user_id); ?>" class="author-link">
					<h5 class="font-weight-bold"><?php echo comment_author(); ?></h5>
				</a>
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<h6><small><?php echo get_comment_date() . " a las " . get_comment_time(); ?></small></h6>
				</a>
				<p>
					<?php echo get_comment_text(); ?>
				</p>
				<h6>
					<small>
						<?php 
						comment_reply_link( 
							array_merge( 
								$args, 
								array( 
									'depth'     => $depth, 
									'max_depth' => $args['max_depth'] 
								)
							) 
						); ?>	
						<?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
					</small>
				</h6>
			</div>
		</li>
		<?php
	}

	/* Author Custom fields */
	function add_author_custom_fields($user)
    {
        ?>
        <h3>URL Foto de perfil</h3>
        <table class="form-table">
            <tr>
                <th><label for="userpic">URL Foto de perfil</label></th>
                <td>
                    <input type="text" name="userpic" id="userpic" value="<?php echo esc_attr( get_the_author_meta( 'userpic', $user->ID ) ); ?>" class="regular-text"/>
                    <br />
                    <span class="description">Introduce la URL para tu foto de perfil.</span>
                </td>
            </tr>
        </table>

        <h3>Redes sociales</h3>
        <table class="form-table">
            <tr>
                <th><label for="psn">PlayStation Network</label></th>
                <td>
                    <input type="text" name="psn" id="psn" value="<?php echo esc_attr( get_the_author_meta( 'psn', $user->ID ) ); ?>" class="regular-text"/>
                    <br />
                    <span class="description">Introduce tu ID de PlayStation Network.</span>
                </td>
            </tr>

			<tr>
                <th><label for="xlive">Xbox Live</label></th>
                <td>
                    <input type="text" name="xlive" id="xlive" value="<?php echo esc_attr( get_the_author_meta( 'xlive', $user->ID ) ); ?>" class="regular-text"/>
                    <br />
                    <span class="description">Introduce tu ID de Xbox Live.</span>
                </td>
            </tr>

			<tr>
                <th><label for="nswitch">Nintendo Network</label></th>
                <td>
                    <input type="text" name="nswitch" id="nswitch" value="<?php echo esc_attr( get_the_author_meta( 'nswitch', $user->ID ) ); ?>" class="regular-text"/>
                    <br />
                    <span class="description">Introduce tu ID de Nintendo Network.</span>
                </td>
            </tr>

			<tr>
                <th><label for="steam">Steam</label></th>
                <td>
                    <input type="text" name="steam" id="steam" value="<?php echo esc_attr( get_the_author_meta( 'steam', $user->ID ) ); ?>" class="regular-text"/>
                    <br />
                    <span class="description">Introduce tu ID de Steam.</span>
                </td>
            </tr>
        </table>
    <?php }
    add_action("show_user_profile", "add_author_custom_fields");
	add_action("edit_user_profile", "add_author_custom_fields");
	
	//Actualizar autor custom fields
	function update_custom_fields($user_id)
	{
		if ( !current_user_can( 'edit_user', $user_id ) ) return false;
		update_user_meta( $user_id, 'userpic', $_POST['userpic'] );
		update_user_meta( $user_id, 'psn', $_POST['psn'] );
		update_user_meta( $user_id, 'xlive', $_POST['xlive'] );
		update_user_meta( $user_id, 'nswitch', $_POST['nswitch'] );
		update_user_meta( $user_id, 'steam', $_POST['steam'] );
	}
	add_action('personal_options_update','update_custom_fields');
	add_action('edit_user_profile_update','update_custom_fields');

?>