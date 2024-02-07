<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

require 'vendor/autoload.php';

// $inputFileName = './test_reader.xlsx';

// $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

// $sheet = $spreadsheet->getActiveSheet();

// $cell_val = $sheet->getCell('P2')->getValue();

// echo $cell_val;


$inputFileName = './testFile.xlsx';

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$sheet = $spreadsheet->getActiveSheet();

$highestRow = $sheet->getHighestDataRow();
$highestColumn = $sheet->getHighestDataColumn();

$highestColumn++;

echo '<table>';
for($row = 1; $row <= $highestRow; $row++) {
    echo '<tr>';
    for($col = 'A'; $col != $highestColumn; $col++) {
        echo '<td>' . $sheet->getCell($col . $row)->getValue() . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>    
</body>
</html>