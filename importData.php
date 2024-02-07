<h1>importData</h1>
<?php 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['importSubmit'])) {
    echo 'inside isset';
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadshhetml.sheet');

    // validate if the selected file is excel
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {
        // if the file is uploaded
        if(is_uploaded_file($_FILES['file']['temp_name'])) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['temp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            // remove header row
            unset($worksheet_arr[0]);

            forEach($worksheet_arr as $row) {
                $first_name = $row[0];
                $last_name = $row[1];
                $email = $row[2];
                $phone = $row[3];
                $status = $row[4];
            }
        }
    }
}

?>