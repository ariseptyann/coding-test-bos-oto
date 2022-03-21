$(document).ready(function () {
  $('.logout-link').click(function(e){
    e.preventDefault();
    $('#form-logout').submit();
  })
});