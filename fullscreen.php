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
);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Skitter - Slideshow for anytime!</title>
	
	<meta name="description" content="Slideshow flexible with many options for customizations. Distributed under the GPL license" />
	<meta name="keywords" content="slides, slide, slideshow, gallery, images, effects, easing, transitions, jquery, plugin, gpl license, free, customizations, flexible" />
	<meta name="author" content="Thiago S.F. - http://thiagosf.net" />
	
	<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	
	<script src="js/jquery-1.6.3.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.animate-colors-min.js"></script>
	<script src="js/jquery.skitter.min.js"></script>
	
	<script>
	$(document).ready(function(){
		
		// Skitter Tester
		$('.box_skitter_large').skitter({fullscreen:true});
		
	});
	</script>
</head>
<body style="margin:0;padding:0">
	<div id="content" style="margin:0;padding:0">
		<div class="border_box" style="margin:0;padding:0">
			<div class="box_skitter box_skitter_large" style="margin:0;padding:0">
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						$image = str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
						$out .= '<li>';
						$out .= sprintf('<a href="#%s"><img src="images/%s.jpg" class="%s" /></a>', $animation, $image, $animation);
						$out .= '<div class="label_text">';
						$out .= sprintf('<p>%s</p>', $animation);
						$out .= '</div>';
						$out .= '</li>';
					}
					
					echo $out;
					
					?>
				</ul>
			</div>
		</div>
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
</body>
</html>