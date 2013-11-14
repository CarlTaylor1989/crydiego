<?php

/*

@name			Socials Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Target
if (gp_option('gp_socials_target') != 'false') {
	$target = ' target="_blank"';
} else {
	$target = ' target="_self"';
}

?>

<ul class="socials">

    <?php if (gp_option('gp_socials_twitter')) { ?>
        <li class="social-twitter">
            <a href="<?php echo gp_option('gp_socials_twitter'); ?>" title="<?php _e('Twitter', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Twitter', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_facebook')) { ?>
        <li class="social-facebook">
            <a href="<?php echo gp_option('gp_socials_facebook'); ?>" title="<?php _e('Facebook', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Facebook', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_googleplus')) { ?>
        <li class="social-googleplus">
            <a href="<?php echo gp_option('gp_socials_googleplus'); ?>" title="<?php _e('Google+', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Google+', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_amazon')) { ?>
        <li class="social-amazon">
            <a href="<?php echo gp_option('gp_socials_amazon'); ?>" title="<?php _e('Amazon', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Amazon', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_youtube')) { ?>
        <li class="social-youtube">
            <a href="<?php echo gp_option('gp_socials_youtube'); ?>" title="<?php _e('YouTube', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('YouTube', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_vimeo')) { ?>
        <li class="social-vimeo">
            <a href="<?php echo gp_option('gp_socials_vimeo'); ?>" title="<?php _e('Vimeo', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Vimeo', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_itunes')) { ?>
        <li class="social-itunes">
            <a href="<?php echo gp_option('gp_socials_itunes'); ?>" title="<?php _e('iTunes', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('iTunes', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_soundcloud')) { ?>
        <li class="social-soundcloud">
            <a href="<?php echo gp_option('gp_socials_soundcloud'); ?>" title="<?php _e('SoundCloud', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('SoundCloud', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_beatport')) { ?>
        <li class="social-beatport">
            <a href="<?php echo gp_option('gp_socials_beatport'); ?>" title="<?php _e('Beatport', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Beatport', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_mixcloud')) { ?>
        <li class="social-mixcloud">
            <a href="<?php echo gp_option('gp_socials_mixcloud'); ?>" title="<?php _e('Mixcloud', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Mixcloud', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_purevolume')) { ?>
        <li class="social-purevolume">
            <a href="<?php echo gp_option('gp_socials_purevolume'); ?>" title="<?php _e('PureVolume', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('PureVolume', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_spotify')) { ?>
        <li class="social-spotify">
            <a href="<?php echo gp_option('gp_socials_spotify'); ?>" title="<?php _e('Spotify', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Spotify', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_lastfm')) { ?>
        <li class="social-lastfm">
            <a href="<?php echo gp_option('gp_socials_lastfm'); ?>" title="<?php _e('Last.fm', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Last.fm', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_myspace')) { ?>
        <li class="social-myspace">
            <a href="<?php echo gp_option('gp_socials_myspace'); ?>" title="<?php _e('Myspace', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Myspace', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_grooveshark')) { ?>
        <li class="social-grooveshark">
            <a href="<?php echo gp_option('gp_socials_grooveshark'); ?>" title="<?php _e('Grooveshark', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Grooveshark', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_flickr')) { ?>
        <li class="social-flickr">
            <a href="<?php echo gp_option('gp_socials_flickr'); ?>" title="<?php _e('Flickr', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Flickr', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_socials_pinterest')) { ?>
        <li class="social-pinterest">
            <a href="<?php echo gp_option('gp_socials_pinterest'); ?>" title="<?php _e('Pinterest', 'gp'); ?>"<?php echo $target; ?>>
                <?php _e('Pinterest', 'gp'); ?>
            </a>
        </li>
    <?php } ?>
    
    <?php if (gp_option('gp_search') != 'false') { ?>
    	<li>
            <a href="javascript:;" class="modal-search-button" title="<?php _e('Search ...', 'gp'); ?>">
                <?php _e('Search ...', 'gp'); ?>
            </a>
        </li>
	<?php } ?>
    
</ul><!-- END // socials -->