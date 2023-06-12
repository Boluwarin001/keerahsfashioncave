<?php 

    require "header.php";
 ?>





                <?php 
                    $p = array();

                    $count  = 50;
                    $sql = "SELECT * FROM products";

                    if (get('category')) {
                        $sql .= " WHERE category='".get('category')."'";
                    }

                    $sql.= " ORDER BY id DESC LIMIT 0,$count";

                    $query = mysqli_query($conn, $sql);


                    while ($x=mysqli_fetch_assoc($query)) {
                        $id = $x['id'];

                        if (file_exists("product-images/$id-1.jpg")) {
                            $x['featured-image'] = "$id-1.jpg";
                        }else if (file_exists("product-images/$id-1.png")) {
                            $x['featured-image'] = "$id-1.png";
                        }else{
                            $x['featured-image'] = "default.jpg";
                        }

                        $check = true;
                        $no=2;
                        while($check==true) {
                            if (file_exists("product-images/$id-$no.jpg")) {
                                $x['images'][]="$id-$no.jpg";
                            }else{
                                $check = false;
                            }
                            $no++;
                        }

                        $check = true;
                        $no=2;
                        while($check==true) {
                            if (file_exists("product-images/$id-$no.png")) {
                                $x['images'][]="$id-$no.png";
                                $no++;
                            }else{
                                $check = false;
                            }
                            $no++;
                        }

                        !isset($x['images'][0])==true ? $x['images'][0]=$x['featured-image'] : '';

                        $p[]=$x;
                    }
                     ?>




    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area" style="background: url(assets/images/banner/banner-page.jpg) top right no-repeat;background-size: cover;">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Shop</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> shop</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-12 col-custom">

                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper flex-column flex-md-row mb-10">

                        <!-- Shop Top Bar Left start -->
                        <div class="shop-top-bar-left mb-md-0 mb-2">
                            <div class="shop-top-show">
                                <span>Showing 1–12 of <?php echo count($p); ?> results</span>
                            </div>
                        </div>
                        <!-- Shop Top Bar Left end -->

                        <!-- Shopt Top Bar Right Start -->
                        <div class="shop-top-bar-right">
                            <div class="shop-short-by mr-4">
                                <select class="nice-select" aria-label=".form-select-sm example">
                                    <option selected>Show 24</option>
                                    <option value="1">Show 24</option>
                                    <option value="2">Show 12</option>
                                    <option value="3">Show 15</option>
                                    <option value="3">Show 30</option>
                                </select>
                            </div>

                            <div class="shop-short-by mr-4">
                                <select class="nice-select" aria-label=".form-select-sm example">
                                    <option selected>Sort by Default</option>
                                    <option value="1">Sort by Popularity</option>
                                    <option value="2">Sort by Rated</option>
                                    <option value="3">Sort by Latest</option>
                                    <option value="3">Sort by Price</option>
                                    <option value="3">Sort by Price</option>
                                </select>
                            </div>

                            <div class="shop_toolbar_btn">
                                <button data-role="grid_3" type="button" class="active btn-grid-4" title="Grid"><i class="fa fa-th"></i></button>
                                <button data-role="grid_list" type="button" class="btn-list" title="List"><i class="fa fa-th-list"></i></button>
                            </div>
                        </div>
                        <!-- Shopt Top Bar Right End -->

                    </div>
                    <!--shop toolbar end-->

                    <!-- Shop Wrapper Start -->
                    <div class="row shop_wrapper grid_3">



                    <?php 

                    foreach ($p as $p) {

                     ?>


                        <!-- Single Product Start -->
                        <div class="col-lg-4 col-md-4 col-sm-6 product" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-inner">
                                <div class="thumb">
                                    <a href="product.php?id=<?php echo $p['id']; ?>" class="image">
                                        <img class="first-image" src="product-images/<?php echo $p['featured-image']; ?>" alt="<?php echo $p['name']; ?>" />
                                        <img class="second-image" src="product-images/<?php echo @$p['images'][0]; ?>" alt="<?php echo $p['name']; ?>" />
                                    </a>
                                    <div class="actions">
                                        <a href="#" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="#" title="Quickview" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                        <a href="compare.html" title="Compare" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="sub-title"><a href="shop.php?category=<?php echo $p['category']; ?>"><?php echo $p['category']; ?></a></h4>
                                    <h5 class="title"><a href="product.php?id=<?php echo $p['id']; ?>"><?php echo $p['name']; ?></a></h5>
                                    <span class="ratings">
                                            <span class="rating-wrap">
                                                <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">(4)</span>
                                    </span>
                                    <p><!-- description--></p>
                                    <span class="price">
                                            <span class="new">$<?php echo number_format($p['price']); ?></span>
                                    <span class="old"><?php echo  number_format($p['old_price']); ?></span>
                                    </span>
                                    <div class="shop-list-btn">
                                        <a title="Wishlist" href="#" class="btn btn-sm btn-outline-dark btn-hover-primary wishlist"><i class="fa fa-heart"></i></a>
                                        <button class="btn btn-sm btn-outline-dark btn-hover-primary product<?php echo $p['id'];?>" title="Add To Cart" onclick="add_to_cart('<?php echo $p['id'];?>')">Add To Cart</button>
                                        <a title="Compare" href="#" class="btn btn-sm btn-outline-dark btn-hover-primary compare"><i class="fa fa-random"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Product End -->



                    <?php } ?>



                    </div>
                    <!-- Shop Wrapper End -->

                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper mt-10">

                        <!-- Shop Top Bar Left start -->
                        <div class="shop-top-bar-left">
                            <div class="shop-short-by mr-4">
                                <select class="nice-select rounded-0" aria-label=".form-select-sm example">
                                    <option selected>Show 12 Per Page</option>
                                    <option value="1">Show 12 Per Page</option>
                                    <option value="2">Show 24 Per Page</option>
                                    <option value="3">Show 15 Per Page</option>
                                    <option value="3">Show 30 Per Page</option>
                                </select>
                            </div>
                        </div>
                        <!-- Shop Top Bar Left end -->

                        <!-- Shopt Top Bar Right Start -->
                        <div class="shop-top-bar-right">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Shopt Top Bar Right End -->

                    </div>
                    <!--shop toolbar end-->

                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget mt-10 mt-lg-0">
                        <div class="widget_inner" data-aos="fade-up" data-aos-delay="200">
                            <div class="widget-list mb-10">
                                <h3 class="widget-title mb-4">Search</h3>
                                <div class="search-box">
                                    <input type="text" class="form-control" placeholder="Search Our Store" aria-label="Search Our Store">
                                    <button class="btn btn-dark btn-hover-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>



                            <div class="widget-list mb-10">
                                <h3 class="widget-title mb-5">Price Filter</h3>
                                <!-- Widget Menu Start -->
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <button class="slider-range-submit" type="submit">Filter</button>
                                    <input class="slider-range-amount" type="text" name="text" id="amount" />
                                </form>
                                <!-- Widget Menu End -->
                            </div>
                            <div class="widget-list mb-10">
                                <h3 class="widget-title">Categories</h3>
                                <div class="sidebar-body">
                                    <ul class="sidebar-list">


                                        <li><a href="#">All Products</a></li>
                                    <?php 
                                        $sql2=mysqli_query($conn, "SELECT DISTINCT category FROM products ORDER BY category ASC");
                                        while ($y=mysqli_fetch_assoc($sql2)) {
                                     ?>
                                        <li><a href="?category=<?php echo $y['category']; ?>"><?php echo $y['category']; ?></a></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-list mb-10">
                                <h3 class="widget-title">Color</h3>
                                <div class="sidebar-body">
                                    <ul class="checkbox-container categories-list">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                <label class="custom-control-label" for="customCheck12">black (20)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                <label class="custom-control-label" for="customCheck13">red (6)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck14">
                                                <label class="custom-control-label" for="customCheck14">blue (8)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                <label class="custom-control-label" for="customCheck11">green (5)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck15">
                                                <label class="custom-control-label" for="customCheck15">pink (4)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-list mb-10">
                                <h3 class="widget-title mb-4">Tags</h3>
                                <div class="sidebar-body">
                                    <ul class="tags mb-n2">
                                        <li><a href="#">Men</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Evening</a></li>
                                        <li><a href="#">Sequin</a></li>
                                        <li><a href="#">Handmade</a></li>
                                        <li><a href="#">Lather</a></li>
                                        <li><a href="#">Prom</a></li>
                                    </ul>
                                </div>
                            </div>



                        </div>
                    </aside>
                    <!-- Sidebar Widget End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section End -->







<?php require "footer.php"; ?>