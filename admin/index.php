<!-- header php -->
<?php 
include('layout/header.php');

include('../koneksi.php');

// jumlah product 
$stmtProduct = $conn->prepare("SELECT * FROM tb_produk");
$stmtProduct->execute();
$resultProduct = $stmtProduct->get_result()->num_rows;


// jumlah users
$stmtUser = $conn->prepare("SELECT * FROM tb_user");
$stmtUser->execute();
$resultUser = $stmtUser->get_result()->num_rows;


// jumlah pendapatan
$stmtPaid = $conn->prepare("SELECT SUM(amount_paid) FROM orders");
$stmtPaid->execute();
$resultPaid = $stmtPaid->get_result()->fetch_assoc();

// jumlah orders
$stmtOrders = $conn->prepare("SELECT * FROM orders");
$stmtOrders->execute();
$resulOrders = $stmtOrders->get_result()->num_rows;

?>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Welcome Admin!</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fa-solid fa-tag"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Products</p>
                                                <h4 class="card-title"><?= $resultProduct ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Users</p>
                                                <h4 class="card-title"><?= $resultUser ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fa-solid fa-basket-shopping"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Sales</p>
                                                <h4 class="card-title"><?= number_format($resultPaid['SUM(amount_paid)'])?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Orders</p>
                                                <h4 class="card-title"><?= $resulOrders ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row">
                                <div class="card-title">User Statistics</div>
                                <div class="card-tools">
                                    <a
                                    href="#"
                                    class="btn btn-label-success btn-round btn-sm me-2"
                                    >
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                    </a>
                                    <a href="#" class="btn btn-label-info btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                    </a>
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                                </div>
                                <div id="myChartLegend"></div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-primary card-round">
                            <div class="card-header">
                                <div class="card-head-row">
                                <div class="card-title">Daily Sales</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                    <button
                                        class="btn btn-sm btn-label-light dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        Export
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton"
                                    >
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#"
                                        >Something else here</a
                                        >
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="card-category">June 20 - October 31</div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="mb-4 mt-2">
                                <h1>$4,578.58</h1>
                                </div>
                                <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                                </div>
                            </div>
                            </div>
                            <div class="card card-round">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-end text-primary">+5%</div>
                                <h2 class="mb-2">5</h2>
                                <p class="text-muted">Users online</p>
                                <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- footer -->
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
<?php include("layout/footer.php") ?>