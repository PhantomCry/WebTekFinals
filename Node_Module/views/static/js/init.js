$(function() {
  'user strict';

  $('.dropdown-trigger').dropdown();
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
  $('select').formSelect();
});