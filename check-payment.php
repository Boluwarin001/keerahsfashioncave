<!-- <pre> -->
    <?php 

//     require_once "inc/conn.php";
//     $cart_count =get_cart_count();

//     if (logged_in()==true) {
//         $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_info WHERE email='".$_SESSION['email']."'"));
//     }

// if (get('id')) {
//     $id = get('id');

//     if ($id=='last') {
//         $sql = "SELECT * FROM orders WHERE email = '".$user['email']."' ORDER BY id DESC LIMIT 0,1";
//     }else{
//         $sql = "SELECT * FROM orders WHERE id='$id'";
//     }

//     if ($order_query=mysqli_query($conn, $sql)) {

//             $order = mysqli_fetch_assoc($order_query);
        
//     }else{
//         header("Location: order-error.php");
//         exit();
//     }
// }




$order_id = $order['id'];

// $curl = curl_init();
  
//   curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://api.paystack.co/transaction/verify/$order_id",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "GET",
//     CURLOPT_HTTPHEADER => array(
//       "Authorization: Bearer sk_live_96c4403c6b0490e88b73895b223f4d9504fe8082",
//       "Cache-Control: no-cache",
//     ),
//   ));
  
//   $response = curl_exec($curl);
//   $err = curl_error($curl);
//   curl_close($curl);
//     if ($err) {
//     echo "cURL Error #:" . $err;
//   } else {

// $data = json_decode($response);

// echo $data->data->amount;

// exit();




$curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$order_id/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer FLWSECK-e6607dbbecbed89d70d1ac4a3a0a28ce-X",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
  } else {

$data = json_decode($response);





if (isset($data)) {
    if (isset($data->data->status)) {
        # code...
    if ($data->data->status == 'success' AND $data->data->amount>=($order['total']+$order['shipping'])) {


    $sql = "UPDATE orders SET status='Paid' WHERE id='$order_id'";


    if (mysqli_query($conn, $sql)) {
        // SEND EMAIL



            $mail_to = $email;
            $mail_subject = "KIRIO - Order Summary";

           $mail_header = "From: Kirio <noreply@kirio.com.ng> \r\n";
           $mail_header .= "MIME-Version: 1.0\r\n";
           $mail_header .= "Content-type: text/html\r\n";

           $cart_message = ""; 
           $cart_array = json_decode($order['cart']);
           $total = $order['shipping'] + $order['total'];

           foreach ($cart_array as $c) {
           $cart_message .= '  <tr style="background-color: #fff;">
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;"><b>'.$c[0].'</b>('.$c[2].')</td>
                        <td style="color: #636363;padding: 15px;border: 1px solid #dddfe1;">'.$c[1].'</td>
                    </tr>'; 
           }

           $msg = "
           The following order was made at ".date('d M Y, H:i:a').".
           <br>
           Name: ".$order['full_name']."
           <br>
           Address: ".$order['address']."
           <br>
           Phone: ".$order['phone']."
           <br>
           Email: ".$order['email']."
           <br>
           Payment Method: Paystack

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

                   

            setcookie('cart', "", time() - 3600);
            $sql = mysqli_query($conn, "DELETE FROM cart WHERE cookie='$cart_cookie'");
            $retval = mail ($mail_to,$mail_subject,$mail_message,$mail_header);
            $retval = mail ("alan.hybrid.to@gmail.com","New Order for kirio",$mail_message,$mail_header);
            echo "
            <script>window.open('order.php?id=$order_id','_self');</script>
            ";


        }
        // if sql is successful


    }
    // if data success
}
}

}
// no curl error
?>