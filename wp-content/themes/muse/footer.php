<?php

/*

@name			Footer Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

?>

	<footer class="footer clearfix">
    
    	<?php if (is_active_sidebar('widget_area_footer_full')) { ?>
        
        	<div class="wa-footer-top wa-footer grid clearfix">
        
                <div class="wa-footer-full one-entire">
                	<div class="inner">
            
	                <?php dynamic_sidebar('widget_area_footer_full'); ?>
                    
                    </div>
                </div><!-- END // wa-footer-full -->
            
            </div><!-- END // grid -->
		
		<?php } ?>
        
        <?php
		if (is_active_sidebar('widget_area_footer_first') &&
			is_active_sidebar('widget_area_footer_second') &&
			is_active_sidebar('widget_area_footer_third') &&
			is_active_sidebar('widget_area_footer_fourth') &&
			is_active_sidebar('widget_area_footer_fifth')) {
			$area_class = 'one-fifth';
		} else
		if (is_active_sidebar('widget_area_footer_first') &&
			is_active_sidebar('widget_area_footer_second') &&
			is_active_sidebar('widget_area_footer_third') &&
			is_active_sidebar('widget_area_footer_fourth')) {
			$area_class = 'one-fourth';
		} else
		if (is_active_sidebar('widget_area_footer_first') &&
			is_active_sidebar('widget_area_footer_second') &&
			is_active_sidebar('widget_area_footer_third')) {
			$area_class = 'one-third';
		} else
		if (is_active_sidebar('widget_area_footer_first') &&
			is_active_sidebar('widget_area_footer_second')) {
			$area_class = 'one-half';
		} else
		if (is_active_sidebar('widget_area_footer_first')) {
			$area_class = 'one-entire align-center';
		}
		
        if (is_active_sidebar('widget_area_footer_first') ||
			is_active_sidebar('widget_area_footer_second') ||
			is_active_sidebar('widget_area_footer_third') ||
			is_active_sidebar('widget_area_footer_fourth') ||
			is_active_sidebar('widget_area_footer_fifth')) {
		?>
        
        	<div class="wa-footer-bottom wa-footer grid grid-merge clearfix">
        
				<?php if (is_active_sidebar('widget_area_footer_first')) { ?>
        
                    <div class="wa-footer-first wa-footer-block <?php echo $area_class; ?>">
                    	<div class="inner-double-no-bottom">
                    
                        <?php dynamic_sidebar('widget_area_footer_first'); ?>
                    	
                        </div>
                    </div><!-- END // wa-footer-first -->
                    
                <?php } ?>
                    
                <?php if (is_active_sidebar('widget_area_footer_second')) { ?>
        
                    <div class="wa-footer-second wa-footer-block <?php echo $area_class; ?>">
                    	<div class="inner-double-no-bottom">
                    
                        <?php dynamic_sidebar('widget_area_footer_second'); ?>
                        
                        </div>                    
                    </div><!-- END // wa-footer-second -->
                    
                <?php } ?>
                
                <?php if (is_active_sidebar('widget_area_footer_third')) { ?>
        
                    <div class="wa-footer-third wa-footer-block <?php echo $area_class; ?>">
                    	<div class="inner-double-no-bottom">
                    
                        <?php dynamic_sidebar('widget_area_footer_third'); ?>
                        
                    	</div>
                    </div><!-- END // wa-footer-third -->
                    
                <?php } ?>
                
                <div class="wa-footer-container">
                
                <?php if (is_active_sidebar('widget_area_footer_fourth')) { ?>
        
                    <div class="wa-footer-fourth wa-footer-block <?php echo $area_class; ?>">
                    	<div class="inner-double-no-bottom">
                    
                        <?php dynamic_sidebar('widget_area_footer_fourth'); ?>
                        
                    	</div>
                    </div><!-- END // wa-footer-fourth -->
                    
                <?php } ?>
                
                <?php if (is_active_sidebar('widget_area_footer_fifth')) { ?>
        
                    <div class="wa-footer-fifth wa-footer-block <?php echo $area_class; ?>">
                    	<div class="inner-double-no-bottom">
                    
                        <?php dynamic_sidebar('widget_area_footer_fifth'); ?>
                        
                    	</div>
                    </div><!-- END // wa-footer-fifth -->
                    
                <?php } ?>
                
                </div>
                
			</div><!-- END // grid -->
        
        <?php } ?>
            
        <div class="footer-absolute clearfix">
        
        	<div class="copyright float-left">
        
        		<?php
                if (gp_option('gp_footer_copyright')) {
					
					echo gp_option('gp_footer_copyright');
				
				} else {
				?>
				
					<?php _e('Copyright &copy;', 'gp') ?> <?php echo date('Y'); ?> <a class="underline" href="http://www.mafiashare.net">Wordpress</a>
                
                <?php
				}
				?>
            
            </div><!-- END // copyright -->

			<?php get_template_part('socials'); ?>

        </div><!-- END // footer-absolute -->
    
    </footer>
    
    <div class="back-to-top" title="Back to Top"></div><!-- END // back-to-top -->

	<?php gp_footer(); ?>
    <?php wp_footer(); ?>

</body>
</html>