<?php

include '../database/config.php';


function site_header() {

    $header =  "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <title>Examcell</title>
        <link href='../assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

        <link rel='stylesheet' href='../assets/styles.css'>
        <!-- <link rel='stylesheet' href='../assets/jquery_validation/demo/site-demos.css'> -->
    </head>
    <body>
    <div class='container d-flex'>
    ";

    // include 'message.php';

    if (isset($_SESSION['id'])) {
        // $header  = $header . site_navbar();
    }

    return $header;

}

function site_footer() {
    return "
    </div>
    </body>
    <script src='../assets/bootstrap/js/bootstrap.bundle.min.js'></script>
    
    <script src='../assets/jquery.min.js'></script>
    <link rel='stylesheet' type='text/css' href='../assets/datetimepicker/jquery.datetimepicker.css'/ >
    <script src='../assets/datetimepicker/build/jquery.datetimepicker.full.min.js'></script>
    <script src='../assets/jquery_validation/dist/jquery.validate.js'></script>
    <script src='../assets/scripts.js'></script>
    </html>";
}

function get_menu_item()
{
    $content = "";

    if ($_SESSION['admin']) {
        $content .= "
            <li class='nav-item'>
                <a href='dashboard.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Dashboard</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='exams.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Manage Exam</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='halls.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Manage Halls</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='exam_report.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Exam Report</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='staff.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Staffs</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='student.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Students</span>
                </a>
            </li>
            <li class='nav-item'>
                <a href='room.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Rooms</span>
                </a>
            </li>
            <li>
                <a href='#submenu1' data-bs-toggle='collapse' class='nav-link px-0 align-middle'>
                    <i class='fs-4 bi-speedometer2'></i> <span class='ms-1 d-none d-sm-inline'>Manage Category</span> </a>
                <ul class='collapse hide nav flex-column ms-1' id='submenu1' data-bs-parent='#menu'>
                    <li class='w-100'>
                        <a href='department.php' class='nav-link px-0'> <span class='d-none d-sm-inline'>Departments</span></a>
                    </li>
                    <li>
                        <a href='batch.php' class='nav-link px-0'> <span class='d-none d-sm-inline'>Batches</span></a>
                    </li>
                    <li>
                        <a href='block.php' class='nav-link px-0'> <span class='d-none d-sm-inline'>Blocks</span></a>
                    </li>
                </ul>
            </li>";
    } else {
        $content .= "
            <li class='nav-item'>
                <a href='dashboard.php' class='nav-link align-middle px-0'>
                    <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Dashboard</span>
                </a>
            </li>";
    }

    return $content;
}

function site_navbar()
{
    return "
    <div class='col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark' style='position:fixed;overflow-y:auto;height:670px;'>
        <div class='d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100'>
            <a href='/' class='d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none'>
                <span class='fs-5 d-none d-sm-inline'>EXAMCELL</span>
            </a>
            <ul class='nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start' id='menu'>
            ".get_menu_item()."
            </ul>
            <hr>
            <div class='dropdown pb-4'>
                <a href='#' class='d-flex align-items-center text-white text-decoration-none dropdown-toggle' id='dropdownUser1' data-bs-toggle='dropdown' aria-expanded='false'>
                    <img src='../assets/images/avatar.png' alt='hugenerd' width='30' height='30' class='rounded-circle'>
                    <span class='d-none d-sm-inline mx-1'>".$_SESSION['firstname']."</span>
                </a>
                <ul class='dropdown-menu dropdown-menu-dark text-small shadow'>
                    <li><a class='dropdown-item' href='#'>Settings</a></li>
                    <li><a class='dropdown-item' href='#'>Profile</a></li>
                    <li>
                        <hr class='dropdown-divider'>
                    </li>
                    <li><a class='dropdown-item' href='logout.php'>Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    ";
}

function student_site_navbar() {
    return "
    <div class='col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark' style='position:fixed'>
        <div class='d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100'>
            <a href='/' class='d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none'>
                <span class='fs-5 d-none d-sm-inline'>EXAMCELL</span>
            </a>
            <ul class='nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start' id='menu'>
                <li class='nav-item'>
                    <a href='dashboard.php' class='nav-link align-middle px-0'>
                        <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Dashboard</span>
                    </a>
                </li>
                <li class='nav-item'>
                    <a href='exams.php' class='nav-link align-middle px-0'>
                        <i class='fs-4 bi-house'></i> <span class='ms-1 d-none d-sm-inline'>Exams</span>
                    </a>
                </li>                
            </ul>
            <hr>
            <div class='dropdown pb-4'>
                <a href='#' class='d-flex align-items-center text-white text-decoration-none dropdown-toggle' id='dropdownUser1' data-bs-toggle='dropdown' aria-expanded='false'>
                    <img src='../assets/images/avatar.png' alt='hugenerd' width='30' height='30' class='rounded-circle'>
                    <span class='d-none d-sm-inline mx-1'>".$_SESSION['firstname']."</span>
                </a>
                <ul class='dropdown-menu dropdown-menu-dark text-small shadow'>
                    <li><a class='dropdown-item' href='#'>Settings</a></li>
                    <li><a class='dropdown-item' href='#'>Profile</a></li>
                    <li>
                        <hr class='dropdown-divider'>
                    </li>
                    <li><a class='dropdown-item' href='logout.php'>Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    ";
}
