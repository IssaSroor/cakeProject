<?php
session_start();
 include('views/partials/navbar.php');?>

        <!--====== End - Main Header ======-->

        <br>
        <br>
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-20">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">
                                        <a href="index.php">Home</a>
                                    </li>                                      
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <?php
                                    include('dashboard_features.php');
                                    ?>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Dashboard</h1>

                                            <span class="dash__text u-s-m-b-30">From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</span>
                                            <div class="row">
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h1 u-s-m-b-8">Total Sales</h2>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <a href="dash-edit-profile.html"><br></a></div>

                                                            <h1 class="dash__h1 u-s-m-b-14" style='font-size:30px'><?php
                                                            //  include('show_admin.php');
                                                                                            
                                                            //  $sales = new sales();
                                                            //  $sales_total = $sales->totalSales();
                                                             print_r($total[0]['total']);
                                                            ?> JD</h1>
                                                            <br>
                                                            <span class="dash__text">From <?php echo date('Y-m-d', strtotime('-30 days'));?></span>
                                                            <div class="dash__link dash__link--secondary u-s-m-t-8">

                                                                <!-- <a data-modal="modal" data-modal-id="#dash-newsletter">Subscribe Newsletter</a> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">ADDRESS BOOK</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Shipping Address</span>
                                                            <div class="dash__link dash__link--secondary u-s-m-b-8">

                                                                <a href="dash-address-book.html">Edit</a></div>

                                                            <span class="dash__text">4247 Ashford Drive Virginia - VA-20006 - USA</span>

                                                            <span class="dash__text">(+0) 900901904</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                        <div class="dash__pad-3">
                                                            <h2 class="dash__h2 u-s-m-b-8">BILLING ADDRESS</h2>

                                                            <span class="dash__text-2 u-s-m-b-8">Default Billing Address</span>

                                                            <span class="dash__text">4247 Ashford Drive Virginia - VA-20006 - USA</span>

                                                            <span class="dash__text">(+0) 900901904</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                        <h2 class="dash__h2 u-s-p-xy-20">RECENT ORDERS</h2>
                                        <div class="dash__table-wrap gl-scroll">
                                            <table class="dash__table">
                                                <thead>
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Customer Phone</th>
                                                        <th>Placed On</th>
                                                        <th>Delivery Address</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                
                                                // include('./php/show_admin.php');
                                                                                            
                                                // $order = new orders();
                                                // $order_row = $order->showOrders();
                                                  foreach($orders as $order) {
                                                    echo "<tr>
                                                        <td>".$order['order_ID']."</td>
                                                        <td>".$order['customer_phone']."</td>
                                                        <td>".$order['created_at']."</td>
                                                        <td>".$order['delivery_address']."</td>
                                                        <td><div class='dash__table-total'>
                                                                <span>".$order['order_total_amount_after']." JD</span>
                                                                <div class='dash__link dash__link--brand'>
                                                                    <form method='POST' action='dash-manage-order.php'>
                                                                        <input type='text' value='".$order['order_ID']."' name='order_id' style='visibility: hidden;display: none;'>
                                                                        <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2' style='border:0;color:#ff4500'><a>MANAGE</a></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>";
                                                  }
                                                  ?>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        <?php
    include('views/partials/footer.php');
    ?>
        <!--====== Modal Section ======-->


       