<?php
/*
Plugin Name: Skitter Slideshow
Plugin URI: http://thiagosf.net/projetct/jquery/skitter
Description: jQuery Slideshow for Wordpress using Skitter Slideshow
Version: 1.0
Author: Thiago Silva Ferreira
Author URI: http://thiagosf.net
License: GPL

Copyright 2011 Thiago Silva Ferreira (thiago@thiagosf.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

add_action('admin_menu', 'wp_skitter_add_menu');
add_action('admin_init', 'wp_skitter_reg_function');

register_activation_hook( __FILE__, 'wp_skitter_activate');

wp_enqueue_script('skitter', WP_PLUGIN_URL . '/wp-skitter-slideshow/js/jquery.skitter.min.js', array('jquery'));
wp_enqueue_script('jquery-ui-custom', WP_PLUGIN_URL . '/wp-skitter-slideshow/js/jquery-ui.min.js', array('jquery'));
wp_enqueue_style( 'skitter.styles', WP_PLUGIN_URL . '/wp-skitter-slideshow/css/skitter.styles.css');

function wp_skitter_add_menu() 
{
    $page = add_options_page('Skitter Slideshow', 'Skitter Slideshow', 'administrator', 'wp_skitter_menu', 'wp_skitter_menu_function');
}

function getSkitterSettings() 
{
	$wp_skitter_settings = array(
		'wp_skitter_category', 
		'wp_skitter_slides', 
		'wp_skitter_animation', 
		'wp_skitter_velocity', 
		'wp_skitter_interval', 
		'wp_skitter_numbers', 
		'wp_skitter_navigation', 
		'wp_skitter_label', 
		'wp_skitter_easing_default', 
		'wp_skitter_animateNumberOut', 
		'wp_skitter_animateNumberOver', 
		'wp_skitter_animateNumberActive', 
		'wp_skitter_thumbs', 
		'wp_skitter_hideTools', 
		'wp_skitter_fullscreen', 
		'wp_skitter_xml', 
		'wp_skitter_dots', 
		'wp_skitter_width_label', 
		'wp_skitter_width', 
		'wp_skitter_height',
		'wp_skitter_crop'
	);
	return $wp_skitter_settings;
}

function wp_skitter_reg_function() 
{
	$settings = getSkitterSettings();
	foreach ($settings as $option) {
		register_setting( 'wp_skitter_settings', $option );
	}
}

function wp_skitter_activate() 
{
	add_option('wp_skitter_category','1');
	add_option('wp_skitter_animation','random');
	add_option('wp_skitter_slides','5');
	
	add_option('wp_skitter_numbers','true');
	add_option('wp_skitter_navigation','true');
	add_option('wp_skitter_label','true');
	
	add_option('wp_skitter_crop','true');
}

function filterValueSkitter ($option, $value) 
{
	$booleans = array('wp_skitter_numbers', 'wp_skitter_navigation', 'wp_skitter_label', 'wp_skitter_thumbs', 'wp_skitter_hideTools', 'wp_skitter_fullscreen', 'wp_skitter_dots');
	
	$strings = array('wp_skitter_animation', 'wp_skitter_width', 'wp_skitter_height', 'wp_skitter_easing_default', 'wp_skitter_xml', 'wp_skitter_width_label');
	if (in_array($option, $booleans)) {
		$value = $value == 'true' ? 'true' : 'false';
	} 
	else if (in_array($option, $strings) && !empty($value)) {
		$value = '"'.$value.'"';
	}
	return $value;
}

function pr ($array) 
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function show_skitter() 
{
	$width_skitter = get_option('wp_skitter_width');
	$height_skitter = get_option('wp_skitter_height');
	
	$category = get_option('wp_skitter_category');
	$wp_skitter_slides = get_option('wp_skitter_slides');

?>

<style type="text/css">
	.box_skitter {width:<?php echo $width_skitter; ?>px;height:<?php echo $height_skitter; ?>px;}
</style>

<?php

	$options = array();
	$settings = getSkitterSettings();
	$block = array('wp_skitter_category', 'wp_skitter_slides', 'wp_skitter_width', 'wp_skitter_height');

	foreach ($settings as $option) {
		$get_option = get_option($option);
		$get_option = filterValueSkitter($option, $get_option);
		if (!empty($get_option) && !in_array($option, $block)) {
			$options[] = str_replace('wp_skitter_', '', $option).': '.$get_option;
		}
	}

	$options = implode(", \n\t\t", $options);

?>

<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#wp_skitter').skitter({
		<?php echo $options;?>
	});
});
</script>

<div id="wp_skitter" class="box_skitter">
	<ul>
		<?php query_posts( 'cat='.$category.'&posts_per_page='.$wp_skitter_slides ); if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php if (has_post_thumbnail()) : ?>
		
		<?php
		
		if (get_option('wp_skitter_crop')) {
			$thumbnail = get_the_post_thumbnail($post->ID, 'large');
			preg_match('/src="([^"]*)"/i', $thumbnail, $matches);
			$image = (isset($matches[1])? $matches[1] : null);
			
			$image_slider  = WP_PLUGIN_URL.'/wp-skitter-slideshow/image.php?image='.$image;
			$image_slider .= '&width='.$width_skitter.'&height='.$height_skitter;
			$image_slider = '<img src="'.$image_slider.'" />';
		}
		else {
			$image_slider = get_the_post_thumbnail();
		}
		
		$content = strip_tags(get_the_content());
		if (preg_match('/^Link:(http:\/\/.*)/i', $content, $matches)) {
			$link = $matches[1];
		}
		else {
			$link = get_permalink();
		}
		
		?>
		
		<li>
			<a href="<?php echo $link; ?>" title="<?php the_title(); ?>"> 
				<?php echo $image_slider ?>
			</a>
			<div class="label_text">
				<p><?php the_title(); ?></p>
			</div>
		</li>
		<?php endif ?>
		<?php endwhile; endif;?>
		<?php wp_reset_query();?>
	</ul>
</div>
<?php 

} 

function wp_skitter_menu_function() {
	
?>

<div class="wrap">
	<h2>Skitter Slideshow</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'wp_skitter_settings' ); ?>
		<table class="form-table">
		  
			<tr valign="top">
				<th scope="row">Category</th>
				<td>
					<select name="wp_skitter_category" id="wp_skitter_category"> 
						 <option value="">Select a Category</option> 
						<?php 
							$category = get_option('wp_skitter_category');
							$categories=  get_categories(); 
							foreach ($categories as $cat) {
								$option = '<option value="'.$cat->term_id.'"';
								if ($category == $cat->term_id) $option .= ' selected="selected">';
								else { $option .= '>'; }
								$option .= $cat->cat_name;
								$option .= ' ('.$cat->category_count.')';
								$option .= '</option>';
								echo $option;
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">Number of slides</th>
				<td><input type="text" name="wp_skitter_slides" id="wp_skitter_slides" size="7" value="<?php echo get_option('wp_skitter_slides'); ?>" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row" colspan="2">Customization</th>
			</tr>
			
			<tr valign="top">
				<th scope="row">Type of Animation</th>
				<td>
					<?php $wp_skitter_animation = get_option('wp_skitter_animation'); ?>
					<select name="wp_skitter_animation" id="wp_skitter_animation">
						<?php
						
						$animations = array(
							'random', 
							'cube', 
							'cubeRandom', 
							'block', 
							'cubeStop', 
							'cubeHide', 
							'cubeSize', 
							'horizontal', 
							'showBars', 
							'showBarsRandom', 
							'tube',
							'fade',
							'fadeFour',
							'paralell',
							'blind',
							'blindHeight',
							'blindWidth',
							'directionTop',
							'directionBottom',
							'directionRight',
							'directionLeft',
							'cubeStopRandom',
							'cubeSpread',
							'cubeJelly',
						);
						
						foreach ($animations as $animation) {
							$selected = ($animation == $wp_skitter_animation) ? ' selected="selected"' : '';
							$value = $animation != 'all' ? $animation : '';
							echo sprintf('<option value="%s"%s>%s</option>', $value, $selected, $animation);
						}
						
						?>
					</select>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">width</th>
				<td><input type="text" name="wp_skitter_width" id="wp_skitter_width" size="7" value="<?php echo get_option('wp_skitter_width'); ?>" />px</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">height</th>
				<td><input type="text" name="wp_skitter_height" id="wp_skitter_height" size="7" value="<?php echo get_option('wp_skitter_height'); ?>" />px</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">crop image</th>
				<td><input type="checkbox" value="true" name="wp_skitter_crop" id="wp_skitter_crop" <?php echo (get_option('wp_skitter_crop') == 'true' ? ' checked="checked"' : ''); ?> /></td>
			</tr>
			
			<?php
			
			$data = array(
				array('velocity', 'Velocity of animation', '1', "2"),
				array('interval', 'Interval between transitions', '2500', "3000"),
				array('numbers', 'Numbers display', 'true', "false"),
				array('navigation', 'Navigation display', 'true', "false"),
				array('label', 'Label display', 'true', "false"),
				array('easing_default', 'Easing default', 'null', "easeOutBack"),
				array('animateNumberOut', 'Animation/style number', "{backgroundColor:'#333', color:'#fff'}", "{backgroundColor:'#000', color:'#ccc'}"),
				array('animateNumberOver', 'Animation/style hover number', "{backgroundColor:'#000', color:'#fff'}", "{backgroundColor:'#000', color:'#ccc'}"),
				array('animateNumberActive', 'Animation/style active number', "{backgroundColor:'#cc3333', color:'#fff'}", "{backgroundColor:'#000', color:'#ccc'}"),
				array('thumbs', 'Navigation with thumbs', "false", "true"),
				array('hideTools', 'Hide numbers and navigation', "false", "true"),
				array('fullscreen', 'Fullscreen mode', "false", "true"),
				array('xml', 'Loading data from XML file', "false", "xml/slides.xml"),
				array('dots', 'Navigation with dots', "false", "true"),
				array('width_label', 'Width label', "null", "300px"),
			);
			
			foreach($data as $linha) {
			
			?>
			
			<tr valign="top">
				<th scope="row"><?=$linha[0];?></th>
				<td>
					<?php
					
					if ($linha[3] == 'true' || $linha[3] == 'false') {
						
						$selected = (get_option('wp_skitter_'.$linha[0]) == 'true' ? ' checked="checked"' : '');
						
					?>
					<input type="checkbox" value="true" name="wp_skitter_<?=$linha[0];?>" <?php echo $selected;?> />
					<?php
						
					}
					else {
					
					?>
					<input type="text" name="wp_skitter_<?=$linha[0];?>" id="wp_skitter_<?=$linha[0];?>" size="20" value="<?php echo get_option('wp_skitter_'.$linha[0]); ?>" />
					<?php
					
					}
					
					?>
				</td>
			</tr>
	
			<tr valign="top">
				<td scope="row" style="padding-left:20px;">Default: <strong><?=$linha[2];?></strong></td>
				<td>Example: <strong><?=$linha[3];?></strong></td>
			</tr>
			
			<?php
			
			}
			
			?>
		
		</table>
	 
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>

<?php } ?>
