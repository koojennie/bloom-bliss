<?php
$month = $_POST['month'];
$year = $_POST['year'];
$monthName;

switch ($month) {
  case 12:
    $monthName = "December";
    break;
  case 11:
    $monthName = "November";
    break;
  case 10:
    $monthName = "October";
    break;
  case 9:
    $monthName = "September";
    break;
  case 8:
    $monthName = "August";
    break;
  case 7:
    $monthName = "July";
    break;
  case 6:
    $monthName = "June";
    break;
  case 5:
    $monthName = "May";
    break;
  case 4:
    $monthName = "April";
    break;
  case 3:
    $monthName = "March";
    break;
  case 2:
    $monthName = "February";
    break;
  case 1:
    $monthName = "January";
    break;
  default:
    $monthName = "Month Not Found";
    break;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Sales Report per Month</title>
  <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body onload="print()">
  <!--Menampilkan data detail obat-->
  <?php
  include '../../koneksi.php';
  ?>

  <div class="row">
    <div class="text-center">
      <img src="../../assets/images/header-report.png" alt="logo" width="300">
      <h3>Sales Report per Month</h3>
      <h5>Month <?= $monthName ?> Year <?= $year ?></h5>
      <br/>
      <table class="table table-bordered table-striped table-hover">
        <tbody>
          <thead>
            <tr>
              <td>No</td>
              <th>Order Date</th>
              <th>Product Code</th>
              <th>Product</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Qty</th>
              <th>Total Price</th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <?php
            $query = "
              SELECT 
                orders.order_date ,
                tb_produk.bouquet_code ,
                tb_produk.bouquet_name ,
                tb_produk.bouquet_price,
                tb_produk.bouquet_image,
                tb_produk.bouquet_stock,
                SUM(order_detail.qty) AS `Quantity`,
                SUM(tb_produk.bouquet_price * order_detail.qty) AS `Total Price`
            FROM 
                orders
            JOIN 
                order_detail  ON orders.order_id = order_detail.order_id
            JOIN 
                tb_produk  ON order_detail.bouquet_id = tb_produk.bouquet_id
            WHERE
                YEAR(orders.order_date) = ? AND MONTH(orders.order_date) = ?
            GROUP BY 
                orders.order_date, tb_produk.bouquet_code, tb_produk.bouquet_name
            ORDER BY 
                orders.order_date DESC;
                  ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $year, $month);
            $stmt->execute();
            $result = $stmt->get_result();
            $results = $result->fetch_all(MYSQLI_ASSOC);
            $num = 0;
            // var_dump($results);
            // die;
            
            foreach ($results as $row):
              $num += 1;
              ?>
            <tr>
              <td><?= $num ?></td>
              <td><?= $row['order_date'] ?></td>
              <td><?= $row['bouquet_code'] ?></td>
              <td><?= $row['bouquet_name'] ?></td>
              <td>Rp. <?= number_format($row['bouquet_price']) ?></td>
              <td><?= $row['bouquet_stock'] ?></td>
              <td><?= $row['Quantity'] ?></td>
              <td>
                <?php ?>
                Rp. <?= number_format($row['Total Price']) ?>
              </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="8" class="text-right">
              <?= date("d-m-Y") ?>
              <br>
              <u>Bloom & Bliss Admin<strong></u><br>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>


</body>

</html>