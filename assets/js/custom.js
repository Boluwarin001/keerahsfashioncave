
const base_url = "api/";

// function getProducts(){

// 	options = {};

// 	$.post(base_url + "get-products.php?count=8", options, function(response){
// 		console.log(response);
// 		$("#index-products").html(response);

// 	})
// }

function add_to_cart(e, get_qty=false){
	qty=1;
	if (get_qty!==false) {
		qty = $('#qty').val();
	}

	options = {
		id:e,
		qty:qty,
	};
	$.post(
		base_url + "add_to_cart.php",
		options,
		function(response){
			$('.product'+e).html("<i class='fa fa-check-circle'></i> Added to Cart");
			$('.product'+e).addClass('added-to-cart');

			$('.header-action-num').html(
				parseInt($('.header-action-num').html()) + parseInt(qty)
			);

			console.log($('.header-action-num').html());
		}
	)
	return 1;
}


function getCart(){
	options = {
	};
	$.post(
		base_url + "get-cart-header.php",
		options,
		function(response){
			$('.offcanvas-cart-content').html(response);
			// console.log(response);
		}
	)

}

function deleteFromCart(e, qty=1, cart_page=false, price=0){
	options = {
		id:e
	};
	$.post(
		base_url + "remove-cart.php",
		options,
		function(response){
			$('.header-action-num').html(
				parseInt($('.header-action-num').html()) - parseInt(qty)
			);
			getCart();

			if (cart_page!==false) {
				sub_total = sub_total - parseInt(qty)*price;
				$('#sub_total').html(sub_total);	
				 $('.product'+e).hide();
				 total = sub_total + shipping_fee;
				 if (sub_total==0) {
				 	$('#shipping_fee').html('0');
				 	$('#checkout_proceed').prop('disabled', true);
				 	total = 0;
				 }
				 	$('#total').html(total);
			}
			
		}
	)

}

function changeShippingFee(){
	
}
// getProducts();