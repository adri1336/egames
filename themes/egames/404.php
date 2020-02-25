<?php
    get_header();
?>

<section class="section-light first-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2><?php _e('No se han encontrado nada', 'egames'); ?></h2>
                <h1 class="display-1">:/</h1>
                <!--<img src="http://webbloqueadaporpolicianacional.com/rc_images/Esc.jpeg" style="width: 100%;">-->
                <a href="<?php echo get_home_url(); ?>" class="font-weight-bold">← <?php _e('Ir a Inicio', 'egames'); ?></a>
                
            </div>
        </div>
    </div>
</section>

<?php
    get_footer();
?>
