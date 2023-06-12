<?php 
	require "../inc/conn.php";

	// echo "<pre>";


	if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
		$cart_cookie = $_COOKIE['cart'];
	}else{
		$cart_cookie = uniqid();
    	$exppp=time()+3000000;
      	setcookie('cart', $cart_cookie, "$exppp", '/');
	}

	$sql = mysqli_query($conn, "SELECT * FROM cart WHERE cookie='$cart_cookie'");
	$product = array();


	while ($x=mysqli_fetch_assoc($sql)) {
		$product[]=$x;
	}


 ?>


                    <!-- Offcanvas Cart Title Start -->
                    <h2 class="offcanvas-cart-title mb-10">Shopping Cart</h2>
                    <!-- Offcanvas Cart Title End -->

                    <!-- Cart Product/Price Start -->
                    <?php 

                    	$total = 0;

                    	foreach ($product as $p) {
                    		$id = $p['item_id'];
                    		$qty = $p['qty'];

                    		$item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));


						if (file_exists("../assets/images/product-images/$id-1.jpg")) {
							$img = "$id-1.jpg";
						}else if (file_exists("../assets/images/product-images/$id-1.png")) {
							$img = "$id-1.png";
						}else{
							$img = "default.jpg";
						}

						$total+=$item['price']*$qty;


                     ?>
                    <div class="cart-product-wrapper mb-6" id="cart<?php echo $id;?>">

                        <!-- Single Cart Product Start -->
                        <div class="single-cart-product">
                            <div class="cart-product-thumb">
                                <a href="product.php?id=<?php echo $id; ?>"><img src="assets/images/product-images/<?php echo $img;?>" alt="Cart Product"></a>
                            </div>
                            <div class="cart-product-content">
                                <h3 class="title"><a href="product.php?id=<?php echo $id; ?>"><?php echo $item['name']; ?>(<?php echo $qty; ?>)</a></h3>
                                <span class="price">
                                <span class="new">$<?php echo number_format($item['price']); ?></span>
                                <span class="old">$<?php echo number_format($item['old_price']); ?></span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Cart Product End -->

                        <!-- Product Remove Start -->
                        <div class="cart-product-remove" onclick="deleteFromCart(<?php echo $p['id'];?>, <?php echo $qty;?>)">
                            <a><i class="fa fa-trash"></i></a>
                        </div>
                        <!-- Product Remove End -->

                    </div>
                    <!-- Cart Product/Price End -->

                <?php } ?>

                    <!-- Cart Product Total Start -->
                    <div class="cart-product-total">
                        <span class="value">Subtotal</span>
                        <span class="price">$<?php echo number_format($total); ?></span>
                    </div>
                    <!-- Cart Product Total End -->

                    <!-- Cart Product Button Start -->
                    <div class="cart-product-btn mt-4">
                        <a href="cart.php" class="btn btn-dark btn-hover-primary rounded-0 w-100">View cart</a>
                        <a href="checkout.php" class="btn btn-dark btn-hover-primary rounded-0 w-100 mt-4">Checkout</a>
                    </div>
                    <!-- Cart Product Button End -->