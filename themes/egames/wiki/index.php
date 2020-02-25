<?php
    get_header();
    
    require_once("config.php");
    require_once("DBConnection.php");
    $dbh = new DBConnection();
    $con = $dbh->getDbh();
    
    $posts_per_page = get_option("posts_per_page");
    
    $stmt = $con->prepare("SELECT COUNT(*) FROM juego;");
    $stmt->execute();
    $tuplas_totales = $stmt->fetch(PDO::FETCH_NUM)[0];
    
    $total_pages = ceil($tuplas_totales / $posts_per_page);
    
    $paged = 1;
    if(isset($_POST["page"])) :
        $paged = $_POST["page"];
    endif;
?>

<section class="section-light first-section">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <?php
                    $sql = "SELECT juego.*, AVG(valoracion) AS valoracion FROM juego LEFT JOIN valoracion ON juego.id = valoracion.idjuego GROUP BY juego.id ORDER BY titulo ASC LIMIT " . $posts_per_page . " OFFSET " . ($paged - 1) * $posts_per_page . ";";
                    $result = $dbh->getQuery($sql);
                    if($result->rowCount() > 0) :
                        foreach($result as $row) :
                            ?>
                            <div class="row section-title">
								<div class="recent-new-img-box">
                                    <img src="https://informatica.ieszaidinvergeles.org:9061/egames/images/juegos/<?php echo $row[id]; ?>.jpg" class="recent-new-img" onerror="this.src = '<?php echo get_template_directory_uri();?>/assets/img/game_placeholder.png'">
								</div>
								<div class="col recent-new-box">
									<h4 class="font-weight-bold recent-new-title">
										<?php echo $row[titulo]; ?>
										</a>
									</h4>
									<span class="text-upper-title">
										<?php echo __($row[tipo], 'egames') . " ($row[fecha_lanzamiento])"; ?>
									</span>
									<span class="recent-new-comments text-upper-title">											
										<?php
										    if(is_null($row[valoracion])) : _e('Sin valoración', 'egames');
										    else: echo round($row[valoracion], 2) . "/10";
										    endif;
										?>
									</span>
									<hr>
									<p class="text-justify">
										<?php echo wp_trim_words($row[descripcion], 40, '...' ); ?>
									</p>
								</div>
							</div>
                            <?php
                        endforeach;
                    endif;
                ?>
                <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
                    <div class="row">
    					<div class="col-3 p-0">
    					    <button type="<?php if($paged > 1): echo 'submit'; else: echo 'button'; endif; ?>" name="page" class="btn btn-warning w-100 <?php if($paged <= 1) echo "disabled"; ?>" <?php echo "value='" . ($paged - 1) . "'"; ?>><?php _e('ANTERIOR', 'egames'); ?></button>
    					</div>
    					<div class="col align-self-center text-center">
    						<?php 
    							if($total_pages <= 1) :
    								echo "<span class='page-numbers' style='border-bottom: 1px solid rgb(26, 217, 219);'>1</span>";
    							else :
    								for($i = 1; $i <= $total_pages; $i ++) :
    									if($paged == $i) : echo "<span class='page-numbers' style='border-bottom: 1px solid rgb(26, 217, 219);'>$i</span> ";
    									else : echo "<input type='submit' class='page-numbers page-input' value='$i'/>";
    									endif;
    								endfor;
    							endif;
    						?>
    					</div>
    					<div class="col-3 p-0">
    						<button type="<?php if($paged < $total_pages): echo 'submit'; else: echo 'button'; endif; ?>" name="page" class="btn btn-warning w-100 <?php if($paged >= $total_pages) echo "disabled" ?>" <?php echo "value='" . ($paged + 1) . "'"; ?>><?php _e('SIGUIENTE', 'egames'); ?></button>
    					</div>
    				</div>
				</form>
            </div>
            <div class="col-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
</section>

<?php
    get_footer();
?>