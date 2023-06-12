<?php 

require_once "inc/conn.php";

if (post('name') and post('email') and post('subject') and post('message')) {

    // $mail_to = "alan.hybrid.to@gmail.com";
    $mail_to = "boluadediran@gmail.com";
    $mail_subject = "Contact Form KIRIO";

   $mail_header = "From: KEERAH <noreply@shopkeerah.online> \r\n";
   $mail_header .= "MIME-Version: 1.0\r\n";
   $mail_header .= "Content-type: text/html\r\n";


    $mail_message = "
    A User Filled the Contact form on shopkeerah.online
    <br>
    <br>
    <b>Name:</b> &nbsp; &nbsp;".post('name')."
    <br>
    <b>Email:</b> &nbsp; &nbsp;".post('email')."
    <br>
    <b>Subject:</b> &nbsp; &nbsp;".post('subject')."
    <br>
    <br>
    <b>Message:</b> &nbsp; &nbsp;".post('message')."

    ";

           
   if ($retval = mail ($mail_to,$mail_subject,$mail_message,$mail_header)){
    header("Location: mail-sent.php");
    exit();
   }

}

require "header.php"; 


?>
    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Contact Us</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Contact Us Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-12 col-lg-8 mb-10">
                    <!-- Section Title Start -->
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Get In Touch</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <!-- Section Title End -->
                    <!-- Contact Form Wrapper Start -->
                    <div class="contact-form-wrapper contact-form">
                        <form method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="text" placeholder="Your Name *" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="email" placeholder="Email *" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="text" placeholder="Subject *" name="subject" required>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-item mb-8">
                                                <textarea class="textarea-item" name="message" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="500">
                                            <button type="submit" class="btn btn-dark btn-hover-primary rounded-0">Send A Message</button>
                                        </div>
                                        <p class="col-8 form-message mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                    <!-- Contact Form Wrapper End -->
                </div>
                <div class="col-12 col-lg-4 mb-10">
                    <!-- Section Title Start -->
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Contact Info</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Information Wrapper Start -->
                    <div class="row contact-info-wrapper mb-n6">

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="300">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Address</h4>
                                <p class="desc-content">No 1, tewogbade street,<br> Opposite riverside hote, after ibachi, <br>Ikolaba, <br>Bodija, <br>Ibadan, Nigeria</p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="400">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Contact Us Anytime</h4>
                                <p class="desc-content">+234 811 258 3078</p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="500">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Support Overall</h4>
                                <p class="desc-content">
                                    <a href="mailto:keerahsfashioncave@gmail.com">keerahsfashioncave@gmail.com</a> 
                                </p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                    </div>
                    <!-- Contact Information Wrapper End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact us Section End -->
    


<?php require "footer.php";?>