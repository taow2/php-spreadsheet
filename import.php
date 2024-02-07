<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Show/hide Excel file upload form  -->
<script>
    function formToggle(ID) {
        var element = document.getElementById(ID);
        if(element.style.display === "none") {
            element.style.display = "block";
        }
        else {
            element.style.display = "none";
        }
    }
</script>
</head>
<body>

<div class="container-fluid p-3">
    <h1>Import Excel File</h1>
    <h2>Members List</h2>

    <div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-end">
                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i>Import Excel</a>
            </div>
        </div>

        <!-- Excel file upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form class="row g-3" action="import.php" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <label for="fileInput" class="visually-hidden">File</label>
                    <input type="file" class="form-control" name="file" id="fileInput"/>
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">                    
                </div>
            </form>
        </div>

        <!-- Data list table -->
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
<?php 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['importSubmit'])) {
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // validate if the selected file is excel
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {
        // if the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
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

                echo '<tr>';
                echo '<td>' . $first_name . '</td>';
                echo '<td>' . $last_name . '</td>';
                echo '<td>' . $email . '</td>';
                echo '<td>' . $phone . '</td>';
                echo '<td>' . $status . '</td>';
                echo '</tr>';
            }
        }
    }
}

?>
            </tbody>
        </table>
    </div>
</div>
   
</body>
</html>