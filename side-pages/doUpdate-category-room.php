<?php
session_start();
require_once("../db-connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$id = $_POST["id"];
$newId = $_POST["newId"];
$name = $_POST["name"];
$old_name = $_POST["old_name"];

$path = "./images/";
rename($path . $old_name, $path . $name);

$sql = "UPDATE category_room SET name='$name', id='$newId' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
    header("location: category-list.php");
} else {
    echo "更新資料錯誤: " . $conn->error;
}
