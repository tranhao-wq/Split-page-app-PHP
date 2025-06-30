<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .product-table {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product-table th, .product-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .product-table th {
            background-color: #0066cc;
            color: white;
        }

        .product-table img {
            max-width: 80px;
            transition: transform 0.3s ease;
        }

        .product-table img:hover {
            transform: scale(1.1);
        }

        .pagination {
            text-align: center;
            margin: 30px 0;
        }

        .pagination a, .pagination span {
            display: inline-block;
            margin: 0 6px;
            padding: 10px 16px;
            color: #0066cc;
            background-color: #fff;
            border: 1px solid #0066cc;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background-color: #0066cc;
            color: white;
        }

        .pagination .pnow {
            font-weight: bold;
            color: white;
            background-color: #ff4d4d;
            border-color: #ff4d4d;
        }

        @media (max-width: 600px) {
            .product-table th, .product-table td {
                font-size: 14px;
                padding: 8px;
            }

            .pagination a, .pagination span {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<?php
$sd = 5;
include("connect.php");

// Lấy tổng số sản phẩm
$sql = "SELECT COUNT(*) AS total FROM webtm_sanpham";
$res = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($res);
$total = $row['total'];
$tst = ceil($total / $sd);

// Trang hiện tại
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, min($tst, $page)); // ràng buộc trong khoảng hợp lệ
$vt = ($page - 1) * $sd;

// Lấy sản phẩm theo trang
$sql2 = "SELECT * FROM webtm_sanpham LIMIT $vt, $sd";
$res2 = mysqli_query($link, $sql2);
?>

<h2>Danh sách sản phẩm</h2>
<table class="product-table">
    <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Giá (VNĐ)</th>
    </tr>
    <?php
    $i = $vt + 1;
    while ($sp = mysqli_fetch_assoc($res2)) {
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . htmlspecialchars($sp['TenSP']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($sp['UrlHinh']) . "' alt='Hình sản phẩm'></td>";
        echo "<td>" . number_format($sp['Gia'], 0, ',', '.') . "₫</td>";
        echo "</tr>";
    }
    ?>
</table>

<div class="pagination">
    <?php
    for ($i = 1; $i <= $tst; $i++) {
        if ($i == $page) {
            echo "<span class='pnow'>$i</span>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }
    ?>
</div>

</body>
</html>
