<?php
/*

Plugin Name: Sharkquake AddThis Buttons
Plugin URI: http://jakelovedev.com/plugins/Sharkquake-AddThis-Buttons
Description: Drops bows all over WordPress. Trained by Chuck Norris himself, Sharkquake AddThis Buttons packs a roundhouse kick to the dome size social media solution.
Version: 0.1
Author: Jake Love
Author URI: http://jakelovedev.com
License: GPL2

*/

function jakes_shakquake_enqueue_scripts(){
	if ( is_single() ){
		wp_enqueue_scripts(
				'addThis-shakquake-style',
				'//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51f3248a1680dbb8',
				array(),
				null,
				true
			);
	}
}


add_action( 'wp_enqueue_scripts', 'jakes_shakquake_enqueue_scripts' );




function Sharkquake_AddThis_Buttons () {
	$theButtonShark = "
		<script type='text/javascript'>
		  addthis.layers({
		    'theme' : 'transparent',
		    'share' : {
		      'position' : 'left',
		      'numPreferredServices' : 6
		    }   
		  });
		</script>
		<!-- AddThis Smart Layers END -->
	";
	
}



































?>