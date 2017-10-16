<?php
	/*
	Template Name: brancoSlider
	*/
	get_header();
 ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="slider">
				<div>3</div>
				<div>9</div>
				<div>27</div>
			</div><!--#slider-->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<script>
	$(document).ready(function(){
	  $('#slider').slick({

	  });
	});
</script>
<?php get_footer();?>
