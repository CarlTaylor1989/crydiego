<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
    <link rel="dns-prefetch" href="http://ajax.googleapis.com" />
    
	<?php gp_meta_head(); ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="author" content="www.grandpixels.com" />
	
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if (gp_option('gp_feedburner') != '') { echo gp_option('gp_feedburner'); } else { bloginfo('rss2_url'); } ?>" />
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <title><?php wp_title(''); ?></title>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

	<div class="body-background"></div>
    
    <?php
	if (gp_option('gp_search') != 'false') {
	?>
    <div class="modal-search display-none">
    	<div class="modal-search-inner">
        	<div class="modal-search-input">
        		<?php get_search_form(); ?>
            </div>
        </div>
        <a href="javascript:;" title="<?php _e('Close', 'gp'); ?>" class="modal-search-close">
        </a>
        
    </div><!-- END // modal-search -->
    <?php
	}
	?>
    
    <header class="header transition">
    
    	<?php if (gp_option('gp_image_logo')) { ?>
                
            <div class="logo-image float-left">
            
                <?php if (is_front_page()) { ?>
                
                    <h1>
                        <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                            <img src="<?php echo gp_option('gp_image_logo'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                        </a>
                    </h1>
                    
                <?php } else { ?>
                
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <img src="<?php echo gp_option('gp_image_logo'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>
                    
                <?php } ?>
                
                
            </div><!-- END // logo-image -->
            
        <?php } else { ?>
        
            <div class="logo-default float-left">
            
                <?php if (is_front_page()) { ?>
                
                    <h1>
                        <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"></a>
                    </h1>
                    
                <?php } else { ?>
                
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"></a>
                    
                <?php } ?>
                
            </div><!-- END // logo-default -->
            
        <?php } ?>
    
    </header><!-- END // header -->
    
    <nav class="navigation" role="navigation">
        
		<?php gp_navigation(); ?>
        
    </nav><!-- END // navigation -->
    
    <div class="navigation-mobile-button">
    
    	<a href="#navigation-mobile"></a>
        
    </div><!-- END // navigation-mobile-button -->

	<nav id="navigation-mobile" class="navigation-mobile float-right transition display-none" role="navigation">
    
    	<?php gp_navigation(); ?>
    
    </nav><!-- END // navigation-mobile -->
	
    <?php if (gp_option('gp_search') != 'false' || gp_option('gp_socials_header') != 'false' || function_exists('qtrans_generateLanguageSelectCode')) { ?>

        <div class="toolbar">
    
            <?php
			if (gp_option('gp_socials_header') != 'false') {
            	get_template_part('socials');
            }
			?>
            
            <?php
            if (function_exists('qtrans_generateLanguageSelectCode')) {
				echo qtrans_generateLanguageSelectCode('image');
            }
			?>
    
        </div><!-- END // toolbar -->
    
    <?php } ?>
    
    