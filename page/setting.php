<?php
if (!empty($_GET["status"]) AND $_GET["status"] == "success") {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>สำเร็จ!</strong> การดำเนินการเสร็จสิ้น
    </div>
    <?php
} elseif (!empty($_GET["status"]) AND $_GET["status"] == "fail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> กรุณาติดต่อเจ้าหน้าที่ หรือ ผู้ที่มีส่วนเกี่ยวข้อง
    </div>
    <?php
} elseif (!empty($_GET["status"]) AND $_GET["status"] == "typefail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> กรุณาตรวจสอบไฟล์รูปของท่านอีกครั้ง
    </div>
    <?php
}

if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 1) {
    $sql = sprintf("SELECT * FROM buyers WHERE by_id=%s;", $_SESSION["user_id_system"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white"><h4><i class="fa fa-user-circle" aria-hidden="true"></i>
                ข้อมูลของฉัน</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <label>คำนำหน้า : <?= $row["by_prefix"] ?></label>
                </div>
                <div class="col-sm-5">
                    <label>ชื่อ : <?= $row["by_name"] ?></label>
                </div>
                <div class="col-sm-5">
                    <label>นามสกุล : <?= $row["by_lastname"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>เลขบัตรประชาชน : <?= $row["by_card_number"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>บริษัท : <?= $row["by_company"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>ที่อยู่เลขที่ : <?= $row["by_addass_number"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>หมู่ : <?= $row["by_m"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>ตำบล : <?= $row["by_district"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>อำเภอ : <?= $row["by_citty"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>จังหวัด : <?= $row["by_province"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>เบอร์โทรศัพท์ : <?= $row["by_tel"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>อีเมล์ : <?= $row["by_email"] ?></label>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif (!empty($_SESSION["level"]) AND ($_SESSION["level"] == 2 OR $_SESSION["level"] == 3)) {
    $sql = sprintf("SELECT * FROM producers WHERE pd_id=%s;", $_SESSION["user_id_system"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    ?>
    <?php
    if ($_SESSION["level"] == 2) {
        if (!empty($row["pd_image"])) {
            ?>
            <div class="text-center">
                <img src="img/profix/<?= $row["pd_image"] ?>" width="200px" class="rounded-circle"/>
            </div>
            <?php
        } else {
            ?>
            <div class="text-center">
                <img src="//placehold.it/200" width="200px" class="rounded-circle"/>
            </div>
            <?php
        }
    }
    ?>
    <br>
    <div class="card">
        <div class="card-header bg-success text-white"><h4><i class="fa fa-user-circle" aria-hidden="true"></i>
                ข้อมูลของฉัน</h4></div>
        <div class="card-body">
            <?php
            if ($_SESSION["level"] == 3) {
                ?>
                <label>สถานะ :</label>
                <label class="text-warning"> รออนุมัติจากผู้ดูแลระบบ</label>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label>คำนำหน้า : <?= $row["pd_prefix"] ?></label>
                </div>
                <div class="col-sm-5">
                    <label>ชื่อ : <?= $row["pd_name"] ?></label>
                </div>
                <div class="col-sm-5">
                    <label>นามสกุล : <?= $row["pd_lastname"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>วัน-เดือน-ปีเกิด : <?= $row["pd_birthday"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>เลขบัตรประชาชน : <?= $row["pd_card_number"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>ที่อยู่เลขที่ : <?= $row["pd_house_number"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>หมู่ : <?= $row["pd_mu"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>ตำบล : <?= $row["pd_district"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>อำเภอ : <?= $row["pd_city"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>จังหวัด : <?= $row["pd_province"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>เบอร์โทรศัพท์ : <?= $row["pd_tel"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>อีเมล์ : <?= $row["pd_email"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>Facebook : <?= $row["pd_facebook"] ?></label>
                </div>
                <div class="col-sm-4">
                    <label>Line : <?= $row["pd_line"] ?></label>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.href='?page=login';</script>";
}
?>
<br>
<div class="card">
    <div class="card-header bg-danger text-white"><h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            แก้ไขข้อมูล</h4></div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 text-center">
                <a href="main.php?page=change_data">
                    <button type="button" class="btn btn-outline-danger"><i class="fa fa-address-card-o"
                                                                            aria-hidden="true"></i> แก้ไขข้อมูลส่วนตัว
                    </button>
                </a>
            </div>
            <br>
            <br>
            <div class="col-sm-4 text-center">
                <a href="main.php?page=change_key">
                    <button type="button" class="btn btn-outline-danger"><i class="fa fa-key" aria-hidden="true"></i>
                        เปลี่ยนรหัสผ่าน
                    </button>
                </a>
            </div>
            <br>
            <br>
            <?php
            if ($_SESSION["level"] == 2) {
                ?>
                <div class="col-sm-4 text-center">
                    <a href="main.php?page=img_store">
                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-picture-o"
                                                                                aria-hidden="true"></i> แก้ไขรูปโปรไฟล์
                        </button>
                    </a>
                </div>
                <div class="col-sm-12 text-center">
                    <a href="main.php?page=position">
                        <button type="button" class="btn btn-outline-success"><i class="fa fa-map-marker"
                                                                         aria-hidden="true"></i> ตำแหน่ง
                        </button>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
