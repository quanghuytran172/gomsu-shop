<!-- Header -->
<?php
include_once('views/layouts/admin_header.php');
?>



<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="widget-block rounded bg-primary  d-flex">
                    <div class="widget-info align-self-center w-50">
                        <h3 class="text-white mb-2"><?php echo $totalOrder ?></h3>
                        <p>Tổng số đơn hàng</p>
                    </div>
                    <div class="widget-chart w-50">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="widget-block rounded bg-success  d-flex">
                    <div class="widget-info align-self-center w-50">
                        <h3 class="text-white mb-2">
                            <?php echo number_format($totalRevenueThisDay, 0, ',', '.') . ' ₫' ?> </h3>
                        <p>Doanh thu hôm nay</p>
                    </div>
                    <div class="widget-chart w-50">

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="widget-block rounded bg-danger bg-success d-flex">
                    <div class="widget-info align-self-center w-50">
                        <h3 class="text-white mb-2"><?php echo number_format($totalRevenue, 0, ',', '.') . ' ₫' ?></h3>
                        </h3>
                        <p>Tổng doanh thu</p>
                    </div>
                    <div class="widget-chart w-50">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-md-12">
                <!-- Sales Graph -->
                <div class="card card-default" data-scroll-height="675">
                    <div class="card-header">
                        <h2>Sales Of The Year</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="linechart" class="chartjs"></canvas>
                    </div>
                    <div class="
                                            card-footer
                                            d-flex
                                            flex-wrap
                                            bg-white
                                            p-0
                                        ">
                        <div class="col-6 px-0">
                            <div class="text-center p-4">
                                <h4>$6,308</h4>
                                <p class="mt-2">
                                    Total orders of this year
                                </p>
                            </div>
                        </div>
                        <div class="col-6 px-0">
                            <div class="
                                                    text-center
                                                    p-4
                                                    border-left
                                                ">
                                <h4>$70,506</h4>
                                <p class="mt-2">
                                    Total revenue of this year
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <!-- Doughnut Chart -->
                <div class="card card-default" data-scroll-height="675">
                    <div class="
                                            card-header
                                            justify-content-center
                                        ">
                        <h2>Orders Overview</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="doChart"></canvas>
                    </div>
                    <a href="#" class="
                                            pb-5
                                            d-block
                                            text-center text-muted
                                        "><i class="mdi mdi-download mr-2"></i>
                        Download overall report</a>
                    <div class="
                                            card-footer
                                            d-flex
                                            flex-wrap
                                            bg-white
                                            p-0
                                        ">
                        <div class="col-6">
                            <div class="py-4 px-4">
                                <ul class="
                                                        d-flex
                                                        flex-column
                                                        justify-content-between
                                                    ">
                                    <li class="mb-2">
                                        <i class="
                                                                mdi
                                                                mdi-checkbox-blank-circle-outline
                                                                mr-2
                                                            " style="
                                                                color: #4c84ff;
                                                            "></i>Order Completed
                                    </li>
                                    <li>
                                        <i class="
                                                                mdi
                                                                mdi-checkbox-blank-circle-outline
                                                                mr-2
                                                            " style="
                                                                color: #80e1c1;
                                                            "></i>Order Unpaid
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 border-left">
                            <div class="py-4 px-4">
                                <ul class="
                                                        d-flex
                                                        flex-column
                                                        justify-content-between
                                                    ">
                                    <li class="mb-2">
                                        <i class="
                                                                mdi
                                                                mdi-checkbox-blank-circle-outline
                                                                mr-2
                                                            " style="
                                                                color: #8061ef;
                                                            "></i>Order Pending
                                    </li>
                                    <li>
                                        <i class="
                                                                mdi
                                                                mdi-checkbox-blank-circle-outline
                                                                mr-2
                                                            " style="
                                                                color: #ffa128;
                                                            "></i>Order Canceled
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php
include_once('views/layouts/admin_footer.php');
?>