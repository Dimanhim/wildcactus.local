$(document).ready(function() {
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
    document.getElementById('testArea').innerHTML = 'Отправляемые данные: <br />' + JSON.stringify(formData, null, '\t');
    $.ajax({
        url : 'http://api.cdek.ru/calculator/calculate_price_by_jsonp.php',
        jsonp : 'callback',
        data : {
            "json" : formDataJson
        },
        type : 'GET',
        dataType : "jsonp",
        success : function(data) {
            console.log(data);
            if(data.hasOwnProperty("result")) {
                document.getElementById('resArea').innerHTML = 'Цена доставки: ' + data.result.price + '<br />Срок доставки: ' + data.result.deliveryPeriodMin + ' - ' + data.result.deliveryPeriodMax + 'дн. ' + '<br />Планируемая дата доставки: c ' + data.result.deliveryDateMin + ' по ' + data.result.deliveryDateMax + '<br />id тарифа, по которому произведён расчёт: ' + data.result.tariffId + '<br />';
                if(data.result.hasOwnProperty("cashOnDelivery")) {
                    document.getElementById('resArea').innerHTML = document.getElementById('resArea').innerHTML + 'Ограничение оплаты наличными, от (руб): ' + data.result.cashOnDelivery;
                }
            } else {
                for(var key in data["error"]) {
                    // console.log(key);
                    // console.log(data["error"][key]);
                    document.getElementById('resArea').innerHTML = document.getElementById('resArea').innerHTML+'Код ошибки: ' + data["error"][key].code + '<br />Текст ошибки: ' + data["error"][key].text + '<br /><br />';
                }
            }
        }
    });
});