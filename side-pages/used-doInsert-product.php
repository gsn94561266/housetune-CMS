<?php
require_once("../db-connect-used.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$name = $_POST["name"];
$category_room = $_POST["category_room"];
$category_product= $_POST["category_product"];
$original_price = $_POST["original_price"];
$price = $_POST["price"];
$bought_time= $_POST["bought_time"];
$img = $_FILES["img"]["name"];
$description = $_POST["description"];
$now = date('Y-m-d H:i:s');
$valid = $_POST["posted"];


if ($_FILES['img']['error'] == 0) {
    $file = explode(".", $img);
    $new_name =  $file[0] . "-" . date('ymdhis') . "-" . rand(0, 10);
    move_uploaded_file($_FILES["img"]["tmp_name"], "./used/" . $new_name . "." . $file[1]);
    $img = $new_name . "." . $file[1];
}




$sql = "INSERT INTO used_product( name, category_room, description, original_price, price, img, bought_time, created_at, updated_at, valid) VALUES ( '$name', '$category_room', '$description', '$original_price', '$price', '$img', '$bought_time', '$now', '$now', '$valid')";
  
if ($conn->query($sql) === TRUE) {
    echo "新資料輸入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header("location: used-product-list.php");

?>
