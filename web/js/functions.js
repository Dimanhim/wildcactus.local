// добавление и удаление красных обводок в корзине (в зависимости от наличия товаров)
	function changeCartClass() {
		var quan = Number($('.product-cart').html());
		var quanCart = Number($('.price-cart').html());
		if(quan != 0) {
			$('.product-cart').addClass("active-cart");
		}
		else {
			$('.product-cart').removeClass("active-cart");
		}
		if(quanCart != 0) {
			$('.price-cart').addClass("active-cart");
		}
		else {
			$('.price-cart').removeClass("active-cart");
		}
	}
/*function getTotalPriceInCart()
{
	var totalPrice = 0;
	$(".cart-tr").each(function() {
		var price = $(this).find(".total-price-cart i").html();
		var count = $(this).find(".count-product b").html();
		totalPrice = totalPrice + price*count;
		$(".total-price i").html(totalPrice);
	});
}*/

// итоговая сумма в корзине / оформлении, в т.ч. с доставкой (в оформлении)
	function totalPriceCart()
	{
		var total = 0;
		$(".total-price-cart").each(function(){
			total = total + parseInt($(this).text());
		});
		

		if ($("div").is(".ordering-info-total")) {
			// оформление заказа
			var priceDev = parseInt($(".price-dev").text()); // цена доставки

			$(".total-ch").html(returnNan(total));

			$(".topay").html(returnNan(String(total + priceDev)));

			$("#amount").val(returnNan(String(total + priceDev)));
			//$("#amount").val('50');
		} else {
			// корзина
			$(".total-price b i").html(returnNan(total));
		}
	}
function returnNan(number) {
	if(number === 'NaN') return '';
	else return number;
}
function printDataToCart(count, summa)
{
	$(".product-cart").html(count);
	$(".price-cart").html(summa);
}
function addProductClass(product)
{
	$(".buy-product[data-product=" + product + "]").addClass("product-in-cart").html("Купить");
}
function removeProductClass(product)
{
	$(".buy-product[data-product=" + product + "]").removeClass("product-in-cart").html("В корзину");
}

//--------------------- КЛИК НА КНОПКУ + ИЛИ - -------------------------------------
function plusMinus()
{
	$('.count-product a span').on('click', function() {
	//количество редактируемого товара
		
		var b = $(this).parents('.count-product').find('b');
    	var count = parseInt(b.html());
		
    // цена редактируемого товара
    	if($('tr').is('.cart-tr')) {
    		var price = parseInt($(this).parents('.cart-tr').find('.now-price i').html());
    	}
    	else if($('div').is('.page-product-info')) {
    		var price = parseInt($(this).parents('.page-product-info').find('.price-product-page').html());
    	}
    	
    	if ($(this).hasClass("plus")) {
    		$('.cart-message').html('Добавлено');
    		$('.cart-message').fadeIn();
    		count = ++count;
    		$('.cart-message').fadeOut(2000);
    	}
		else {
			if(count != 1)
			{
				$('.cart-message').html('Уменьшено');
				$('.cart-message').fadeIn();
				count = --count;
				$('.cart-message').fadeOut(2000);	
			}
			else return false;
			
		}
		if (count === 0) return false;
		b.text(count);
	
	    if($('tr').is('.cart-tr')) {
	    	// общая стоимость товаров в строке
	    	priceRow();
	    	// общая стоимость товаров в корзине
	    	totalPriceCart();
	    }
    
    	

// Ajax запрос на изменение ----------------------------------
		var quan = $(this).parents('.product-on').find('.item-product b').html();
		var url = $(this).parent().attr('href');
		var product = $(this).parent().attr('data-product');
		var action = 'change';
		//alert(product);
    	$.get(url, {
			id: product,
			count: count,
			action: action,
			quan: quan,
		}, function(data) {
			data = JSON.parse(data);
			printDataToCart(data['count'], data['summa']);
		});
// -----------------------------------------------------------
   		return false;
   });
}
function plusMinusMain()
{
	$('.item-product a span').on('click', function() {
	//количество редактируемого товара
		
		var b = $(this).parents('.item-product').find('b');
    	var count = parseInt(b.html());
    	
    	if ($(this).hasClass("plus")) {
    		$('.cart-message').html('Добавлено');
    		$('.cart-message').fadeIn();
    		count = ++count;
    		$('.cart-message').fadeOut(2000);
    	}
		else {
			if(count != 1)
			{
				$('.cart-message').html('Уменьшено');
				$('.cart-message').fadeIn();
				count = --count;
				$('.cart-message').fadeOut(2000);	
			}
			else return false;
			
		}
		if (count === 0) return false;
		b.text(count);

   		return false;
   });
}
function priceRow()
{
	$('.cart-tr').each(function() {
		var total = 0;
		var count = parseInt($(this).find('.count-product b').html());
    	var price = parseInt($(this).find('.now-price i').html());
    	total = count * price;
    	$(this).find('.total-price-cart i').html(total);
	});	
}
