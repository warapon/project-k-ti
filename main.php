<!DOCTYPE html>
<html lang="en">
<head>
    <title>ฐานข้อมูลผู้ผลิตผลไม้และสินค้าเกษตรจังหวัดสุราษฎร์ธานี</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background: url('img/background/background.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .container {
            padding: 25px;
        }

        A:link {
            text-decoration: none;
        }

        A:visited {
            text-decoration: none;
        }
        .no-gutters {
            padding-right: 3px;
            padding-left: 3px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
</head>
<body>
<?php
require_once("config/connect.php");
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <div class="nav-link"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา :</div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="?search=type">ประเภท <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="?search=area">พื้นที่ <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <?php
        if (!empty($_SESSION["user_id_system"])) {
            ?>
            <form class="form-inline my-2 my-lg-0">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown">
                        <span class="caret">
                <i class="fa fa-user-o"
                   aria-hidden="true"></i>&nbsp; คุณ <?= $_SESSION["name"] ?> <?= $_SESSION["lastname"] ?></span>
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
                            ?>
                            <a class="dropdown-item" href="main.php?page=manage"><i class="fa fa-cogs"
                                                                                    aria-hidden="true"></i>
                                จัดการข้อมูลผู้ผลิต</a>
                            <a class="dropdown-item" href="main.php?page=typefruit"><i class="fa fa-cogs"
                                                                                       aria-hidden="true"></i>
                                จัดการข้อมูลชนิดผลไม้</a>
                            <a class="dropdown-item" href="main.php?page=report_producers"><i class="fa fa-address-book"
                                                                                           aria-hidden="true"></i>
                                รายงานผู้ผลิตทั้งหมด</a>
                            <a class="dropdown-item" href="main.php?page=report_buyers"><i class="fa fa-address-book"
                                                                                           aria-hidden="true"></i>
                                รายงานผู้ซื้อทั้งหมด</a>
                            <a class="dropdown-item" href="main.php?page=report_garden"><i class="fa fa-address-book"
                                                                                         aria-hidden="true"></i>
                                รายงานพื้นที่เพราะปลูก</a>
                            <a class="dropdown-item" href="main.php?page=report_research"><i class="fa fa-address-book"
                                                                                             aria-hidden="true"></i>
                                รายงานจากชื่อผู้ผลิต</a>
                            <?php
                        } else {
                            ?>
                            <a class="dropdown-item" href="main.php?page=setting"><i class="fa fa-cogs"
                                                                                     aria-hidden="true"></i>
                                เกี่ยวกับฉัน</a>
                            <?php
                        }
                        if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 2) {
                            ?>
                            <a class="dropdown-item" href="main.php?page=manage_garden"><i class="fa fa-pencil-square"
                                                                                           aria-hidden="true"></i>
                                จัดการสวน/ไร่</a>
                            <a class="dropdown-item" href="main.php?page=store"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> ชมสวน</a>
                            <?php
                        }
                        ?>
                        <a class="dropdown-item" href="main.php?page=logout"><i class="fa fa-sign-out"
                                                                                aria-hidden="true"></i>ออกจากระบบ</a>
                    </div>
                </div>
            </form>
            <?php
        } else {
            ?>
            <form class="form-inline my-2 my-lg-0">
                <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                <a href="main.php?page=register"> <label>ลงทะเบียน</label></a>&nbsp;
                <label>|</label>&nbsp;
                <a href="main.php?page=login"><label>เข้าสู่ระบบ</label></a>
            </form>
            <?php
        }
        ?>
    </div>
</nav>
<div class="container">
    <?php
    if (!empty($_GET['page'])) {
        require_once "page/" . $_GET['page'] . ".php";
    } else {
        echo "<script>window.location.href='index.php';</script>";
    }
    ?>
</div>
</body>
</html>