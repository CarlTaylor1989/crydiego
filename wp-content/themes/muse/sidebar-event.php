<?php

/*

@name			Events Sidebar Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar Class
$sidebar_class = gp_option('gp_event_sidebar');
?>

<div class="sidebar-event sidebar-<?php echo $sidebar_class; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget_area_event'); ?>
    
</div><!-- END // sidebar -->