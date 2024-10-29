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
$resultOrders = $stmtOrders->get_result(); 

// Jumlah total rows
$resulOrdersNums = $resultOrders->num_rows;

$stmtMonthSales = $conn->prepare("SELECT 
    DATE_FORMAT(order_date, '%M') AS month_name,
    COUNT(*) AS order_count,
    SUM(amount_paid) AS total_revenue
FROM orders
GROUP BY month_name
ORDER BY MONTH(order_date)");
$stmtMonthSales->execute();
$result = $stmtMonthSales->get_result();

$months = [];
$orderCounts = [];
$revenueMonth = [];

// Mengambil data dari hasil query
while ($row = $result->fetch_assoc()) {
    $months[] = ucfirst(strtolower($row['month_name'])); // Format bulan seperti "Agustus"
    $orderCounts[] = (int)$row['order_count']; // Jumlah pesanan
    $revenueMonth[] = (float)$row['total_revenue'];
    // $revenueMonth[] = number_format($row['total_revenue'], 0, ',', '.');

  }
  // var_dump($revenueMonth);
  // die;
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
                                    <h4 class="card-title"> Rp.<?= number_format($resultPaid['SUM(amount_paid)'])?></h4>
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
                                    <h4 class="card-title"><?= $resulOrdersNums ?></h4>
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
                        <!-- <a
                        href="#"
                        class="btn btn-label-success btn-round btn-sm me-2"
                        >
                        <span class="btn-label">
                            <i class="fa fa-pencil"></i>
                        </span>
                        Export
                        </a> -->
                        <!-- <a href="#" class="btn btn-label-info btn-round btn-sm">
                        <span class="btn-label">
                            <i class="fa fa-print"></i>
                        </span>
                        Print
                        </a> -->
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                    <canvas id="testingChartdah"></canvas>
                    </div>
                    <div id="myChartLegend2"></div>
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
                        <!-- <button
                            class="btn btn-sm btn-label-light dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Export
                        </button> -->
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

                    <?php
                       $stmt = $conn->prepare("SELECT 
                       DATE_FORMAT(MIN(order_date), '%M %Y') AS earliest_date, 
                       DATE_FORMAT(MAX(order_date), '%M %Y') AS latest_date 
                        FROM orders");
                     $stmt->execute();
                    $result = $stmt->get_result()->fetch_assoc();
                   
                   $earliestDate = $result['earliest_date'];
                   $latestDate = $result['latest_date']; 
                    ?>
                    <div class="card-category"><?=$earliestDate?> - <?=$latestDate?></div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                    <h1>Rp. <?= number_format($resultPaid['SUM(amount_paid)']) ?></h1>
                    </div>
                    <div class="pull-in">
                    <canvas id="totalPenjualan"></canvas>
                    </div>
                </div>
                </div>
                <div class="card card-round">
                <div class="card-body pb-0">
                    <!-- <div class="h1 fw-bold float-end text-primary">users</div> -->
                    <h2 class="mb-2 text-primary"><?= $resultUser ?></h2>
                    <p class="text-muted">Users </p>
                    <div class="pull-in sparkline-fix">
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
        var testingChartdah = document.getElementById('testingChartdah').getContext("2d"),
        totalPenjualanChart = document.getElementById("totalPenjualan").getContext("2d");
        var months = <?php echo json_encode($months) ?>;
        var total_revenue = <?php echo json_encode($revenueMonth) ?>


        // yang char pertama 
        var gradientStroke = testingChartdah.createLinearGradient(
          500,
        0,
        100,
        0
      );
      gradientStroke.addColorStop(0, "#177dff");
      gradientStroke.addColorStop(1, "#80b6f4");

      var gradientFill = testingChartdah.createLinearGradient(500, 0, 100, 0);
      gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
      gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

      var gradientStroke2 = testingChartdah.createLinearGradient(
        500,
        0,
        100,
        0
      );
      gradientStroke2.addColorStop(0, "#f3545d");
      gradientStroke2.addColorStop(1, "#ff8990");

      var gradientFill2 = testingChartdah.createLinearGradient(500, 0, 100, 0);
      gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
      gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

      var gradientStroke3 = testingChartdah.createLinearGradient(
        500,
        0,
        100,
        0
      );
      gradientStroke3.addColorStop(0, "#fdaf4b");
      gradientStroke3.addColorStop(1, "#ffc478");

      var gradientFill3 = testingChartdah.createLinearGradient(500, 0, 100, 0);
      gradientFill3.addColorStop(0, "rgba(253, 175, 75, 0.7)");
      gradientFill3.addColorStop(1, "rgba(255, 196, 120, 0.3)");

      var myHtmlLegendsChart = new Chart(testingChartdah, {
        type: "line",
        data: {
          labels: months,
          datasets: [
            {
              label: "Revenue per Month",
              borderColor: gradientStroke,
              pointBackgroundColor: gradientStroke,
              pointRadius: 0,
              backgroundColor: gradientFill,
              legendColor: "#177dff",
              fill: true,
              borderWidth: 1,
              data: total_revenue,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  callback: function(value) {
                                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
                  },
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "500",
                  beginAtZero: false,
                  maxTicksLimit: 5,
                  padding: 20,
                },
                gridLines: {
                  drawTicks: false,
                  display: false,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  zeroLineColor: "transparent",
                },
                ticks: {
                  padding: 20,
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "500",
                },
              },
            ],
          },
          legendCallback: function (chart) {
            var text = [];
            text.push('<ul class="' + chart.id + '-legend html-legend">');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              text.push(
                '<li><span style="background-color:' +
                  chart.data.datasets[i].legendColor +
                  '"></span>'
              );
              if (chart.data.datasets[i].label) {
                text.push(chart.data.datasets[i].label);
              }
              text.push("</li>");
            }
            text.push("</ul>");
            return text.join("");
          },
        },
      });

      var myLegendContainer = document.getElementById("myChartLegend2");

      // generate HTML legend
      myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

      // bind onClick event to all LI-tags of the legend
      var legendItems = myLegendContainer.getElementsByTagName("li");
      for (var i = 0; i < legendItems.length; i += 1) {
        legendItems[i].addEventListener("click", legendClickCallback, false);
      }


    //  chart kedua 
    // var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');
    var months = <?php echo json_encode($months) ?>;
    var orderCounts = <?php echo json_encode($orderCounts) ?>;


    var myDailySalesChart = new Chart(totalPenjualanChart, {
        type: 'line',
        data: {
            labels:months,
            datasets:[ {
                label: "Sales Analytics", fill: !0, backgroundColor: "rgba(255,255,255,0.2)", borderColor: "#fff", borderCapStyle: "butt", borderDash: [], borderDashOffset: 0, pointBorderColor: "#fff", pointBackgroundColor: "#fff", pointBorderWidth: 1, pointHoverRadius: 5, pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "#fff", pointHoverBorderWidth: 1, pointRadius: 1, pointHitRadius: 5, data: orderCounts
            }]
	},
	options : {
		maintainAspectRatio:!1, legend: {
			display: !1
		}
		, animation: {
			easing: "easeInOutBack"
		}
		, scales: {
			yAxes:[ {
				display:!1, ticks: {
					fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold", beginAtZero: !0, maxTicksLimit: 10, padding: 0
				}
				, gridLines: {
					drawTicks: !1, display: !1
				}
			}
			], xAxes:[ {
				display:!1, gridLines: {
					zeroLineColor: "transparent"
				}
				, ticks: {
					padding: -20, fontColor: "rgba(255,255,255,0.2)", fontStyle: "bold"
				}
			}
			]
		}
	}
});

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