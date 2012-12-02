<?php 
/* 
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

<div id="main-content" class="clearfix fullwidth">
	<div id="left-area">
		<?php get_template_part('includes/breadcrumbs','page'); ?>
		<div id="entries">
			<div class="entry post clearfix">
				<?php get_template_part('loop','page'); ?>
			</div> <!-- end .entry -->
			
			<?php if (get_option('aggregate_show_pagescomments') == 'on') comments_template('', true); ?>
		</div> <!-- end #entries -->
	</div> <!-- end #left-area -->
<?php get_footer(); ?>