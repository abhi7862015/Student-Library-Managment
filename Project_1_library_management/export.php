<?php

include 'db_connection.php';

function filterData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

if (isset($_GET['export']) && $_GET['export'] == 1) {

    $filename = "members-data_" . date('y-m-d') . ".csv";
    $fileds = array('Student Image', ',', 'Student ID', ',', 'Student Name', ',', 'Student Roll No', ',', 'Student Phone No');
    $excelData = implode("\t", array_values($fileds)) . "\n";

    $query2 = "SELECT student_id, student_name, student_roll_no, student_phone_no, student_image_href_link FROM student_details";
    $result2 = $conn->query($query2);
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $lineData = array($row2['student_image_href_link'], ',', $row2['student_id'], ',', $row2['student_name'], ',', $row2['student_roll_no'], ',', $row2['student_phone_no']);
            array_walk($lineData, 'filterData');
            $excelData.=implode("\t", array_values($lineData)) . "\n";
        }
    } else {
        $exelData.="No records Found..." . "\n";
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $excelData;
    $_SESSION['success'] = "CSV File Download Successfully!";
   exit;
}
?>