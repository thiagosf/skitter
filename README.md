# Skitter - Slideshow for anytime!

With 38 different animations, two types of navigation and many options to customize!

License: Dual licensed under the MIT or GPL Version 2 

## Bower support 

`bower install skitter-slideshow --save`

## How to install

### Add the CSS and JS files inside <head>

```html
<link type="text/css" href="css/skitter.styles.min.css" media="all" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
```

### Init the Skitter

```javascript
$(document).ready(function() {
  $(".box_skitter_large").skitter();
});
```

### Add the images through the unordered list

```html
<div class="box_skitter box_skitter_large">
  <ul>
    <li>
      <a href="#cut"><img src="images/001.jpg" class="cut" /></a>
      <div class="label_text"><p>cut</p></div>
    </li>
    <li>
      <a href="#swapBlocks"><img src="images/002.jpg" class="swapBlocks" /></a>
      <div class="label_text"><p>swapBlocks</p></div>
    </li>
    <li>
      <a href="#swapBarsBack"><img src="images/003.jpg" class="swapBarsBack" /></a>
      <div class="label_text"><p>swapBarsBack</p></div>
    </li>
  </ul>
</div>
```