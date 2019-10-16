$(function() {
  $("#city").autocomplete({
    source: function(request,response) {
      $.ajax({
        url: "http://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
        dataType: "jsonp",
        data: {
        	q: function () { return $("#city").val() },
        	name_startsWith: function () { return $("#city").val() }
        },
        success: function(data) {
          response($.map(data.geonames, function(item) {
            return {
              label: item.name,
              value: item.name,
              id: item.id
            }
          }));
        }
      });
    },
    minLength: 1,
    select: function(event,ui) {
    	//console.log("Yep!");
    	var town = ui.item.value.split(',');
    	town = town[0];
    	$('.b span').html(town);
    	$('.select-c h4').html(town);
      $('#cityid').val(ui.item.id);
    	$('#cityname').val(town);
    }
  });
  
});
$('.city-no').on('click', function() {
  $('#select-city').modal('hide');
  $('#select-c').modal('show');
});
/*$(document).ready(function(){

    ymaps.ready(function(){

        var geolocation = ymaps.geolocation;
        $('.select-city').html(geolocation.city);
        setTimeout(func, 3000);
        //console.log(geolocation);
        function func() {
            $('#select-city').modal('show');
        }
    });

});*/




