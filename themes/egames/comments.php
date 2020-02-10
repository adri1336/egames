<?php
	comment_form();
?>

<ul class="container commentlist">
	<?php wp_list_comments("type=comment&callback=custom_comments_list"); ?>
</ul>