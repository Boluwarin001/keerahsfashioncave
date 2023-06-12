<?php 


    require_once "inc/conn.php";
    logged_in(true);


    require_once "header.php"; 
    

    require "page-parts/account-nav.php";

?>


        <!-- My Account Tab Content Start -->
        <div class="col-lg-9 col-md-8">
            <div class="tab-content" id="myaccountContent">


                <!-- Single Tab Content Start -->
                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="title">Dashboard</h3>
                        <div class="welcome">
                            <p>Hello, <strong><?php echo $user['first_name'].' '.$user
                            ['last_name']; ?></strong> (If Not <strong><?php echo $user['first_name']; ?> !</strong><a href="logout.php" class="logout"> Logout</a>)</p>
                        </div>
                        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                    </div>
                </div>
                <!-- Single Tab Content End -->




                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="orders" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="title">Orders</h3>
                        <div class="myaccount-table table-responsive text-center">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php 

                            $query = mysqli_query($conn, "SELECT * FROM orders WHERE email='".$user['email']."' ORDER BY id DESC");
                            $order=array();

                            while ($x=mysqli_fetch_assoc($query)) {
                                $order[]=$x;
                            }

                            $no=1;
                            foreach ($order as $o) {
                                ?>

                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $o['time_added']; ?></td>
                                        <td><?php echo $o['status']; ?></td>
                                        <td>₦<?php echo number_format($o['total']+$o['shipping']); ?></td>
                                        <td><a href="order.php?id=<?php echo $o['id']; ?>" class="btn btn btn-dark btn-hover-primary btn-sm rounded-0">View</a></td>
                                    </tr>

                            <?php $no++;} ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Single Tab Content End -->


                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="title">Payment Method</h3>
                        <p class="saved-message">Payments can be made via Bannk Transfer via the following details: </p>
                    </div>
                </div>
                <!-- Single Tab Content End -->

                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="title">Billing Address</h3>
                        <address>
                            <p><strong><?php echo $user['first_name'].' '.$user
                            ['last_name']; ?></strong></p>
                            <p><?php echo $user['address']; ?></p>
                            <p><?php echo $user['city']; ?></p>
                            <p><?php echo $user['state'].', '. $user['country']; ?></p>
                        <!-- <a href="#" class="btn btn btn-dark btn-hover-primary rounded-0"><i class="fa fa-edit me-2"></i>Edit Address</a> -->
                    </div>
                </div>
                <!-- Single Tab Content End -->

                <!-- Single Tab Content Start -->
                <div class="tab-pane fade" id="account-info" role="tabpanel">
                    <div class="myaccount-content">
                        <h3 class="title">Account Details</h3>
                        <div class="account-details-form">
                            <form action="#">
                                <div class="row">


                                    <div class="col-lg-6">
                                        <div class="single-input-item mb-3">
                                            <label for="first-name" class="required mb-1">First Name</label>
                                            <input type="text" id="first-name" placeholder="First Name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item mb-3">
                                            <label for="last-name" class="required mb-1">Last Name</label>
                                            <input type="text" id="last-name" placeholder="Last Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item mb-3">
                                    <label for="display-name" class="required mb-1">Display Name</label>
                                    <input type="text" id="display-name" placeholder="Display Name" />
                                </div>
                                <div class="single-input-item mb-3">
                                    <label for="email" class="required mb-1">Email Addres</label>
                                    <input type="email" id="email" placeholder="Email Address" />
                                </div>

                                
                                <fieldset>
                                    <legend>Password change</legend>
                                    <div class="single-input-item mb-3">
                                        <label for="current-pwd" class="required mb-1">Current Password</label>
                                        <input type="password" id="current-pwd" placeholder="Current Password" />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item mb-3">
                                                <label for="new-pwd" class="required mb-1">New Password</label>
                                                <input type="password" id="new-pwd" placeholder="New Password" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item mb-3">
                                                <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="single-input-item single-item-button">
                                    <button class="btn btn btn-dark btn-hover-primary rounded-0">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Single Tab Content End -->
            </div>
        </div> <!-- My Account Tab Content End -->
    </div>
</div>
                    <!-- My Account Page End -->

                </div>
            </div>

        </div>
    </div>
    <!-- My Account Section End -->


<?php require "footer.php"; ?>