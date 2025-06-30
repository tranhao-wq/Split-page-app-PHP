<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phân trang sản phẩm</title>
    <style>
        .pnow {font-size: 25px; font-weight: bold; color: red;}
        table {border-collapse: collapse; width: 80%; margin: 20px auto;}
        th, td {border: 1px solid #ccc; padding: 8px; text-align: center;}
        th {background: #eee;}
        .pagination {text-align: center; margin: 20px;}
        .pagination a {margin: 0 5px; text-decoration: none; color: blue;}
        .pagination .pnow {color: red;}
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
// Xác định trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $tst) $page = $tst;
$vt = ($page - 1) * $sd;
// Lấy sản phẩm cho trang hiện tại
$sql2 = "SELECT * FROM webtm_sanpham LIMIT $vt, $sd";
$res2 = mysqli_query($link, $sql2);
?>
<h2 style="text-align:center">Danh sách sản phẩm</h2>
<table>
    <tr>
        <th>STT</th>
        <th>Tên Sản phẩm</th>
        <th>Hình</th>
        <th>Giá</th>
    </tr>
    <?php
    $i = $vt + 1;
    while ($sp = mysqli_fetch_assoc($res2)) {
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . htmlspecialchars($sp['TenSP']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($sp['UrlHinh']) . "' width='100'></td>";
        echo "<td>" . number_format($sp['Gia']) . "</td>";
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