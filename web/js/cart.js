// клики на +- в корзине

	plusMinus();

	plusMinusMain();

// общая стоимость товаров в строке
    priceRow();

// итоговая сумма в корзине / оформлении, в т.ч. с доставкой (в оформлении)
	totalPriceCart();






// Ajax
	$('.add-to-cart').click(function( event ){
		var quan = $(this).parents('.product-on').find('.item-product b').html();
		var product = $(this).attr("data-product");
		var url = $(this).attr("href");
		$.get(url, {
			id: product,
			quan: quan,

		}, function(data) {
			data = JSON.parse(data);
			printDataToCart(data['count'], data['summa']);
			changeCartClass();
			addProductClass(data['product']);

		});
		$(this).attr("href", '/site/cart');
		return false;
	});
	$('.add-item-to-cart').on('click', function() {
		var item = $('.item-cart').html();
		//alert(item); return false;
		var product = $(this).attr("data-product");
		var url = $(this).attr("href");
		$.get(url, {
			id: product,
			item: item,
		}, function(data) {
			data = JSON.parse(data);
			$(".product-cart").html(data['count']);
			$(".price-cart").html(data['summa']);
			$(".body").html(data['message']);
			changeCartClass();
			$(".buy-product[data-product=" + data['product'] + "]").addClass("product-in-cart").html("Купить");
		});
		return false;
	});
	$('.checkout').on('click', function() {
		$(".cart-tr").each(function() {
			var id = $(this).find("span.product-id").html();
			
			var count = $(this).find(".count-product b").html();
			
			var url = $('.checkout').attr("href");
			$.get(url, {
				id: id,
				count: count,
			});
			
		});
		//return false;
	});
	$('.trashcan').on('click', function() {
		var a = $(this).parent('.delete-product');
		var productId = a.attr('data-product-id');
		var url = a.attr("href");
		var action = 'delete';
		$.get(url, {
			id: productId,
			action: action,
		}, function(data) {
			data = JSON.parse(data);
			printDataToCart(data['count'], data['summa']);
			$("tr[data-product=" + data['id'] + "]").remove();
			changeCartClass();
			removeProductClass(data['id']);
			totalPriceCart();
		});
			
		return false;
	});
	
	
	$('.callback-window').on('click', function() {
		$('#form-c').modal('show');
		return false;
	});
	$('.p').on('click', function() {
		$('#privat').modal('show');
		return false;
	});
	$(".phone").inputmask({"mask": "+7 (999) 999-9999"});
	$('.one-click').on('click', function() {
		$('#one-click').modal('show');
		return false;
	});
    $(document).on("submit", "form.send-data", function (e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
            	console.log(response);
                if($('.modal.fade').is(':visible')) $('.modal.fade').modal("fade");
                $('#thank-you').modal('show');
            },
            error: function () {
                alert('Произошла ошибка отправки, попробуйте позднее');
            }
        });
        return false;
    });
    $(document).on("submit", "form.send-cart", function (e) {
    	var form = $(this);
        var formData = form.serialize();
        var products = [];
		var count = 0;
    	$('span.product-id').each(function() {
			products[count] = $(this).html();
			count++;
		});
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: products.serialize(),
            success: function (response) {
                if($('#form-c').is(':visible')) $('#form-c').modal("fade");
                $('#thank-you').modal('show');
            },
            error: function () {
                alert('Произошла ошибка отправки, попробуйте позднее');
            }
        });
        return false;





  
    });
    
// Добавление / уменьшение количества одного товара Ajax
   // $('.count-product a').on('click', function() {
    	/*var count = parseInt($(this).parents('.count-product').find('b').html());
    	var price = parseInt($(this).parents('.cart-tr').find('.now-price i').html());
    	alert(count);
    	alert(price);*/


   // 	return false;
   // });















	changeCartClass();
	totalPriceCart();

