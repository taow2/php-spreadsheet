<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'test');

$sheet->setCellValue('A1', '#');
$sheet->setCellValue('B1', 'First');
$sheet->setCellValue('C1', 'Last');
$sheet->setCellValue('D1', 'Handle');

$sheet->setCellValue('A2', '1');
$sheet->setCellValue('B2', 'Mark');
$sheet->setCellValue('C2', 'Otto');
$sheet->setCellValue('D2', '@mdo');

$sheet->setCellValue('A3', '2');
$sheet->setCellValue('B3', 'Jacob');
$sheet->setCellValue('C3', 'Thornton');
$sheet->setCellValue('D3', '@fat');

$sheet->setCellValue('A4', '3');
$sheet->setCellValue('B4', 'Larry');
$sheet->setCellValue('C4', 'the Bird');
$sheet->setCellValue('D4', '@twitter');

$filename = 'sample-' . time() . '.xlsx';

// redirect output to client
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>