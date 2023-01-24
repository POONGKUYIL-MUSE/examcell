<?php
session_start();
require '../database/config.php';
include_once('../assets/tcpdf/tcpdf.php');

if (isset($_POST['get_department_batches'])) {
    if (isset($_POST['deptid'])) {

        $deptid = $_POST['deptid'];
        $query = "SELECT * FROM tbl_batch WHERE dept='$deptid'";

        $batches = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $batch) {
                $temp['batchid'] = $batch['id'];
                $temp['dept'] = $batch['dept'];
                $temp['batchyear'] = $batch['batchyear'];

                array_push($batches, $temp);
            }
        } else {
            echo $conn->error;
        }
        echo json_encode([
            "success" => true,
            "batches" => $batches
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}