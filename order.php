<?php 


require_once "inc/conn.php";
$cart_count =get_cart_count();

if (logged_in()==true) {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_info WHERE email='".$_SESSION['email']."'"));
}

if (get('id')) {
    $id = get('id');

    if ($id=='last') {
        $sql = "SELECT * FROM orders WHERE email = '".$user['email']."' ORDER BY id DESC LIMIT 0,1";
    }else{
        $sql = "SELECT * FROM orders WHERE id='$id'";
    }

    if ($order_query=mysqli_query($conn, $sql)) {

            $order = mysqli_fetch_assoc($order_query);
        
    }else{
        header("Location: order-error.php");
        exit();
    }
}

$status = $order['status'];

if ($order['payment_method']=='Paystack' AND $order['status']=='Pending') {
    require_once "check-payment.php";
}

require "header.php"; 

?>


    <!-- Checkout Section Start -->
    <div class="section section-margin" style="margin-top: 20px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Coupon Accordion Start -->
                    <div class="coupon-accordion">

                            

                        <!-- Title Start -->
                        <h3 class="title">
                        <b>Your order status is: <?php echo $order['status']; ?></b>

                        <br>
                        <br>

                        <?php if (strtolower(trim($status))=='pending'): ?>

                        <?php if ($order['payment_method']=='Paystack'): ?>
                            <a href="payment-checkout.php?id=<?php echo $order['id'];?>">Click here to make payment</a>
                        <?php endif ?>

                        <?php if ($order['payment_method']=='Bank Transfer'): ?>
                            <b>INSTRUCTIONS</b>
                            <br>
                            Please make sure that you make payment to the following bank account:<br>
                            Guaranty Trust Bank (GTbank)<br>
                            0169828429<br>
                            ADEDIRAN ENOCH
                            <br>

                            <br>
                            <br>
                            Hold on while we confirm your order. 
                        <?php endif ?>
                        <p class="mb-2" style="line-height: 1.6em">
                                <br>
                                For any problems, you can reach out to us on Whatsapp 
                                +2347037135077 +2349096476717</p>
                        <?php endif ?>

                        </h3>

                    </div>
                    <!-- Coupon Accordion End -->
                </div>
            </div>

            <br>

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
                                        <select class="myniceselect nice-select wide rounded-0" name="country" disabled>
                                            <option data-display="<?php echo $order['country']; ?>"><?php echo $order['country']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Country Name End -->

                                <!-- First Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" value="<?php echo $order['full_name'];?>" disabled>
                                    </div>
                                </div>
                                <!-- First Name Input End -->

                                <!-- Company Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input type="text" name="company" value="<?php echo $order['company']; ?>" disabled>
                                    </div>
                                </div>
                                <!-- Company Name Input End -->

                                <!-- Address Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input name="address" type="text" value="<?php echo $order['address'];?>" disabled>
                                    </div>
                                </div>
                                <!-- Address Input End -->


                                <!-- Town or City Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" value="<?php echo $order['city'];?>" disabled>
                                    </div>
                                </div>
                                <!-- Town or City Name Input End -->

                                <!-- State or Country Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input placeholder="" disabled type="text" name="state" value="<?php echo $order['state'];?>">
                                    </div>
                                </div>
                                <!-- State or Country Input End -->

                                <!-- Postcode or Zip Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text" value="<?php echo $order['zip'];?>">
                                    </div>
                                </div>
                                <!-- Postcode or Zip Input End -->

                                <!-- Email Address Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email" value="<?php echo $order['email'];?>">
                                    </div>
                                </div>
                                <!-- Email Address Input End -->

                                <!-- Phone Number Input Start -->
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" value="<?php echo $order['phone'];?>" disabled>
                                    </div>
                                </div>
                                <!-- Phone Number Input End -->

                                <!-- Order Notes Textarea Start -->
                                <div class="order-notes mt-3 mb-n2">
                                    <div class="checkout-form-list checkout-form-list-2">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" disabled><?php echo $order['order_notes']; ?></textarea>
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
                        <h3 class="title">Order #<?php echo $order['id']; ?></h3>
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

                        $cart =json_decode($order['cart']);

                        foreach ($cart as $c) {

                         ?>

                                    <tr class="cart_item">
                                        <td class="cart-product-name text-start ps-0"> <?php echo $c[0]; ?><strong class="product-quantity"> × <?php echo $c[2]; ?></strong></td>
                                        <td class="cart-product-total text-end pe-0"><span class="amount">₦<?php echo number_format($c[1]*$c[2]); ?></span></td>
                                    </tr>
                            <?php } ?>


                                </tbody>
                                <!-- Table Body End -->

                                <!-- Table Footer Start -->
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th class="text-start ps-0">Cart Subtotal</th>
                                        <td class="text-end pe-0"><span class="amount">₦<?php echo number_format($order['total']);?></span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th class="text-start ps-0">Order Total</th>
                                        <td class="text-end pe-0"><strong><span class="amount">₦<?php echo number_format($order['total']+$order['shipping']);?></span></strong></td>
                                    </tr>
                                </tfoot>
                                <!-- Table Footer End -->

                            </table>
                        </div>
                        <!-- Your Order Table End -->

                        <b>Payment type</b>
                        <br>
                        <h6><?php echo $order['payment_method']; ?></h6>


                        <b>Payment status</b>
                        <br>
                        <h6><?php echo $order['status']; ?></h6>

                        <?php if ($order['payment_method']=='Paystack' AND $order['status']=='Pending') { ?>

                                <div class="order-button-payment">
                                </div>
                                <br>
                                    <button class="btn btn-dark btn-hover-primary rounded-0 w-100" ><a href="payment-checkout.php?id=<?php echo $order['id'];?>" style="color: #fff">PAY NOW</a></button>

                        <?php } ?>
                    </div>
                    <!-- Your Order Area End -->
                </div>

                    

            </div>
        </div>
    </div>
    <!-- Checkout Section End -->





<?php require "footer.php";  ?>