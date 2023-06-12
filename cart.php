<?php require "header.php";?>



<?php 



    if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
        $cart_cookie = $_COOKIE['cart'];
    }else{
        $cart_cookie = uniqid();
        $exppp=time()+30000;
        setcookie('cart', $cart_cookie, "$exppp", '/');
    }

    $sql = mysqli_query($conn, "SELECT * FROM cart WHERE cookie='$cart_cookie'");
    $product = array();


    while ($x=mysqli_fetch_assoc($sql)) {
        $product[]=$x;
    }


     ?>

    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Shopping Cart</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-12">

                    <!-- Cart Table Start -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">

                            <!-- Table Head Start -->
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>

                    <?php 

                        $total = 0;

                        foreach ($product as $p) {
                            $id = $p['item_id'];
                            $qty = $p['qty'];

                            $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));


                        if (file_exists("assets/images/product-images/$id-1.jpg")) {
                            $img = "$id-1.jpg";
                        }else if (file_exists("assets/images/product-images/$id-1.png")) {
                            $img = "$id-1.png";
                        }else{
                            $img = "default.jpg";
                        }

                        $total+=$item['price']*$qty;
                        ?>
                                <tr class="product<?php echo $p['id'];?>">
                                    <td class="pro-thumbnail"><a href="product.php?id=<?php echo $item['id'];?>"><img class="img-fluid" width="100px" src="assets/images/product-images/<?php echo $img; ?>" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#"><?php echo $item['name']; ?></a></td>
                                    <td class="pro-price"><span>$<?php echo number_format($item['price']);?></span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <?php echo $qty; ?>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>$<?php echo number_format($item['price']*$qty); ?></span></td>
                                    <td class="pro-remove"><a onclick="deleteFromCart(<?php echo $p['id'].','.$qty;?>, true, <?php echo $item['price']; ?>);"><i class="pe-7s-trash"></i></a></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                            <!-- Table Body End -->

                        </table>
                    </div>
                    <!-- Cart Table End -->


                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 ms-auto col-custom">

                    <!-- Cart Calculation Area Start -->
                    <div class="cart-calculator-wrapper">

                        <!-- Cart Calculate Items Start -->
                        <div class="cart-calculate-items">

                            <!-- Cart Calculate Items Title Start -->
                            <h3 class="title">Cart Totals</h3>
                            <!-- Cart Calculate Items Title End -->

                            <!-- Responsive Table Start -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>$ <span id="sub_total"><?php echo number_format($total);?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$<span id="shipping_fee">
                                            <?php echo $total==0 ? '0' : '2,000'; ?></span></td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">$ <span id="total"><?php echo $total !== 0 ? number_format($total+$shipping_fee) : '0';?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Responsive Table End -->

                        </div>
                        <!-- Cart Calculate Items End -->

                        <!-- Cart Checktout Button Start -->
                        <button id="checkout_proceed" <?php echo $total==0 ? 'disabled' : ''; ?> class="btn btn-dark btn-hover-primary rounded-0 w-100"><a href="checkout.php" style="color: inherit;">Proceed To Checkout</a></button>
                        <!-- Cart Checktout Button End -->

                    </div>
                    <!-- Cart Calculation Area End -->

                </div>
            </div>

        </div>
    </div>
    <!-- Shopping Cart Section End -->


    <script type="text/javascript">
        var sub_total = <?php echo $total; ?>;
        var shipping_fee = <?php echo $shipping_fee; ?>;
    </script>


<?php require "footer.php";  ?>