<!DOCTYPE html>
<html lang="en">
<head>
    <title>ฐานข้อมูลผู้ผลิตผลไม้และสินค้าเกษตรจังหวัดสุราษฎร์ธานี</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- นำเข้า Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <br><br>
    <div class="text-white text-center"><h3>ฐานข้อมูลผู้ผลิตผลไม้จังหวัดสุราษฎร์ธานี</h3></div>
    <br>
    <?php
    if (!empty($_GET["search"]) AND $_GET["search"] == "area") {
        ?>
        <!--        <div class="card bg-warning text-white">-->
        <!--            <div class="card-body"><strong>แจ้งเตือน!</strong> กำลังอยู่ระหว่างการพัฒนา ค่อยกลับมาใช้ใหม่นะค่ะ</div>-->
        <!--        </div>-->
        <br>
        <form name="form1" method="post" action="main.php?page=search" OnSubmit="return fncSubmit();">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>อำเภอ</label>
                        <select class="form-control" name="city" id="amphur">
                            <option id="amphur_list"></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>ตำบล</label>
                        <select class="form-control" name="district" id="district">
                            <option value="">-- ทุกตำบล --</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php
                    $sql = sprintf("SELECT * FROM fruittype ");

                    $con = new db();
                    $con = $con->selects($sql);
                    ?>
                    <label for="sel1">ประเภท</label>
                    <select class="form-control" name="type" id="sel1">
                        <option value=""> -- ทุกชนิด --</option>
                        <?php
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <option value="<?= $row["ft_id"] ?>"><?= $row["ft_nametype"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="area" value="1" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Go
                    </button>
                </div>
            </div>

        </form>
        <?php
    } else {
        ?>
        <form method="post" action="main.php?page=search">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Go
                    </button>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
    <label><h5>ผลไม้</h5></label>
    <br>
    <div class="row">

        <?php
        $sql = sprintf("SELECT * FROM fruittype LIMIT 0,12");
        $con = new db();
        $con = $con->selects($sql);
        if (mysql_num_rows($con) == 0) {
            echo "<div class='text-danger text-center'>ไม่มีข้อมูล</div>";
        } else {
            while ($row = mysql_fetch_assoc($con)) {
                ?>
                <div class="col-4 col-md-2 no-gutters">
                    <a href="main.php?page=search&fruit=<?= $row["ft_id"] ?>" data-toggle="tooltip" data-placement="top"
                       title="<?= $row["ft_nametype"] ?>">
                        <div class="card bg-light text-dark">
                            <div class="card-body text-center">
                                <img class="rounded-circle" src="img/type/<?= $row["ft_image"] ?>" width="100%"
                                     alt="Card image">
                                <div class="text-truncate"><?= $row["ft_nametype"] ?></div>
                            </div>
                        </div>
                    </a>
                    <br>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
    $sql = sprintf("SELECT * FROM fruittype LIMIT 10,2");
    $con = new db();
    $con = $con->selects($sql);
    if (mysql_num_rows($con) > 0) {
        ?>
        <br>
        <p class="text-primary text-right"><a href="main.php?page=fruitall"> [คลิก อ่านต่อ] </a></p>
        <br>
        <?php
    }
    ?>
    <!--    <label><h5>ข่าวกจิกรรม</h5></label>-->
    <!--    <div class="row">-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-6">-->
    <!--            <div class="alert alert-dark">-->
    <!--                <strong>การตลาดและการเขียนแผน ธุรกิจออนไลน์สินค้าเกษตร จังหวัดสุราษฎร์ธานี-->
    <!--                    21-23 กันยายน 2561-->
    <!--                    โรงแรมวังใต้ จังหวัดสุราษฎร์ธานี จัดโดยสำนักงานพาณิชย์จังหวัดสุราษฎร์ธานี</strong>-->
    <!--                <p class="text-right">19/08/2561 00.43</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <p class="text-primary text-right">ข่าวกจิกรรม เพิ่มเติม >>></p>-->
    <!--</div>-->
    <!--<br>-->
    <!--<br>-->
    <br>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script>

        $(function () {

            //เรียกใช้งาน Select2
            $(".select2-single").select2();

            //ดึงข้อมูล province จากไฟล์ get_data.php
            $.ajax({
                url: "get_data.php",
                dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
                data: {show_province: 'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
                success: function (data) {

                    //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                    $.each(data, function (index, value) {
                        //แทรก Elements ใน id province  ด้วยคำสั่ง append
                        $("#province").append("<option value='" + value.id + "'> " + value.name + "</option>");
                    });
                }
            });


            //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
            $(document).ready(function(){

                //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                var province_id = 67;

                $.ajax({
                    url: "get_data.php",
                    dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                    data: {province_id: province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                    success: function (data) {

                        //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                        $("#amphur").text("");

                        $("#amphur").append("<option value=''>-- ทุกอำเภอ --</option>");
                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function (index, value) {

                            //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                            $("#amphur").append("<option value='" + value.id + "'> " + value.name + "</option>");
                        });
                    }
                });

            });

            //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
            $("#amphur").change(function () {

                //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
                var amphur_id = $(this).val();

                $.ajax({
                    url: "get_data.php",
                    dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                    data: {amphur_id: amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                    success: function (data) {

                        //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                        $("#district").text("");
                        $("#district").append("<option value=''> -- ทุกตำบล --</option>");
                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function (index, value) {

                            //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                            $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");

                        });
                    }
                });

            });

            //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district
            $("#district").change(function () {


                //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
                var amphur = $("#amphur option:selected").text();

                //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
                var district = $("#district option:selected").text();


            });


        });
        function fncSubmit()
        {
            if(document.form1.amphur.value == "" && document.form1.district.value != "")
            {
                 alert('กรุณาเลือกอำเภอก่อนการทำรายการค่ะ');
                return false;
            }
            document.form1.submit();
        }
    </script>
</body>
</html>