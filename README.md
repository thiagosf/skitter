# Skitter - Slideshow for anytime!

Skitter has 38 different animations, two types of navigations and many options to customize!

License: Dual licensed under the MIT or GPL Version 2 

## NPM

`npm install skitter-slider`

## Bower 

`bower install skitter --save`

## Manually

Download zip [https://github.com/thiagosf/skitter/archive/master.zip](https://github.com/thiagosf/skitter/archive/master.zip) and move files in `dist` directory for you application. Attention: you need to download the dependencies manually.

## How to install

### Add the CSS and JS files inside <head>

```html
<link type="text/css" href="dist/skitter.css" media="all" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="dist/jquery.skitter.min.js"></script>
```

### Init the Skitter

```javascript
$(document).ready(function() {
  $(".skitter-large").skitter();
});
```

### Add the images through the unordered list

```html
<div class="skitter skitter-large">
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

## Todo

- [ ] Update WP-Plugin
- [ ] Update CakePHP Plugin
- [x] Refactor variable names applying a pattern.
- [ ] Separate into small pieces the source code.
- [ ] Create unit tests
- [ ] Exchange images for background divs (for animations)
