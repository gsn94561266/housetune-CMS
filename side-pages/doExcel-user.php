<?php
session_start();
require_once("../db-connect.php");


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;


if (isset($_POST["export_excel_btn"])) {
    $file_ext_name = $_POST['export_file_type'];
    $fileName = "user-list";

    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Account');
        $sheet->setCellValue('C1', 'Name');
        $sheet->setCellValue('D1', 'Phone');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Address');
        $sheet->setCellValue('G1', 'Created At');
        $sheet->setCellValue('H1', 'Last Modified');
        $sheet->setCellValue('I1', 'Valid');

        $rowCount = 2;
        foreach ($result as $data) {
            $sheet->setCellValue('A' . $rowCount, $data['id']);
            $sheet->setCellValue('B' . $rowCount, $data['account']);
            $sheet->setCellValue('C' . $rowCount, $data['name']);
            $sheet->setCellValue('D' . $rowCount, $data['phone']);
            $sheet->setCellValue('E' . $rowCount, $data['email']);
            $sheet->setCellValue('F' . $rowCount, $data['address']);
            $sheet->setCellValue('G' . $rowCount, $data['created_at']);
            $sheet->setCellValue('H' . $rowCount, $data['last_modified']);
            $sheet->setCellValue('I' . $rowCount, $data['valid']);
            $rowCount++;
        }
        if ($file_ext_name == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName . '.xlsx';
        } elseif ($file_ext_name == 'xls') {
            $writer = new Xls($spreadsheet);
            $final_filename = $fileName . '.xls';
        } elseif ($file_ext_name == 'csv') {
            $writer = new Csv($spreadsheet);
            $final_filename = $fileName . '.csv';
        }

        header('Content-Type: application/vnd.openexmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename="' . urlencode($final_filename) . '"');
        $writer->save('php://output');
    } else {
        $_SESSION['message'] =  "沒有找到記錄";
        header('location: excel-product.php');
        exit;
    }
}
