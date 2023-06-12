<?php require_once "header.php"; ?>


    <?php 

        if (get('id')) {
            $id = get('id');

            $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));
    ?>



    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title"><?php echo $p['category']; ?></h1>
                    <ul>
                        <li>
                            <a href="shop.php?category=<?php echo $p['category']; ?>">View All</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->
    <!-- Single Product Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">

                    <!-- Product Details Image Start -->
                    <div class="product-details-img">

                        <!-- Single Product Image Start -->
                        <div class="single-product-img swiper-container gallery-top">
                            <div class="swiper-wrapper popup-gallery">

                            <?php 


                                $check = true;
                                $no=1;
                                while($check==true) {
                                    $loc="product-images/$id-$no.jpg";
                                    if (file_exists($loc)) {
                                        ?>
                                <a class="swiper-slide w-100" href="<?php echo $loc; ?>">
                                    <img class="w-100" src="<?php echo $loc; ?>" alt="Product">
                                </a>
                                        <?php
                                    }else{
                                        $check = false;
                                    }
                                    $no++;
                                }

                                $check = true;
                                $no=1;
                                while($check==true) {
                                    $loc="product-images/$id-$no.png";
                                    if (file_exists($loc)) {
                                        ?>
                                        <a class="swiper-slide w-100" href="<?php echo $loc; ?>">
                                            <img class="w-100" src="<?php echo $loc; ?>" alt="Product">
                                        </a>
                                        <?php
                                        $no++;
                                    }else{
                                        $check = false;
                                    }
                                    $no++;
                                }

                             ?>

                            </div>
                        </div>
                        <!-- Single Product Image End -->

                        <!-- Single Product Thumb Start -->
                        <div class="single-product-thumb swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">


                            <?php 


                                $check = true;
                                $no=1;
                                while($check==true) {
                                    $loc="product-images/$id-$no.jpg";
                                    if (file_exists($loc)) {
                                        ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $loc; ?>" alt="Product">
                                </div>
                                        <?php
                                    }else{
                                        $check = false;
                                    }
                                    $no++;
                                }

                                $check = true;
                                $no=1;
                                while($check==true) {
                                    $loc="product-images/$id-$no.png";
                                    if (file_exists($loc)) {
                                        ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo $loc; ?>" alt="Product">
                                        </div>
                                        <?php
                                        $no++;
                                    }else{
                                        $check = false;
                                    }
                                    $no++;
                                }

                             ?>

                            </div>

                            <!-- Next Previous Button Start -->
                            <div class="swiper-button-horizental-next  swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-button-horizental-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->

                        </div>
                        <!-- Single Product Thumb End -->

                    </div>
                    <!-- Product Details Image End -->

                </div>
                <div class="col-lg-7 col-custom">

                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">

                        <!-- Product Head Start -->
                        <div class="product-head mb-3">
                            <h2 class="product-title"><?php echo $p['name']; ?></h2>
                        </div>
                        <!-- Product Head End -->

                        <!-- Price Box Start -->
                        <div class="price-box mb-2">
                            <span class="regular-price">$<?php echo number_format($p['price'], 2); ?></span>
                            <span class="old-price"><del>$<?php echo number_format($p['old_price'], 2); ?></del></span>
                        </div>
                        <!-- Price Box End -->

                        <!-- Rating Start -->
                        <span class="ratings justify-content-start">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                        </span>
                        <span class="rating-num">(4)</span>
                        </span>
                        <!-- Rating End -->

                        <!-- SKU Start -->
                        <div class="sku mb-3">
                            <span>SKU: 12345</span>
                        </div>
                        <!-- SKU End -->

                        <!-- Description Start -->
                        <p class="desc-content mb-5"><?php echo utf8_encode($p['description']); ?></p>
                        <!-- Description End -->

                        <!-- Product Meta Start -->
                        <div class="product-meta mb-3">
                            <!-- Product Size Start -->
                            <div class="product-size">
<!--                                 <span>SIZES AVAILABLE :</span>
                                <label style="cursor: pointer;">
                                    <a><strong><?php echo $p['sizes']; ?></strong> </a>
                                </label> -->
                            </div>
                            <!-- Product Size End -->
                        </div>
                        <!-- Product Meta End -->

                        <!-- Quantity Start -->
                        <div class="quantity mb-5">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" id="qty" value="1" type="text">
                                <div class="dec qtybutton"></div>
                                <div class="inc qtybutton"></div>
                            </div>
                        </div>
                        <!-- Quantity End -->

                        <!-- Cart & Wishlist Button Start -->
                        <div class="cart-wishlist-btn mb-4">
                            <div class="add-to_cart">
                                <a class="product<?php echo $p['id'];?> btn btn-outline-dark btn-hover-primary" onclick="add_to_cart(<?php echo $p['id'];?>, true)">Add to Cart</a>
                            </div>
                            <div class="add-to-wishlist">
                                <a class="btn btn-outline-dark btn-hover-primary" href="#" onclick="if(add_to_cart(<?php echo $p['id'];?>)==1){window.location = 'checkout.php';} ">Buy Now</a>
                            </div>
                            </a>
                        </div>
                        <!-- Cart & Wishlist Button End -->

                        <!-- Social Shear Start -->
                        <div class="social-share">
                            <span>Share :</span>
                            <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                            <a href="#"><i class="fa fa-instagram linkedin-color"></i></a>
                        </div>
                        <!-- Social Shear End -->


                    </div>
                    <!-- Product Summery End -->

                </div>
            </div>

            <div class="row section-margin">
                <!-- Single Product Tab Start -->
                <div class="col-lg-12 col-custom single-product-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Shipping Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-text" id="myTabContent">
                        <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="desc-content border p-3">
                                <p class="mb-3">
                                Thanks for stopping by my shop. This beautiful Piece is made from quality fabric and carefully sewn by professional seamstresses. All items will be made according to the size selected but if you have your bust, waist , hip and height do kindly share for better fit. Please note that we offer this item in other colours and fabric, just send a message
                                <br>
                                <br>
                                Your phone number is important for shipping. Please contact us if you have further questions about this order
                                <br>
                                <br>

                                Fabric care : gentle wash with mild detergent separately from other clothes
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- Shipping Policy Start -->
                            <div class="shipping-policy mb-n2">
                              <h4 class="title-3 mb-4">Delivery Delay</h4>

                              <ul class="policy-list mb-2">
                                  <li>
                                    Nigeria from 13 to 19 days.
                                  </li>
                                  <li>
                                    France from 15 to 21 days.
                                  </li>
                                  <li>
                                    United States from 15 to 21 days.
                                  </li>
                                  <li>
                                    Africa from 15 to 21 days.
                                  </li>
                                  <li>
                                    International from 15 to 21 days.
                                  </li>
                              </ul>

                            <h4 class="title-3 mb-4">Refunds and Exchanges</h4>

                            <ul class="policy-list mb-2">
                                <li>No exchanges or refunds.</li>
                                <li>Return shipping fees are at your charge and not refunded.</li>
                              <li>Refunds are made on your Afrikrea virtual wallet. You can use the credit to buy another product or transfer the amount to your bank account.</li>
                            </ul>

                            <h4 class="title-3 mb-4">Condition</h4>

                            <ul class="policy-list mb-2">
                              <li>New item.</li>
                                <li>Customizable and made to order.</li>
                            </ul>

<!--                                 <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                                <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                                <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p> -->
                            </div>
                            <!-- Shipping Policy End -->
                        </div>
                        <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                            <div class="size-tab table-responsive-lg">
                                <h4 class="title-3 mb-4">Size Chart</h4>
                                <table class="table border mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="cun-name"><span>UK</span></td>
                                            <td>18</td>
                                            <td>20</td>
                                            <td>22</td>
                                            <td>24</td>
                                            <td>26</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>European</span></td>
                                            <td>46</td>
                                            <td>48</td>
                                            <td>50</td>
                                            <td>52</td>
                                            <td>54</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>usa</span></td>
                                            <td>14</td>
                                            <td>16</td>
                                            <td>18</td>
                                            <td>20</td>
                                            <td>22</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>Australia</span></td>
                                            <td>28</td>
                                            <td>10</td>
                                            <td>12</td>
                                            <td>14</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <td class="cun-name"><span>Canada</span></td>
                                            <td>24</td>
                                            <td>18</td>
                                            <td>14</td>
                                            <td>42</td>
                                            <td>36</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Product Tab End -->
            </div>

            <!-- Products Start -->
            <div class="row">

                <div class="col-12">
                    <!-- Section Title Start -->
                    <div class="section-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">You Might Also Like</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col">
                    <div class="product-carousel">

                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                    <?php 


                        $products = array();

                        $sql = "SELECT * FROM products LIMIT 0,10";

                        $query = mysqli_query($conn, $sql);


                        while ($x=mysqli_fetch_assoc($query)) {
                            $id = $x['id'];

                            // default
                            if (file_exists("product-images/$id-1.jpg")) {
                                $x['featured-image'] = "$id-1.jpg";
                            }else if (file_exists("product-images/$id-1.png")) {
                                $x['featured-image'] = "$id-1.png";
                            }else{
                                $x['featured-image'] = "default.jpg";
                            }
                    ?>
                                <!-- Product Start -->
                                <div class="swiper-slide product-wrapper">

                                    <!-- Single Product Start -->
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="300">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="product-images/<?php echo $x['featured-image'];?>" alt="Product" />
                                            </a>
                                            <div class="actions">
                                                <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h4 class="sub-title"><a href="product.php?id=<?php echo $x['id'];?>"><?php echo $x['category']; ?></a></h4>
                                            <h5 class="title"><a href="product.php?id=<?php echo $x['id'];?>"><?php echo $x['name']; ?></a></h5>
                                            <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                            <span class="price">
                                                    <span class="new">$<?php echo number_format($x['price']); ?></span>
                                            <span class="old">$<?php echo number_format($x['old_price']); ?></span>
                                            </span>
                                            <button class="product<?php echo $x['id'];?> btn btn-sm btn-outline-dark btn-hover-primary" onclick="add_to_cart(<?php echo $x['id'];?>)">Add To Cart</button>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->

                                </div>
                                <!-- Product End -->
                            <?php } ?>


                            </div>

                            <!-- Swiper Pagination Start -->
                            <div class="swiper-pagination d-md-none"></div>
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-button-next swiper-button-next swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-product-button-prev swiper-button-prev swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->

                        </div>

                    </div>
                </div>

            </div>
            <!-- Products End -->

        </div>
    </div>
    <!-- Single Product Section End -->
<?php } ?>

<?php require "footer.php"; ?>