<script>
	$(document).on("submit", "form.send-data", function (e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
                $(".success_message").removeClass('false_message').html('Данные успешно сохранены');
                setTimeout(
				  function() 
				  {
				    $(".success_message").html('');
				  }, 10000);
            },
            error: function () {
                $(".success_message").removeClass('false_message').html('Произошла ошибка сохранения, попробуйте позднее');
                setTimeout(
                  function() 
                  {
                    $(".success_message").addClass('false_message').html('');
                  }, 10000);
            }
        });
        return false;
    });
    $(document).on("submit", "form.send-data-plus", function (e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
                data = JSON.parse(response);
                $(".value[data-product=" + data['id'] + "]").html(data['value']);
                $(".success_message").removeClass('false_message').html('Данные успешно сохранены');
                setTimeout(
                  function() 
                  {
                    $(".success_message").html();
                  }, 2000);
            },
            error: function () {
                $(".success_message").removeClass('false_message').html('Произошла ошибка сохранения, попробуйте позднее');
                setTimeout(
                  function() 
                  {
                    $(".success_message").addClass('false_message').html('');
                  }, 10000);
            }
        });
        return false;
    });
</script>