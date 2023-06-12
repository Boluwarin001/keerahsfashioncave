<?php require "header.php"; ?> 



    <!-- Login | Register Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row mb-n10">
                <div class="col-lg-6 col-md-8 m-auto ">
                    <!-- Login Wrapper Start -->
                    <div class="login-wrapper">

                        <!-- Login Title & Content Start -->
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Login</h2>

                            <div class="lost-password">
                                Not registered? <a style="text-decoration: underline;" href="register.php">Create Account</a>
                            </div>
                            
                            <p class="error" style="color: red"></p>
                        </div>
                        <!-- Login Title & Content End -->


                        <!-- Form Action Start -->
                        <form>

                            <!-- Input Email Start -->
                            <div class="single-input-item mb-3">
                                <input type="email" id="email" placeholder="Email" required>
                            </div>
                            <!-- Input Email End -->

                            <!-- Input Password Start -->
                            <div class="single-input-item mb-3">
                                <input type="password" id="password" placeholder="Enter your Password" required>
                            </div>
                            <!-- Input Password End -->

                            <!-- Checkbox/Forget Password Start -->
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
<!--                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                        </div> -->
                                    </div>
                                    <a href="#" class="forget-pwd mb-3">Forget Password?</a>
                                </div>
                            </div>
                            <!-- Checkbox/Forget Password End -->

                            <!-- Login Button Start -->
                            <div class="single-input-item mb-3">
                                <button id="login" class="btn btn btn-dark btn-hover-primary rounded-0">Login</button>
                            </div>
                            <!-- Login Button End -->

                        </form>
                        <!-- Form Action End -->

                    </div>
                    <!-- Login Wrapper End -->
                </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Login | Register Section End -->
<?php require "footer.php"; ?>


<script type="text/javascript">
  $('form').submit(false);

  $('#login').on('click', function(){
    $('#login').html('<i class="fa fa-spin fa-spinner"></i> &nbsp;SUBMITTING');

    setTimeout(function(){
      $.post("api/post-login.php", {password: $('#password').val(), email: $('#email').val(), type: "login"}, function(res){

          if (res==1) {
            $('#login').html('<i class="fa fa-spin fa-spinner"></i> &nbsp;PREPARING YOUR DASHBOARD');
            $(".error").html('');
            setTimeout(function(){
              window.location.href ="my-account.php";
            },1000);

          }else{
            $(".error").html(res);
            $(".error").fadeIn('slow');
          $('#login').html('<i class="fa fa-lock"></i> &nbsp;TRY AGAIN');
          }

      });
    }, 500);

  });
</script>