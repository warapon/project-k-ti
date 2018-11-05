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
}
if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
    $sql = sprintf("SELECT * FROM login INNER JOIN producers ON login.ln_user_id = producers.pd_id 
                    WHERE login.ln_type = 3");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <?php
                    if (mysql_num_rows($con) == 0) {
                        echo "<div class='text-danger text-center'>ไม่พบข้อมูลคำขอ</div>";
                    } else {
                        ?>
                        <thead>
                        <tr>
                            <th>ชื่อ-นามสกุล</th>
                            <th>วันที่ลงทะเบียน</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <?php
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tbody>
                            <tr>
                                <td><?= $row["pd_prefix"] ?><?= $row["pd_name"] ?>  <?= $row["pd_lastname"] ?></td>
                                <td><?= $row["pd_day_register"] ?></td>
                                <td><a href="config/update.php?idconfraim=<?= $row["ln_id"] ?>">
                                        <button type="button" class="btn btn-outline-warning btn-sm">ยืนยัน</button>
                                </td>
                                </a>
                            </tr>
                            </tbody>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
}
?>