$(document).ready(function()
{
  $('#search_keywords').focus(function() {
    if (!this.hasAttribute('data-original')) {
      this.setAttribute('data-original', this.value);
      this.value = '';
    }
    if (this.value == this.getAttribute('data-original')) {
      this.value = '';
    }
  });
  $('#search_keywords').blur(function() {
    if (this.value == '') {
      this.value = this.getAttribute('data-original');
    }
  });
  $('#search_keywords').keyup(function(key)
  {
    if (this.value.length >= 3 || this.value == '')
    {
      $('#search button').hide();
      $('#loader').show();
      $('#main-content').load(
        $(this).parents('form').attr('action'),
        { query: this.value + '*' },
        function() {
          $('#loader').hide();
          $('#search button').show();
        }
      );
    }
  });
});
