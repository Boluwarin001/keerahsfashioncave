<?php 

    require "header.php";
 ?>



    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">


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

                        if (file_exists("assets/images/product-images/$id-1.jpg")) {
                            $x['featured-image'] = "$id-1.jpg";
                        }else if (file_exists("assets/images/product-images/$id-1.png")) {
                            $x['featured-image'] = "$id-1.png";
                        }else{
                            $x['featured-image'] = "default.jpg";
                        }

                        $check = true;
                        $no=2;
                        while($check==true) {
                            if (file_exists("assets/images/product-images/$id-$no.jpg")) {
                                $x['images'][]="$id-$no.jpg";
                            }else{
                                $check = false;
                            }
                            $no++;
                        }

                        $check = true;
                        $no=2;
                        while($check==true) {
                            if (file_exists("assets/images/product-images/$id-$no.png")) {
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

<!--                             <div class="shop-short-by mr-4">
                                <select class="nice-select" aria-label=".form-select-sm example">
                                    <option selected>Show 24</option>
                                    <option value="1">Show 24</option>
                                    <option value="2">Show 12</option>
                                    <option value="3">Show 15</option>
                                    <option value="3">Show 30</option>
                                </select>
                            </div> -->

                            <div class="shop-short-by mr-4">
                                Categories
                            </div>
                            <div class="shop-short-by mr-4">
                                <select class="nice-select" id="catSelect" aria-label=".form-select-sm example">
                                    <option value="all">All Categories</option></a>
                                    <?php 
                                        $sql2=mysqli_query($conn, "SELECT DISTINCT category FROM products");
                                        while ($y=mysqli_fetch_assoc($sql2)) {
                                     ?>
                                    <option value="<?php echo $y['category']; ?>" <?php echo get('category', true)==$y['category'] ? 'selected' : '' ?>><?php echo $y['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="shop_toolbar_btn">
                                <button data-role="grid_4" type="button" class="active btn-grid-4" title="Grid"><i class="fa fa-th"></i></button>
                                <button data-role="grid_list" type="button" class="btn-list" title="List"><i class="fa fa-th-list"></i></button>
                            </div>
                        </div>
                        <!-- Shopt Top Bar Right End -->

                    </div>
                    <!--shop toolbar end-->

                    <!-- Shop Wrapper Start -->
                    <div class="row shop_wrapper grid_4">

                    <?php 

                    foreach ($p as $p) {

                     ?>

                        <!-- Single Product Start -->
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 product" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-inner">
                                <div class="thumb">
                                    <a href="product.php?id=<?php echo $p['id']; ?>" class="image">
                                        <img class="first-image" src="assets/images/product-images/<?php echo $p['featured-image']; ?>" alt="Product" />
                                        <img class="second-image" src="assets/images/product-images/<?php echo @$p['images'][0]; ?>" alt="<?php echo $p['name']; ?>" />

                                    </a>
                                    <div class="actions">
                                        <a href="#" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="#" title="Quickview" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                        <a href="#" title="Compare" class="action compare"><i class="pe-7s-shuffle"></i></a>
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
                                    <p> <!-- description --> </p>
                                    <span class="price">
                                            <span class="new">₦<?php echo number_format($p['price']); ?></span>
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
            </div>
        </div>
    </div>
    <!-- Shop Section End -->
    
<?php require "footer.php"; ?>


<script type="text/javascript">
    $('#catSelect').on('change', function(){
        if ($('#catSelect').val()=='all') {
        window.location = 'shop.php';
    }else{
        window.location = 'shop.php?category=' + $('#catSelect').val();
        }
    })
</script>