<script>
	jQuery('.edit_button a img').on('click', function() {
        jQuery(this).parent('a').parent('td').parent('tr').children('td.edit').children('span.edit_span').css('display', 'none');
        jQuery(this).parent('a').parent('td').parent('tr').children('td.edit').children('span.edit_form').css('display', 'block');
        jQuery(this).css('display', 'none');
        return false;
    });
    jQuery('.delete').on('click', function() {
        if(!confirm("Вы уверены, что хотите удалить действие?")) return false;
    });
    jQuery('.drop_date').on('click', function() {
        if(!confirm("Вы уверены, что хотите сбросить даты по умолчанию?")) return false;
    });
    jQuery('.delete-button').on('click', function() {
        if(!confirm("Вы уверены, что хотите удалить?")) return false;
    });
    jQuery('option').each(function() {
		var html = jQuery(this).html();
    	if(html.length == 1) {
    		html = "0" + html;
    		jQuery(this).html(html);
    	} 
    });
</script>
<script>
    /*$(".success_message").removeClass('false_message').html('Произошла ошибка сохранения, попробуйте позднее');
    setTimeout(
      function() 
      {
        $(".success_message").addClass('false_message').html('');
      }, 10000);*/
</script>