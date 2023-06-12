<?php require "header.php"; ?> 


    <!-- Login | Register Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row mb-n10">

                <div class="col-lg-6 col-md-8 m-auto">
                    <!-- Register Wrapper Start -->
                    <div class="register-wrapper">

                        <!-- Login Title & Content Start -->
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Create Account</h2>

                            <div class="lost-password">
                                Already registered? <a style="text-decoration: underline;" href="login.php">Login</a>
                            </div>

                            <p class="error" style="color: red"></p>

                        </div>
                        <!-- Login Title & Content End -->

                        <!-- Form Action Start -->
                        <form action="#" method="post">

                            <!-- Input First Name Start -->
                            <div class="single-input-item mb-3">
                                <input type="text" required placeholder="First Name" id="first_name">
                            </div>
                            <!-- Input First Name End -->

                            <!-- Input Last Name Start -->
                            <div class="single-input-item mb-3">
                                <input type="text" required placeholder="Last Name" id="last_name" required>
                            </div>
                            <!-- Input Last Name End -->

                            <!-- Input Email Or Username Start -->
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="Email" id="email" required>
                            </div>
                            <!-- Input Email Or Username End -->
                            <!-- Input Last Name End -->

                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Phone" id="phone" required>
                            </div>

                            <div class="single-input-item mb-3">
                                <select class="form-control" id="country">
                                    <?php foreach ($shipping_fees as $country => $fee): ?>
                                        <option value="<?php echo $country?>"><?php echo $country; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="State" id="state" required>
                            </div>

                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="City" id="city" required>
                            </div>

                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Zip Code" id="zip" required>
                            </div>

                            <div class="single-input-item mb-3">
                                <textarea placeholder="Address" id="address" style="width: 100%;font-family: inherit;padding: 10px;border:0;font-size: 14px" required></textarea>
                            </div>

                            <!-- Input Password Start -->
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Enter your Password" id="password" required>
                            </div>
                            <!-- Input Password End -->

                            <!-- Input Password Start -->
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Confirm Password" id="confirm_password" required>
                            </div>
                            <!-- Input Password End -->


                            <!-- Register Button Start -->
                            <div class="single-input-item mb-3">
                                <button class="btn btn btn-dark btn-hover-primary rounded-0">Register</button>
                            </div>
                            <!-- Register Button End -->

                        </form>
                        <!-- Form Action End -->

                    </div>
                    <!-- Register Wrapper End -->
                </div>
            </div>

        </div>
    </div>
    <!-- Login | Register Section End -->
<?php require "footer.php"; ?>


<script type="text/javascript">
  $('form').submit(false);

  $('.btn').on('click', function(){
    $('.btn').html('<i class="fa fa-spin fa-spinner"></i> &nbsp;SUBMITTING');

    setTimeout(function(){
        options = {
            first_name: $('#first_name').val(), 
            last_name: $('#last_name').val(), 
            email: $('#email').val(),  
            phone: $('#phone').val(), 
            country: $('#country').val(), 
            state: $('#state').val(), 
            zip: $('#zip').val(), 
            city: $('#city').val(), 
            address: $('#address').val(), 
            password: $('#password').val(), 
            confirm_password: $('#confirm_password').val(), 
            type: "register",
        }
      $.post("api/post-login.php", options, function(res){

          if (res==1) {
            $('.btn').html('<i class="fa fa-spin fa-spinner"></i> &nbsp;PREPARING YOUR DASHBOARD');
            $(".error").html('');
            setTimeout(function(){
              window.location.href ="my-account.php";
            },1000);

          }else{
            $(".error").html(res);
            $(".error").fadeIn('slow');
          $('.btn').html('<i class="fa fa-lock"></i> &nbsp;TRY AGAIN');
          }

      });
    }, 500);

  });
</script>