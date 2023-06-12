<?php 

require "header.php"; 

if (get('id')) {
    $id = get('id');

    if (logged_in()==true) {
        $email = $user['email'];
    }else{
        $email=$_SESSION['temp_email'];
    }

    if ($id=='last') {
        $sql = "SELECT * FROM orders WHERE email = '$email' ORDER BY id DESC LIMIT 0,1";
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

?>

<br>
<br>
<br>
<br>
<br>
<br>

    <div style="max-width: 600px;margin: auto;">

                    <!-- Your Order Area Start -->
                    <div class="your-order-area border">

                        <!-- Title Start -->
                        <h3 class="title">Pay Online</h3>
                        <!-- Title End -->

                        <!-- Your Order Table Start -->
                        <div class="your-order-table table-responsive">
                            You will be directed to payment page. Click on the button to continue.
                        </div>


                        <br>
                        <!-- Payment Accordion Order Button Start -->
                        <div class="payment-accordion-order-button">
                              
                                <div class="order-button-payment">
                                    <button onclick="makePayment()" class="btn btn-dark btn-hover-primary rounded-0 w-100" >PAY NOW</button>
                                </div>



                        </div>
                        <!-- Payment Accordion Order Button End -->
                    </div>
                    <!-- Your Order Area End -->
        


        </div>
<!-- <script src="https://js.paystack.co/v1/inline.js"></script> 

<script type="text/javascript">
    const paymentForm = document.getElementById('paymentForm');
// paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack() {
  // e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_live_fc4dda51bba09b1e1fff03610f74989192ba021a', // Replace with your public key
    email: '<?php echo $order['email'];?>',
    amount: <?php echo ($order['total']+$order['shipping'])*100;?>,
    ref: '<?php echo $order['id']; ?>',
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      window.open("order.php?id=<?php echo $order['id'];?>","_self");
    }
  });
  handler.openIframe();
}
</script> -->

<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
  function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK-de39cec7e4b1cb159dbb790a43ddbe5d-X",
      tx_ref: "<?php echo $order['id']; ?>",
      amount: <?php echo ($order['total']+$order['shipping']);?>,
      currency: "NGN",
      payment_options: "card, banktransfer, ussd",
      redirect_url: "https://kirio.com.ng/order.php?id=<?php echo $order['id'];?>",
      customer: {
        email: "<?php echo $order['email'];?>",
        phone_number: "<?php echo $order['phone']; ?>",
        name: "<?php echo $order['full_name']; ?>",
      },
      customizations: {
        title: "KIRIO",
        description: "Payment for Kit",
        // logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
      },
    });
  }
</script>
