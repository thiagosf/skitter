<?php

session_start();

function getLinkAnimation($animation) {
	return '<a href="?animation='.$animation.'">'.$animation.'</a>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Skitter - Slideshow for anytime!</title>
	
	<meta name="description" content="Slideshow flexible with many options for customizations. Distributed under the GPL license" />
	<meta name="keywords" content="slides, slide, slideshow, gallery, images, effects, easing, transitions, jquery, plugin, gpl license, free, customizations, flexible" />
	<meta name="author" content="Thiago S.F. - http://thiagosf.net" />
	
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
	
	<script src="js/jquery-1.5.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.skitter.min.js"></script>
	<script src="js/highlight.js"></script>
	<script src="js/sexy-bookmarks-public.js"></script>
	
	<script>
	$(document).ready(function(){
		
		<?php
		
		$mode_xml = false;
		
		// Tipos de navegações
		$_SESSION['type_loading'] = (isset($_SESSION['type_loading'])) ? $_SESSION['type_loading'] : 'html';
		if (isset($_GET['type_loading'])) {
			$_SESSION['other_options'] = 'normal';
			switch($_GET['type_loading']) {
				case 'html' : default : 
					$_SESSION['type_loading'] = 'html';
					break;
				case 'xml' : 
					$_SESSION['type_loading'] = 'xml';
					break;
			}
		}
		
		// Tipos de navegações
		$_SESSION['type_navigation'] = (isset($_SESSION['type_navigation'])) ? $_SESSION['type_navigation'] : 'numbers';
		if (isset($_GET['type_navigation'])) {
			$_SESSION['other_options'] = 'normal';
			switch($_GET['type_navigation']) {
				case 'numbers' : default :  
					$_SESSION['type_navigation'] = 'numbers';
					break;
				case 'thumbs' : 
					$_SESSION['type_navigation'] = 'thumbs';
					break;
				case 'dots' : 
					$_SESSION['type_navigation'] = 'dots';
					break;
			}
		}
		
		// Opções do skitter
		$_SESSION['other_options'] = (isset($_SESSION['other_options'])) ? $_SESSION['other_options'] : 'numbers';
		if (isset($_GET['other_options'])) {
			$_SESSION['type_navigation'] = 'numbers';
			switch($_GET['other_options']) {
				case 'normal' : default :  
					$_SESSION['other_options'] = 'normal';
					break;
				case 'hideTools' : 
					$_SESSION['other_options'] = 'hideTools';
					break;
				case 'mini' : 
					$_SESSION['other_options'] = 'mini';
					break;
			}
		}
		
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
		);
		
		$options = array();
		$view = null;
		
		if (isset($_GET['animation'])) {
			$animation = $_GET['animation'];
			if (in_array($animation, $animations)) {
				$options[] = 'animation: "'.$animation.'"';
			}
		}
		
		if ($_SESSION['type_navigation'] == 'thumbs') {
			$options[] = 'thumbs: true';
		}
		else if ($_SESSION['type_navigation'] == 'dots') {
			echo "$('.border_box').css({'margin-bottom':'35px'});\n\t\t";
			$options[] = 'dots: true';
			$options[] = "animateNumberOut: {backgroundColor:'#555', color:'#fff'}";
			$options[] = "animateNumberOver: {backgroundColor:'#333', color:'#fff'}";
			$options[] = "animateNumberActive: {backgroundColor:'#004499', color:'#fff'}";
		}
		
		if ($_SESSION['other_options'] == 'hideTools') {
			$options[] = 'hideTools: true';
		}
		
		if ($_SESSION['type_loading'] == 'xml') {
			$options[] = 'xml: "xml/slides.xml"';
		}
		
		$options = implode(', ', $options);
		$out     = sprintf("$('.box_skitter_large').skitter({%s});", $options);
		
		if ($_SESSION['other_options'] == 'mini') {
			echo '$(\'.box_skitter_large\').css({\'width\': 400, \'height\': 150});'."\n\t\t";
		}
		
		echo $out;
		
		?>
		
		// Highlight
		$('pre.code').highlight({source:1, zebra:1, indent:'space', list:'ol'});
		
	});
	</script>
</head>
<body>
	<div id="header">
		<h1>Skitter</h1>
		<p>Slideshow for anytime!</p>
	</div>
	
	<div id="content">
		<div class="border_box">
			<div class="box_skitter box_skitter_large">
			<?php if ($_SESSION['type_loading'] != 'xml') { ;?>
				<ul>
					<?php
					
					$out = null;
					foreach($animations as $i => $animation) {
						if ($i == 22) break;
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
			<?php } ;?>
			</div>
		</div>
		
		<div id="examples-animations">
			<div>
				<?php
				
				$class = (!isset($_GET['animation'])) ? 'selected' : '';
				echo sprintf('<a href="?" class="%s">all</a>', $class);
				
				foreach($animations as $animation) {
					$class = (isset($_GET['animation']) && $_GET['animation'] == $animation) ? 'selected' : '';
					echo sprintf('<a href="?animation=%s" class="%s">%s</a>', $animation, $class, $animation);
				}
				
				?>
			</div>
		</div>
		
		<div style="clear:both"></div>
		
		
		<div id="styles_navigation">
			<h2>Type of loading</h2>
			<ul>
				<?php
				
				$types = array(
					array('label' => 'HTML', 'type' => 'html'),
					array('label' => 'XML', 'type' => 'xml', 'options' => '<span class="new">new!</span>'),
				);
				
				foreach($types as $type) {
					$options = (isset($type['options'])) ? $type['options'] : '';
					$class = $_SESSION['type_loading'] == $type['type'] ? 'selected' : '';
					echo sprintf('<li><a href="?type_loading=%s" class="%s">%s</a>%s</li>', $type['type'], $class, $type['label'], $options);
					
				}
				
				?>
			</ul>
		</div>
		
		<div id="styles_navigation">
			<h2>Type of navigation</h2>
			<ul>
				<?php
				
				$types = array(
					array('label' => 'Numbers', 'type' => 'numbers'),
					array('label' => 'Thumbs', 'type' => 'thumbs'),
					array('label' => 'Dots', 'type' => 'dots', 'options' => '<span class="new">new!</span>'),
				);
				
				foreach($types as $type) {
					$options = (isset($type['options'])) ? $type['options'] : '';
					$class = $_SESSION['type_navigation'] == $type['type'] ? 'selected' : '';
					echo sprintf('<li><a href="?type_navigation=%s" class="%s">%s</a>%s</li>', $type['type'], $class, $type['label'], $options);
					
				}
				
				?>
			</ul>
		</div>
		
		<div id="styles_navigation">
			<h2>Other options</h2>
			<ul>
				<?php
				
				$types = array(
					array('label' => 'Normal', 'type' => 'normal'),
					array('label' => 'HideTools', 'type' => 'hideTools'),
					array('label' => 'Fullscreen', 'type' => 'fullscreen', 'link' => 'fullscreen.php'),
				);
				
				foreach($types as $type) {
					$options = (isset($type['options'])) ? $type['options'] : '';
					$class = isset($_SESSION['other_options']) && $_SESSION['other_options'] == $type['type'] ? 'selected' : '';
					if (!isset($type['link'])) {
						echo sprintf('<li><a href="?other_options=%s" class="%s">%s</a>%s</li>', $type['type'], $class, $type['label'], $options);
					}
					else {
						echo sprintf('<li><a href="%s" class="%s">%s</a>%s</li>', $type['link'], $class, $type['label'], $options);
					}
				}
				
				?>
			</ul>
		</div>
		
		<div id="styles_navigation">
			<h2>Other view</h2>
			<ul>
				<?php
				
				$types = array(
					array('label' => 'Mini-slides', 'type' => 'mini'),
				);
				
				foreach($types as $type) {
					$options = (isset($type['options'])) ? $type['options'] : '';
					$class = isset($_SESSION['other_options']) && $_SESSION['other_options'] == $type['type'] ? 'selected' : '';
					if (!isset($type['link'])) {
						echo sprintf('<li><a href="?other_options=%s" class="%s">%s</a>%s</li>', $type['type'], $class, $type['label'], $options);
					}
					else {
						echo sprintf('<li><a href="%s" class="%s">%s</a>%s</li>', $type['link'], $class, $type['label'], $options);
					}
				}
				
				?>
			</ul>
		</div>
		
		<div id="download">
			<a href="https://github.com/thiagosf/SkitterSlideshow" id="botao_download"><img src="images/download-button.png" /></a>
		</div>
		
		<div class="sexy-bookmarks sexy-bookmarks-expand sexy-bookmarks-center sexy-bookmarks-bg-sexy">
			<ul class="socials">
				<li class="sexy-delicious"><a href="http://del.icio.us/post" rel="nofollow" class="external" title="Share this on del.icio.us">Share this on del.icio.us</a></li>
				<li class="sexy-facebook"><a href="http://www.facebook.com/share.php" rel="nofollow" class="external" title="Share this on Facebook">Share this on Facebook</a></li>
				<li class="sexy-digg"><a href="http://digg.com/submit" rel="nofollow" class="external" title="Digg this!">Digg this!</a></li>
				<li class="sexy-twitter"><a href="http://twitter.com/home" rel="nofollow" class="external" title="Tweet This!">Tweet This!</a></li>
				<li class="sexy-twittley"><a href="http://twittley.com/submit/" rel="nofollow" class="external" title="Submit this to Twittley">Submit this to Twittley</a></li>
				
				<li class="sexy-yahoobuzz"><a href="http://buzz.yahoo.com/submit/" rel="nofollow" class="external" title="Buzz up!">Buzz up!</a></li>
				<li class="sexy-myspace"><a href="http://www.myspace.com/Modules/PostTo/Pages/" rel="nofollow" class="external" title="Post this to MySpace">Post this to MySpace</a></li>
				<li class="sexy-google"><a href="http://www.google.com/bookmarks/mark" rel="nofollow" class="external" title="Add this to Google Bookmarks">Add this to Google Bookmarks</a></li>

				<li class="sexy-scriptstyle"><a href="http://scriptandstyle.com/submit" rel="nofollow" class="external" title="Submit this to Script &amp; Style">Submit this to Script &amp; Style</a></li>
				<li class="sexy-reddit"><a href="http://reddit.com/submit" rel="nofollow" class="external" title="Share this on Reddit">Share this on Reddit</a></li>
				<li class="sexy-stumbleupon"><a href="http://www.stumbleupon.com/submit" rel="nofollow" class="external" title="Stumble upon something good? Share it on StumbleUpon">Stumble upon something good? Share it on StumbleUpon</a></li>
				<li class="sexy-mixx"><a href="http://www.mixx.com/submit" rel="nofollow" class="external" title="Share this on Mixx">Share this on Mixx</a></li>

				<li class="sexy-technorati"><a href="http://technorati.com/faves" rel="nofollow" class="external" title="Share this on Technorati">Share this on Technorati</a></li>
				<li class="sexy-blinklist"><a href="http://www.blinklist.com/index.php" rel="nofollow" class="external" title="Share this on Blinklist">Share this on Blinklist</a></li>
				<li class="sexy-diigo"><a href="http://www.diigo.com/post">Post this on Diigo</a></li>
				
				<li class="sexy-designfloat"><a href="http://www.designfloat.com/submit.php" rel="nofollow" class="external" title="Submit this to DesignFloat">Submit this to DesignFloat</a></li>
				<li class="sexy-newsvine"><a href="http://www.newsvine.com/_tools/seed&amp;save" rel="nofollow" class="external" title="Seed this on Newsvine">Seed this on Newsvine</a></li>
				
			</ul>
		</div>
		
		<h2>Updatelog</h2>
		<div id="updatelog">
			<dl>
				<dt>09/05/2011</dt>
					<dd>- Control over the width of the label. <strong>(Hint of Ronny Sherer)</strong></dd>
				<dt>08/05/2011</dt>
					<dd>- <a href="index.php?type_navigation=dots">Navigation with dots</a></dd>
					<dd>- New animation: <?=getLinkAnimation('cubeJelly');?></dd>
					<dd>- Restructuring HTML plugin</dd>
					<dd>- Bug fixed navigation thumbs</dd>
				<dt>07/05/2011</dt>
					<dd>- Added option to load <a href="index.php?type_loading=xml">data via XML</a>.</dd>
				<dt>23/04/2011</dt>
					<dd>- Added <a href="fullscreen.php">fullscreen</a> mode</dd>
				<dt>21/04/2011</dt>
					<dd>- Fixed bug in loading images in IE9</dd>
					<dd>- Update animations: <?=getLinkAnimation('directionTop');?>, <?=getLinkAnimation('directionBottom');?>, <?=getLinkAnimation('directionRight');?>, <?=getLinkAnimation('directionLeft');?> and <?=getLinkAnimation('block');?></dd>
				<dt>20/04/2011</dt>
					<dd>- Update jQuery and jQuery UI</dd>
				<dt>16/01/2011</dt>
					<dd>- New animations: <?=getLinkAnimation('cubeStopRandom');?>, <?=getLinkAnimation('cubeSpread');?></dd>
				<dt>04/01/2011</dt>
					<dd>- Update thumbnail browsing. Now the position of the mouse will move the thumbnails</dd>
					<dd>- Fix the problem with the effects: cubeStop, cubeHide, cubSize.</dd>
				<dt>09/10/2010</dt>
					<dd>- Added the type of thumbnail browsing.</dd>
				<dt>04/08/2010</dt>
					<dd>- Creation of Skitter Slideshow!</dd>
			</dl>
		</div>
		
		
		<h2>Javascript</h2>
		<pre class="code" lang="js">
$(function(){
	$('.box_skitter_large').skitter();
});
</pre>

		<h2>HTML</h2>
		<pre class="code" lang="html">
&lt;div class=&quot;box_skitter box_skitter_large&quot;&gt;
	&lt;ul&gt;
		&lt;li&gt;
			&lt;a href=&quot;http://thiagosf.net&quot;&gt;&lt;img src=&quot;images/01.jpg&quot; class=&quot;block&quot; /&gt;&lt;/a&gt;
			&lt;div class=&quot;label_text&quot;&gt;
				&lt;p&gt;Label&lt;/p&gt;
			&lt;/div&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;http://cakephp.org&quot;&gt;&lt;img src=&quot;images/02.jpg&quot; class=&quot;cube&quot; /&gt;&lt;/a&gt;
			&lt;div class=&quot;label_text&quot;&gt;
				&lt;p&gt;Label&lt;/p&gt;
			&lt;/div&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;http://jquery.com&quot;&gt;&lt;img src=&quot;images/03.jpg&quot; class=&quot;default&quot; /&gt;&lt;/a&gt;
			&lt;div class=&quot;label_text&quot;&gt;
				&lt;p&gt;Label&lt;/p&gt;
			&lt;/div&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
</pre>

		<h2>XML</h2>
		<pre class="code" lang="html">
&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;
&lt;skitter&gt;
	&lt;slide&gt;
		&lt;link&gt;#directionTop&lt;/link&gt;
		&lt;image type=&quot;directionTop&quot;&gt;images/001.jpg&lt;/image&gt;
		&lt;label&gt;&lt;![CDATA[&lt;p&gt;directionTop&lt;/p&gt;]]&gt;&lt;/label&gt;
	&lt;/slide&gt;
	&lt;slide&gt;
		&lt;link&gt;#cubeSize&lt;/link&gt;
		&lt;image type=&quot;cubeSize&quot;&gt;images/002.jpg&lt;/image&gt;
		&lt;label&gt;&lt;![CDATA[&lt;p&gt;cubeSize&lt;/p&gt;]]&gt;&lt;/label&gt;
	&lt;/slide&gt;
	&lt;slide&gt;
		&lt;link&gt;#paralell&lt;/link&gt;
		&lt;image type=&quot;paralell&quot;&gt;images/003.jpg&lt;/image&gt;
		&lt;label&gt;&lt;![CDATA[&lt;p&gt;paralell&lt;/p&gt;]]&gt;&lt;/label&gt;
	&lt;/slide&gt;
&lt;/skitter&gt;
</pre>

		<div id="options">
			<h2>Extend</h2>
			<h3>Options</h3>
			
			
			<table> 
				<thead> 
					<tr> 
						<th>option</th> 
						<th>description</th> 
						<th>default</th> 
						<th>example</th> 
					</tr> 
				</thead> 
				<tbody> 
					<?php
					
					$data = array(
						array('velocity', 'Velocity of animation', '1', "$('.box_skitter_large').skitter({velocity: 2});"),
						array('interval', 'Interval between transitions', '2500', "$('.box_skitter_large').skitter({interval: 3000});"),
						array('animation', 'Default animation', 'null or defined in &lt;a&gt; class', "$('.box_skitter_large').skitter({animation: 'fade'});"),
						array('numbers', 'Numbers display', 'true', "$('.box_skitter_large').skitter({numbers: false});"),
						array('navigation', 'Navigation display', 'true', "$('.box_skitter_large').skitter({navigation: false});"),
						array('label', 'Label display', 'true', "$('.box_skitter_large').skitter({label: false});"),
						array('easing_default', 'Easing default', 'null', "$('.box_skitter_large').skitter({easing_default: 'easeOutBack'});"),
						array('animateNumberOut', 'Animation/style number', "{backgroundColor:'#333', color:'#fff'}", "$('.box_skitter_large').skitter({animateNumberOut: {backgroundColor:'#000', color:'#ccc'}});"),
						array('animateNumberOver', 'Animation/style hover number', "{backgroundColor:'#000', color:'#fff'}", "$('.box_skitter_large').skitter({animateNumberOver: {backgroundColor:'#000', color:'#ccc'}});"),
						array('animateNumberActive', 'Animation/style active number', "{backgroundColor:'#cc3333', color:'#fff'}", "$('.box_skitter_large').skitter({animateNumberActive: {backgroundColor:'#000', color:'#ccc'}});"),
						array('thumbs', 'Navigation with thumbs', "false", "$('.box_skitter_large').skitter({thumbs: true});"),
						array('hideTools', 'Hide numbers and navigation', "false", "$('.box_skitter_large').skitter({hideTools: true});"),
						array('fullscreen', 'Fullscreen mode', "false", "$('.box_skitter_large').skitter({fullscreen: true});"),
						array('xml', 'Loading data from XML file', "false", "$('.box_skitter_large').skitter({xml: \"xml/slides.xml\"});"),
						array('dots', 'Navigation with dots', "false", "$('.box_skitter_large').skitter({dots: true});"),
						array('width_label', 'Width label', "null", "$('.box_skitter_large').skitter({width_label: '300px'});"),
					);
					
					foreach($data as $linha) {
					
					?>
					<tr> 
						<td><?=$linha[0];?></td> 
						<td><?=$linha[1];?></td> 
						<td><?=$linha[2];?></td> 
						<td><span class="code"><?=$linha[3];?></span></td> 
					</tr>
					<?php
					
					}
					
					?>
				</tbody> 
			</table>
			
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

</body>
</html>