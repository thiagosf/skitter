<?php

$animations = array(
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
	'random', 
	'randomSmart', 
);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Skitter - Slideshow for anytime!</title>
	
	<meta name="description" content="Slideshow flexible with many options for customizations. This jQuery Slideshow is free!" />
	<meta name="keywords" content="jquery slideshow, slides, slide, slideshow, gallery, images, effects, easing, transitions, jquery, plugin, gpl license, free, customizations, flexible" />
	<meta name="author" content="Thiago S.F. - http://thiagosf.net" />
	
	<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
	
	<script src="js/jquery-1.6.3.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.animate-colors-min.js"></script>
	
	<script src="js/jquery.skitter.min.js"></script>
	<script src="js/highlight.js"></script>
	<script src="js/sexy-bookmarks-public.js"></script>
	
	<script>
	$(document).ready(function(){
		
		$('.box_skitter_large').skitter({label: false, numbers: false});
		$('.box_skitter_small').skitter({label: false, numbers: false, interval: 1000});
		$('.box_skitter_medium').css({width: 500, height: 200}).skitter({show_randomly: true, navigation: false, dots: true, interval: 4000});
		$('.box_skitter_normal').css({width: 400, height: 300}).skitter({animation: 'blind', interval: 2000, hideTools: true});
		
		// Highlight
		$('pre.code').highlight({source:1, zebra:1, indent:'space', list:'ol'});
		
	});
	</script>
</head>
<body>
<div id="page">
	<div id="header">
		<h1><a href="index.php">Skitter</a></h1>
		<p>Slideshow for anytime!</p>
	</div>
	
	<div id="content">
		<div class="border_box">
			<div class="box_skitter box_skitter_large">
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						if ($i > 0 && $i < 5) {
							$image = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
							$out .= '<li>';
							$out .= sprintf('<a href="#%s"><img src="images/%s.jpg" class="%s" /></a>', $animation, $image, $animation);
							$out .= '<div class="label_text">';
							$out .= sprintf('<p>%s</p>', $animation);
							$out .= '</div>';
							$out .= '</li>';
						}
					}
					echo $out;
					
					?>
				</ul>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="border_box">
			<div class="box_skitter box_skitter_small">
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						if ($i > 5 && $i < 8) {
							$image = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
							$out .= '<li>';
							$out .= sprintf('<a href="#%s"><img src="images/%s.jpg" class="%s" /></a>', $animation, $image, $animation);
							$out .= '<div class="label_text">';
							$out .= sprintf('<p>%s</p>', $animation);
							$out .= '</div>';
							$out .= '</li>';
						}
					}
					echo $out;
					
					?>
				</ul>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
		<div class="border_box" style="margin-bottom:45px;">
			<div class="box_skitter box_skitter_medium">
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						if ($i > 10 && $i < 14) {
							$image = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
							$out .= '<li>';
							$out .= sprintf('<a href="#%s"><img src="images/%s.jpg" class="%s" /></a>', $animation, $image, $animation);
							$out .= '<div class="label_text">';
							$out .= sprintf('<p>%s</p>', $animation);
							$out .= '</div>';
							$out .= '</li>';
						}
					}
					echo $out;
					
					?>
				</ul>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
		<div class="border_box">
			<div class="box_skitter box_skitter_normal">
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						if ($i > 15 && $i < 22) {
							$image = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
							$out .= '<li>';
							$out .= sprintf('<a href="#%s"><img src="images/%s.jpg" class="%s" /></a>', $animation, $image, $animation);
							$out .= '<div class="label_text">';
							$out .= sprintf('<p>%s</p>', $animation);
							$out .= '</div>';
							$out .= '</li>';
						}
					}
					echo $out;
					
					?>
				</ul>
			</div>
		</div>
	</div>
		
	
	<div id="footer">
		<p>Thiago S.F.</p>
		<p><a href="http://thiagosf.net">thiagosf.net</a></p>
	</div>
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-1966000-13']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

</div>
</body>
</html>