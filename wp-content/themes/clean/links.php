<?php get_header(); ?>

		<div id="pageHead">
			<h1><?php _e('Links', 'themetrust'); ?></h1>
		</div>
						 
		<div id="content" class="twoThird clearfix">			    
			<div class="page clearfix">	
				<div class="inside">				
				<ul>
					<?php get_links_list(); ?>
				</ul>
				</div>				
			</div>						    	
		</div>		
		<?php get_sidebar(); ?>
	
<?php get_footer(); ?>
