(function($) {

  $('#reset').on('click', function(){
      $('#register-form').reset();
  });

})(jQuery);

$('#cse').click(function(){
	$.ajax({
		url: 'displayajax.php',
		type: 'post',
		success:function(responsedata){
			$('#response').html(responsedata);
		}
	});
});