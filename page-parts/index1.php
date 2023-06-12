<?php 

// require "../inc/conn.php";

		$products = array();

		$sql = "SELECT * FROM products LIMIT 2,16";

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


			$check = true;
			$no=1;
			while($check==true) {
				if (file_exists("product-images/$id-$no.jpg")) {
					$x['images'][]="$id-$no.jpg";
					$no++;
				}else{
					$check = false;
				}
			}

			$check = true;
			$no=1;
			while($check==true) {
				if (file_exists("product-images/$id-$no.png")) {
					$x['images'][]="$id-$no.png";
					$no++;
				}else{
					$check = false;
				}
			}

			!isset($x['images'][1])==true ? $x['images'][1]=$x['featured-image'] : '';
				


			$products[]=$x;
		}






		// &&&&&&&&&&&&&&&&&&%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// &&&&&&&&&&&&&&&&&&%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



		$text = '';

		$y=0;
		while(isset($products[$y])){
		$text .= '

		<div class="swiper-slide product-wrapper">';

						$text.='
			            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
			                <div class="thumb thumb-mod">
			                    <a href="product.php?id='.$products[$y]['id'].'" class="image">
			                        <img class="first-image" src="product-images/'.$products[$y]['featured-image'].'" alt="Product" />
			                        <img class="second-image" src="product-images/'.@$products[$y]['images'][1].'" alt="'.$products[$y]['name'].'" />
			                    </a>
			                    <div class="actions">
			                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
			                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
			                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
			                    </div>
			                </div>
			                <div class="content">
			                    <h4 class="sub-title"><a href="shop.php?category='.$products[$y]['category'].'">'.$products[$y]['category'].'</a></h4>
			                    <h5 class="title"><a href="product.php?id='.$products[$y]['id'].'">'.$products[$y]['name'].'</a></h5>
			                    <span class="ratings">
										<span class="rating-wrap">
											<span class="star" style="width: 100%"></span>
			                    </span>
			                    <span class="rating-num">(4)</span>
			                    </span>
			                    <span class="price">
										<span class="new">$'.number_format($products[$y]['price']).'</span>
			                    <span class="old">$'.number_format($products[$y]['old_price']).'</span>
			                    </span>
			                    <button class="product'.$products[$y]['id'].' btn btn-sm btn-outline-dark btn-hover-primary" onclick="add_to_cart('.$products[$y]['id'].')">Add To Cart</button>
			                </div>
			            </div>';
				$y++;

			if (isset($products[$y])) {

						$text.='
			            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
			                <div class="thumb thumb-mod">
			                    <a href="product.php?id='.$products[$y]['id'].'" class="image">
			                        <img class="first-image" src="product-images/'.$products[$y]['featured-image'].'" alt="Product" />
			                        <img class="second-image" src="product-images/'.@$products[$y]['images'][1].'" alt="'.$products[$y]['name'].'" />
			                    </a>
			                    <div class="actions">
			                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
			                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
			                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
			                    </div>
			                </div>
			                <div class="content">
			                    <h4 class="sub-title"><a href="shop.php?category='.$products[$y]['category'].'">'.$products[$y]['category'].'</a></h4>
			                    <h5 class="title"><a href="product.php?id='.$products[$y]['id'].'">'.$products[$y]['name'].'</a></h5>
			                    <span class="ratings">
										<span class="rating-wrap">
											<span class="star" style="width: 100%"></span>
			                    </span>
			                    <span class="rating-num">(4)</span>
			                    </span>
			                    <span class="price">
										<span class="new">$'.number_format($products[$y]['price']).'</span>
			                    <span class="old">$'.number_format($products[$y]['old_price']).'</span>
			                    </span>
			                    <button class="product'.$products[$y]['id'].' btn btn-sm btn-outline-dark btn-hover-primary" onclick="add_to_cart('.$products[$y]['id'].')">Add To Cart</button>
			                </div>
			            </div>';
			}
	
				$y++;

		$text .= '
		</div>';

		}

		echo $text;


	 ?>