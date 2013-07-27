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

// Lets Add our script to the footer
function jakes_shakquake_enqueue_scripts(){
	if ( is_single() ){
		wp_enqueue_script(
				'addThis-shakquake-style',
				'//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51f3248a1680dbb8',
				array(),
				null,
				true
			);
	}
}

add_action( 'wp_enqueue_scripts', 'jakes_shakquake_enqueue_scripts' );



// Some logic to create our options page
function give_me_some_options(){
  add_options_page(
      __('Sharkquake AddThis Settings'),
      __('Sharkquake AddThis'),
      'manage_options',
      'sharkquake_addThis_options',
      'sharkquake_render_options'
    );
}

add_action( 'admin_menu', 'give_me_some_options' );

function sharkquake_render_options(){ ?>



<?php }



// Lets add the final product to the footer
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
	echo $theButtonShark;
}

add_action( 'wp_footer', 'Sharkquake_AddThis_Buttons', 100 );


































?>