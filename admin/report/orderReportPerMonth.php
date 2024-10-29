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
  <title>Orders per Month</title>
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
      <h2>Orders per Month History Detail</h2>
      <h5>Month <?= $monthName ?> Year <?= $year ?></h5>
      <br/>
      <table class="table table-bordered table-striped table-hover">
        <tbody>
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Product (qty)</th>
              <th>Total Price</th>
              <th>Method Payment</th>
              <th>Order Date</th>
            </tr>
          </thead>
        <tbody>
          <tr>
            <?php
            $query = "
              SELECT 
                  tb_user.*,
                  orders.*, 
                  tb_produk.bouquet_id,
                  GROUP_CONCAT(tb_produk.bouquet_name SEPARATOR ', ') AS nameProducts,
                  GROUP_CONCAT(tb_produk.bouquet_price SEPARATOR ', ') AS priceProducts,
                  GROUP_CONCAT(tb_produk.bouquet_image SEPARATOR ', ') AS imageProducts,
                  GROUP_CONCAT(order_detail.qty SEPARATOR ', ') AS qtys
              FROM 
                  tb_user
              JOIN 
                  orders ON tb_user.id_user = orders.id_user
              JOIN 
                  order_detail ON order_detail.order_id = orders.order_id
              JOIN 
                  tb_produk ON order_detail.bouquet_id = tb_produk.bouquet_id
              WHERE
                  YEAR(orders.order_date) = ? AND MONTH(orders.order_date) = ?
              GROUP BY 
                  orders.order_id
              ORDER BY 
                  orders.order_id;
                  ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $year, $month);
            $stmt->execute();
            $result = $stmt->get_result();
            $results = $result->fetch_all(MYSQLI_ASSOC);

            // var_dump($results);
            // die;
            
            foreach ($results as $row):
              ?>
            <tr>
              <td><?= $row['nama_user'] ?></td>
              <td>
                <?php
                $productArray = explode(', ', $row['nameProducts']);
                $quantityArray = explode(', ', $row['qtys']);
                for ($i = 0; $i < count($productArray); $i++) {
                  echo "<p>{$productArray[$i]} ({$quantityArray[$i]})</p>";
                }
                ?>
              </td>
              <td>Rp. <?= number_format($row['amount_paid']); ?></td>
              <td><?= $row['pmode'] ?></td>
              <td>
                <?php
                $datefromdatabase = $row['order_date'];
                // Ubah format tanggal dari Y-M-D ke format yang diinginkan
                $date = date('j F Y', strtotime($datefromdatabase));
                ?>
                <?= $date ?>
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