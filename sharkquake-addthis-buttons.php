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
      __('Sharkquake AddThis'),
      __('Sharkquake AddThis'),
      'manage_options',
      'sharkquake_addthis_settings',
      'sharkquake_render_options'
    );
}

add_action( 'admin_menu', 'give_me_some_options' );

// Rendering the admin (Used Zack Tollmans Example from class)
function sharkquake_render_options(){ ?>
  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php _e('Sharkquake AddThis Settings'); ?></h2>
    <form action="options.php" method="post">
      <?php settings_fields('sharkquake_position'); ?>
      <?php do_settings_sections( 'sharkquake_addthis_settings' ); ?>
      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save It!'); ?>">
      </p>
    </form>
  </div>
<?php }

// Lets add some settings
function sharkquake_add_settings(){

  register_setting(
      'sharkquake_position',
      'sharkquake_position',
      'sanitize_key'
    );
  add_settings_section(
      'sharkquake_main_section',
      __('Settings'),
      'skarkquake_main_description',
      'sharkquake_addthis_settings'
    );
  add_settings_field(
      'sharkquake_addThis_position_field',
      __('Position:'),
      'sharkquake_button_position',
      'sharkquake_addthis_settings',
      'sharkquake_main_section'
    );

  register_setting(
      'sharkquake_position',
      'sharkquake_items',
      'sanitize_key'
    );
  add_settings_section(
      'sharkquake_items_section',
      null,
      null,
      'sharkquake_addthis_settings'     
    );
  add_settings_field(
      'sharkquake_addThis_items_field',
      __('Items:'),
      'sharkquake_items_select',
      'sharkquake_addthis_settings',
      'sharkquake_items_section'
    );

  register_setting(
      'sharkquake_position',
      'sharkquake_disable',
      'sanitize_key'
    );
  add_settings_section(
      'sharkquake_disable_button',
      null,
      null,
      'sharkquake_addthis_settings'
    );
  add_settings_field(
      'sharkquake_addThis_disable_field',
      __('Disable:'),
      'sharkquake_disable_addthis',
      'sharkquake_addthis_settings',
      'sharkquake_disable_button'
    );

}

add_action( 'admin_init', 'sharkquake_add_settings' );

function skarkquake_main_description(){
  echo '<p>Use the below settings to fine-tune your social media sharing experience. Also be sure to post interesting articles. Churck Norris rocks.</p>';
}

function sharkquake_button_position(){
  $position = get_option( 'sharkquake_position', 0 ); // to-do

  $pos = '<input type="radio" id="addThisPositionLeft" name="sharkquake_position" value="1" '.checked( $position, 1, false ).' />';
  $pos .= '<label for="addThisPositionLeft"> Left</label> ';
  $pos .= '&nbsp;&nbsp;&nbsp;<input type="radio" id="addThisPositionRight" name="sharkquake_position" value="2" '.checked( $position, 2, false ).' />';
  $pos .= '<label for="addThisPositionRight"> Right</label> ';

  echo $pos;
}

function sharkquake_items_description(){
  echo '<p>Here we can set the number of social sharing methods to be displayed on screen. You may select any number to display from 1-6.</p>';
}

function sharkquake_items_select(){
  $items = get_option( 'sharkquake_items', 1 );

  $select = '<select id="sharkquake_items" name="sharkquake_items">';
    $select .= '<option value="1" '.selected( $items, 1, false ).'>1</option>';
    $select .= '<option value="2" '.selected( $items, 2, false ).'>2</option>';
    $select .= '<option value="3" '.selected( $items, 3, false ).'>3</option>';
    $select .= '<option value="4" '.selected( $items, 4, false ).'>4</option>';
    $select .= '<option value="5" '.selected( $items, 5, false ).'>5</option>';
    $select .= '<option value="6" '.selected( $items, 6, false ).'>6</option>';
  $select .= '</select>';

  echo $select;
}

function sharkquake_disable_addthis(){
  $status = get_option( 'sharkquake_disable', 0 );

  $disable = '<input id="sharkquake_disable" name="sharkquake_disable" type="checkbox" value="1" '.checked( $status, 1, false ).'/>';

  echo $disable;
}



// Lets add the final product to the footer
function Sharkquake_AddThis_Buttons () {
  $position = get_option( 'sharkquake_position', 'left' );
  if ( $position == 1 ){
    $render = 'left';
  } else {
    $render = 'right';
  }
  $items = get_option('sharkquake_items', 1);
	$theButtonShark = "
		<script type='text/javascript'>
		  addthis.layers({
		    'theme' : 'transparent',
		    'share' : {
		      'position' : '".$render."',
		      'numPreferredServices' : ".$items."
		    }   
		  });
		</script>
		<!-- AddThis ".$position." -->
	";
	echo $theButtonShark;
}

add_action( 'wp_footer', 'Sharkquake_AddThis_Buttons', 100 );

?>