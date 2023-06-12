<?php 

require_once "inc/conn.php"; 


function form($e){
    global $user;
   if (logged_in()==true) {
        echo $user[$e];
    } 
} 



if (checkpost(array(
    'country', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'email', 'phone', 'payment_method'), false)) {

    
    $country = post('country');
    $first_name = post('first_name');
    $last_name = post('last_name');
    $address = post('address');
    $city = post('city');
    $state = post('state');
    $zip = post('zip');
    $email = post('email');
    $phone = post('phone');
    $payment_method = post('payment_method');

    $order_notes = post('order_notes', true);
    $company = post('company', true);

    $shipping_fee = getShippingFee($country);


    if ($payment_method=='Bank Transfer' OR $payment_method=='Paystack') {
        # code...
    }else{
        die('Invalid Payment Method');
    }

    if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
    $cart_cookie = $_COOKIE['cart'];


    $sql = mysqli_query($conn, "SELECT item_id, qty FROM cart WHERE cookie='$cart_cookie'");
    $product = array();
    $cart_array = array();


    while ($x=mysqli_fetch_assoc($sql)) {
        $product[]=$x;
    }

    $total = 0;

    foreach ($product as $p) {
        $id = $p['item_id'];
        $qty = $p['qty'];

        $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, price FROM products WHERE id='$id'"));

        $total+=$item['price']*$qty;

        $cart_array[] = array($item['name'], $item['price'], $qty);

        mysqli_query($conn, "UPDATE products SET stock=stock-$qty WHERE id='$id'");
    }

    $cart = json_encode($cart_array);


    $sql = "INSERT INTO orders (`email`, `status`, `total`, `cart`, `shipping`, `payment_method`, `full_name`, `address`, `country`, `company`, `city`, `state`, `zip`, `phone`, `order_notes`) VALUES ('$email', 'Pending', '$total', '$cart', '$shipping_fee', '$payment_method', '$first_name $last_name', '$address', '$country', '$company', '$city', '$state', '$zip', '$phone', '$order_notes')";


    if (mysqli_query($conn, $sql)) {


        // SEND EMAIL



            $mail_to = $email;
            $mail_subject = "KIRIO - Order Summary";

           $mail_header = "From: KIRIO <noreply@kirio.com.ng> \r\n";
           $mail_header .= "MIME-Version: 1.0\r\n";
           $mail_header .= "Content-type: text/html\r\n";

           $cart_message = ""; 

           foreach ($cart_array as $c) {
           $cart_message .= '  <tr style="background-color: #fff;">
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;"><b>'.$c[0].'</b>('.$c[2].')</td>
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;">'.$c[1].'</td>
                    </tr>'; 
           }

           $msg = "
           The following order was made at ".date('d M Y, H:i:a').".
           <br>
           Name: $full_name
           <br>
           Address: $address
           <br>
           Phone: $phone
           <br>
           Email: $email
           <br>
           Payment Method: $payment_method

           ";
 
           $mail_message = '
        <div style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%;">
            <div style="width:90%;max-width:600px;margin:auto">
                <div style="background-color:#333;color:#ffffff;border-bottom:0;
                                            line-height:100%;vertical-align:middle;
                                            font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;
                                            border-radius:3px 3px 0 0;
                                            padding:30px 48px;display:block">
                    <h1 style="font-weight:normal;">Order Summary</h1>
                </div>
                
                <div style="padding:30px 48px;border:1px solid #cfcfcf;background:#fff;color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;">
                <p  style=""> '.$msg.'</p>
                
                <br>
                
                
                
                <table style="border-collapse: collapse;font-family: Tahoma, Geneva, sans-serif;width:100%;">
                '.$cart_message.'
                    
                    <tr style="background-color: #fff;">
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;"><b>Total</b></td>
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;">'.$total.'</td>
                    </tr>
                    
                    
                </table>
                
                
                <br>
                <center>
                <a href="https://kirio.com.ng/my-account.php" style="text-decoration:none;cursor:pointer">
                <button style="color:#fff;background:#439fd0;border:0;padding:8px 20px;border-radius:5px;margin-top:50px">View Order</button>
                </a>
                </div>
                
                <br>
                
            </div>
            
            <center>
            <div style="display:inline-block;margin:auto;text-align:center;color:#888888;
            font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;
            font-size:12px;margin-top:200px">
            KIRIO —</div>
            </center>
        </div>';

                   

        if ($payment_method=='Bank Transfer') {
            setcookie('cart', "", time() - 3600);
            $sql = mysqli_query($conn, "DELETE FROM cart WHERE cookie='$cart_cookie'");
            $retval = mail ($mail_to,$mail_subject,$mail_message,$mail_header);
            $retval = mail ("boluadediran@gmail.com","New Order for keerah",$mail_message,$mail_header);
            header("Location: order.php?id=last");
        }

        elseif ($payment_method == 'Paystack') {
            $_SESSION['temp_email']=$email;
            header("Location: payment-checkout.php?id=last");
        }

            exit();


    }


    }

}


require "header.php"; 


if (logged_in()==true) {
    $shipping_fee = getShippingFee($user['country']);
}


?>

    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Checkout</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Coupon Accordion Start -->
                    <div class="coupon-accordion">

                        <!-- Title Start -->
                        <h3 class="title">Returning customer? <a href="login.php">Click here to login</a></h3>
                        <!-- Title End -->

                        <!-- Checkout Login Start -->
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text mb-2">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>

                                <!-- Form Start -->
                                <form action="#">
                                    <!-- Input Email Start -->
                                    <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text">
                                    </p>
                                    <!-- Input Email End -->

                                    <!-- Input Password Start -->
                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="password">
                                    </p>
                                    <!-- Input Password End -->

                                    <!-- Remember Password Start -->
                                    <p class="form-row mb-2">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me" class="checkbox-label">Remember me</label>
                                    </p>
                                    <!-- Remember Password End -->

                                    <!-- Lost Password Start -->
                                    <p class="lost-password"><a href="#">Lost your password?</a></p>
                                    <!-- Lost Password End -->

                                </form>
                                <!-- Form End -->

                            </div>
                        </div>
                        <!-- Checkout Login End -->


                    </div>
                    <!-- Coupon Accordion End -->
                </div>
            </div>
            <div class="row mb-n4">
                <div class="col-lg-6 col-12 mb-4">

                    <!-- Checkbox Form Start -->
                    <form method="post">
                        <div class="checkbox-form">

                            <!-- Checkbox Form Title Start -->
                            <h3 class="title">Billing Details</h3>
                            <!-- Checkbox Form Title End -->

                            <div class="row">

                                <!-- Select Country Name Start -->
                                <div class="col-md-12 mb-6">
                                    <div class="country-select">
                                        <label>Country <span class="required">*</span></label>

                                        <select id="country" class="myniceselect nice-select wide rounded-0" name="country">
                                            <?php foreach ($shipping_fees as $country => $fee): ?>
                                                <option value="<?php echo $country?>"><?php echo $country.' - '.number_format($fee); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Country Name End -->

                                <!-- First Name Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input placeholder="" name="first_name" type="text" value="<?php form('first_name');?>" required>
                                    </div>
                                </div>
                                <!-- First Name Input End -->

                                <!-- Last Name Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input placeholder="" name="last_name" type="text" value="<?php form('last_name');?>" required>
                                    </div>
                                </div>
                                <!-- Last Name Input End -->

                                <!-- Company Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input placeholder="" type="text" name="company">
                                    </div>
                                </div>
                                <!-- Company Name Input End -->

                                <!-- Address Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Street address" name="address" type="text" value="<?php form('address');?>" required>
                                    </div>
                                </div>
                                <!-- Address Input End -->


                                <!-- Town or City Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" value="<?php form('city');?>" name="city" required>
                                    </div>
                                </div>
                                <!-- Town or City Name Input End -->

                                <!-- State or Country Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input placeholder="" required type="text" name="state" value="<?php form('state');?>">
                                    </div>
                                </div>
                                <!-- State or Country Input End -->

                                <!-- Postcode or Zip Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="zip" value="<?php form('zip');?>">
                                    </div>
                                </div>
                                <!-- Postcode or Zip Input End -->

                                <!-- Email Address Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email" name="email" value="<?php form('email');?>">
                                    </div>
                                </div>
                                <!-- Email Address Input End -->

                                <!-- Phone Number Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="phone" value="<?php form('phone');?>" required>
                                    </div>
                                </div>
                                <!-- Phone Number Input End -->

                                <!-- Order Notes Textarea Start -->
                                <div class="order-notes mt-3 mb-n2">
                                    <div class="checkout-form-list checkout-form-list-2">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. x-large for All Shirts" name="order_notes"></textarea>
                                    </div>
                                </div>
                                <!-- Order Notes Textarea End -->


                            </div>

                        </div>
                    <!-- Checkbox Form End -->

                </div>

                <div class="col-lg-6 col-12 mb-4">

                    <!-- Your Order Area Start -->
                    <div class="your-order-area border">

                        <!-- Title Start -->
                        <h3 class="title">Your order</h3>
                        <!-- Title End -->

                        <!-- Your Order Table Start -->
                        <div class="your-order-table table-responsive">
                            <table class="table">

                                <!-- Table Head Start -->
                                <thead>
                                    <tr class="cart-product-head">
                                        <th class="cart-product-name text-start">Product</th>
                                        <th class="cart-product-total text-end">Total</th>
                                    </tr>
                                </thead>
                                <!-- Table Head End -->
                                <!-- Table Body Start -->
                                <tbody>

                    <?php 


                        if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
                            $cart_cookie = $_COOKIE['cart'];
                        }else{
                            // $cart_cookie = uniqid();
                            // $exppp=time()+30000;
                            // setcookie('cart', $cart_cookie, "$exppp", '/');
                        }

                        $sql = mysqli_query($conn, "SELECT * FROM cart WHERE cookie='$cart_cookie'");
                        $product = array();


                        while ($x=mysqli_fetch_assoc($sql)) {
                            $product[]=$x;
                        }

                        $total = 0;

                        foreach ($product as $p) {
                            $id = $p['item_id'];
                            $qty = $p['qty'];

                            $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));



                        $total+=$item['price']*$qty;

                         ?>

                                    <tr class="cart_item">
                                        <td class="cart-product-name text-start ps-0"> <?php echo $item['name']; ?><strong class="product-quantity"> × <?php echo $qty; ?></strong></td>
                                        <td class="cart-product-total text-end pe-0"><span class="amount">$<?php echo number_format($item['price']*$qty); ?></span></td>
                                    </tr>
                            <?php } ?>


                                </tbody>
                                <!-- Table Body End -->

                                <!-- Table Footer Start -->
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th class="text-start ps-0">Cart Subtotal</th>
                                        <td class="text-end pe-0"><span class="amount">$<?php echo number_format($total);?></span></td>
                                    </tr>

                                    <?php if (logged_in()): ?>
                                        

                                    <tr class="cart_item">
                                        <td class="cart-product-name text-start ps-0"> Shipping Fee<strong id="shipping_country" class="product-quantity"></strong></td>
                                        <td class="cart-product-total text-end pe-0"><span id="shipping_fee" class="amount">$<?php echo number_format($shipping_fee); ?></span></td>
                                    </tr>

                                    <?php endif ?>

                                    <tr class="order-total">
                                        <th class="text-start ps-0">Order Total</th>
                                        <td class="text-end pe-0"><strong><span class="amount">$<?php echo $total !== 0 ? number_format($total+$shipping_fee) : '0';?></span></strong></td>
                                    </tr>
                                </tfoot>
                                <!-- Table Footer End -->

                            </table>
                        </div>
                        <!-- Your Order Table End -->

                        <!-- Payment Accordion Order Button Start -->
                        <div class="payment-accordion-order-button">
                            <div class="payment-accordion">
                                <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <label>
                                            <input type="radio" value="Bank Transfer" name="payment_method">
                                                &nbsp; &nbsp; Direct Bank Transfer.
                                            </label>
                                        </a>
                                    </h5>
                                    <div class="collapse show" id="collapseExample">
                                        <div class="card card-body rounded-0">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample-2" aria-expanded="false" aria-controls="collapseExample-2">
                                        <label>
                                            <input type="radio" value="Paystack" name="payment_method">
                                            &nbsp; &nbsp; Flutterwave Online Payment (Nigeria)
                                        </label>
                                        </a>
                                    </h5>

                                </div>
                                <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample-2" aria-expanded="false" aria-controls="collapseExample-2">
                                        <label>
                                            <input type="radio" value="stripe" name="payment_method">
                                            &nbsp; &nbsp; Stripe (International)
                                        </label>
                                        </a>
                                    </h5>

                                </div>
<!--                                 <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample-3" aria-expanded="false" aria-controls="collapseExample-3">
                                            Paypal.
                                        </a>
                                    </h5>
                                    <div class="collapse" id="collapseExample-3">
                                        <div class="card card-body rounded-0">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="order-button-payment">
                                <button class="btn btn-dark btn-hover-primary rounded-0 w-100" type="submit">Place Order</button>
                            </div>
                        </div>
                        <!-- Payment Accordion Order Button End -->
                    </div>
                    <!-- Your Order Area End -->
                </div>

                    

            </div>
        </div>
    </div>
</form>
    <!-- Checkout Section End -->



<script type="text/javascript">
    // $('#country').on('change', function(){
    //     $.post(
    //         url + 'api/get_shipping_fee.php',
    //         options = {
    //             'country':$('#country').val();
    //         },
    //         function*(fee){

    //         }

    //         )
    // })




</script>

<?php require "footer.php";  ?>