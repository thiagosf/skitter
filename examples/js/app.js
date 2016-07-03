$(function() {
  var currentTheme = '';
  $('#change-theme').on('click', 'a', function(e) {
    e.preventDefault();
    var theme = 'skitter-' +  $(this).data('theme')
    $('#change-theme a').removeClass('active');
    $(this).addClass('active');
    $('.skitter-large').removeClass(currentTheme).addClass(theme);
    currentTheme = theme;
  });

  $('#change-animation').on('click', 'a', function(e) {
    e.preventDefault();
    var animation = $(this).data('animation');
    $('#change-animation a').removeClass('active');
    $(this).addClass('active');
    $('.skitter-large').skitter('setAnimation', animation);
    $('.skitter-large').skitter('next');
  });

  var animations = $('.skitter-large').skitter('getAnimations');
  for (var i in animations) {
    var animation = animations[i];
    var item = '<li><a href="#" data-animation="' + animation + '">' + animation + '</a></li>';
    $('#change-animation ul').append(item);
  }
});
