<?php
    if(is_user_logged_in()) :
        header('Location: ' . home_url());
    endif;
	get_header();
?>

<section class="section-light first-section">
    <div class="container">
        <div class="row top-separator">
            <div class="col-4">
            </div>
            <div class="col-4">
                <h1 class="font-weight-bold text-center"><?php _e('Iniciar sesión', 'egames'); ?></h1>
                <?php
                    $args = array(
                        "echo" => true,
                        "remember" => true,
                        "form_id" => "loginform"
                    );
                    wp_login_form($args);
                ?>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
</section>

<?php
    get_footer();
?>