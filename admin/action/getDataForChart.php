<?php
include ("../../koneksi.php");

// Query for get data for chart montly and count 
$stmt = $conn->prepare("SELECT 
    DATE_FORMAT(order_date, '%M') AS month_name,
    SUM(amount_paid) AS total_sales
FROM orders
GROUP BY month_name
ORDER BY MONTH(order_date)");
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$sales = [];

while ($row = $result->fetch_assoc()) {
    $months[] = ucfirst(strtolower($row['month_name'])); // Format bulan seperti "Agustus"
    $sales[] = (float)$row['total_sales'];
}

// Mengonversi array ke format JSON
$dataChartDaily = [
    "months" => $months,
    "sales" => $sales
];

header('Content-Type: application/json');
echo json_encode($dataChartDaily);
?>
