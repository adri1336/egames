<?php
	get_header();
?>

<section class="section-light first-section">
	<div class="container">
        <div class="card-columns">
            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Noticias</h4>
                    <ul>
                        <?php
                            $args=array(
                                'type' => 'postbypost',
                                'limit' => 8,
                            );
                            wp_get_archives($args);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Autores</h4>
                    <ul>
                        <?php
                            wp_list_authors('optioncount=1&hide_empty=0');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Categorías</h4>
                    <ul>
                        <?php
                            wp_list_categories('title_li');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Páginas</h4>
                    <ul>
                        <?php
                            wp_list_pages('title_li');
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Fechas</h4>
                    <ul>
                        <?php
                            wp_get_archives();
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card archives-box">
                <div class="card-body">
                    <h4 class="card-title text-center text-upper-title">Videojuegos</h4>
                    <ul>
                        <?php
                            $args=array(
                                'type' => 'postbypost',
                                'post_type' => 'egames',
                                'limit' => 5,
                            );
                            wp_get_archives($args);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
	</div>
</section>

<?php
	get_footer();
?>