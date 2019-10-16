$(function() {
    //alert('lkn');
    $("#city").autocomplete({
        source : function(request, response) {
            $.ajax({
                url : "https://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
                dataType : "jsonp",
                data : {
                    q : function() {
                        return $("#city").val()
                    },
                    name_startsWith : function() {
                        return $("#city").val()
                    }
                },
                success : function(data) {
                    response($.map(data.geonames, function(item) {
                        return {
                            label : item.name,
                            value : item.name,
                            id : item.id
                        }
                    }));
                }
            });
        },
        minLength : 1,
        select : function(event, ui) {
            $('#receiverCityId').val(ui.item.id);
        }
    });

    /**
     * ajax-запрос на сервер для получения информации по доставке
     */
    $('#cdek').submit(function() {
        var formData = form2js('cdek', '.', true, function(node) {
            if(node.id && node.id.match(/callbackTest/)) {
                return {
                    name : node.id,
                    value : node.innerHTML
                };
            }
        });

        var formDataJson = JSON.stringify(formData);
        // console.log(JSON.stringify(formData));
        //alert('lkn');
        //document.getElementById('testArea').innerHTML = 'Отправляемые данные: <br />' + JSON.stringify(formData, null, '\t');
        totalPriceCart();
        $.ajax({
            url : 'https://api.cdek.ru/calculator/calculate_price_by_jsonp.php',
            jsonp : 'callback',
            data : {
                "json" : formDataJson
            },
            type : 'GET',
            dataType : "jsonp",
            success : function(data) {
                //console.log(data);
                if(data.hasOwnProperty("result")) {

                    //console.log("Yep!");
                    var value = Math.ceil(Number(data.result.price) / 100) * 100;

                    document.getElementById('price-dev').innerHTML = value;
                    totalPriceCart();
                    /*if(data.result.hasOwnProperty("cashOnDelivery")) {
                        document.getElementById('resArea').innerHTML = document.getElementById('resArea').innerHTML + 'Ограничение оплаты наличными, от (руб): ' + data.result.cashOnDelivery;
                    }*/
                } else {
                    for(var key in data["error"]) {
                        // console.log(key);
                        // console.log(data["error"][key]);
                        //document.getElementById('resArea').innerHTML = document.getElementById('resArea').innerHTML+'Код ошибки: ' + data["error"][key].code + '<br />Текст ошибки: ' + data["error"][key].text + '<br /><br />';
                    }
                }
            }
        });
        $('#description').val($('#city').val());
        return false;
    });
});

$('#mail').submit(function() {
    
    var url = '/web/js/calc.php';
    var id = $('#city-mail').val();
    $.get(url, {
        id: id,
    }, function(data) {
        number = JSON.parse(data);
        $('.price-dev').html(number);
        totalPriceCart();
    });
    $('#description').val($('#city-mail').val());
    return false;
});