$(function() {
  var currentTheme = '';
  $('#change-theme').on('click', 'a', function(e) {
    e.preventDefault();
    var theme = 'skitter-' +  $(this).data('theme')
    $('#change-theme a').removeClass('current');
    $(this).addClass('current');
    $('.skitter-large').removeClass(currentTheme).addClass(theme);
    currentTheme = theme;
  });
});
