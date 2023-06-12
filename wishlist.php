<?php 


require_once "inc/conn.php";





    if (isset($_COOKIE['wishlist']) and !empty($_COOKIE['wishlist'])) {
        $wishlist_cookie = $_COOKIE['wishlist'];
    }else{
        $wishlist_cookie = uniqid();
        $exppp=time()+30000;
        setcookie('wishlist', $wishlist_cookie, "$exppp", '/');
    }

    $sql = mysqli_query($conn, "SELECT * FROM wishlist WHERE cookie='$wishlist_cookie'");
    $product = array();


    while ($x=mysqli_fetch_assoc($sql)) {
        $product[]=$x;
    }


require_once "header.php";


?>


    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Wishlist</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="wishlist-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-stock">Stock Status</th>
                                    <th class="pro-wishlist">Add to wishlist</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>


                    <?php 

                        $total = 0;

                        foreach ($product as $p) {
                            $id = $p['item_id'];
                            $qty = $p['qty'];

                            $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));


                        if (file_exists("assets/images/product-images/$id-1.jpg")) {
                            $img = "$id-1.jpg";
                        }else if (file_exists("assets/images/product-images/$id-1.png")) {
                            $img = "$id-1.png";
                        }else{
                            $img = "default.jpg";
                        }

                        $total+=$item['price']*$qty;
                        ?>


                                <tr>
                                    <td class="pro-thumbnail"><a href="product.php?id=<?php echo $item['id'];?>"><img class="img-fluid" src="assets/images/product-images/<?php echo $img; ?>" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#"><?php echo $item['name']; ?></a></td>
                                    <td class="pro-price"><span>$<?php echo number_format($item['price']);?></span></td>
                                    <td class="pro-stock"><span>In Stock</span></td>
                                    <td class="pro-wishlist"><a href="wishlist.html" class="btn btn-dark btn-hover-primary rounded-0">Add to wishlist</a></td>
                                    <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Wishlist Section End -->


<?php require "footer.php"; ?>