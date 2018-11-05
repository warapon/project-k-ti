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
if (!empty($_SESSION["user_id_system"]) AND !empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
    $sql = sprintf("SELECT * FROM producers ORDER BY pd_id DESC");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>ข้อมูลจากชื่อผู้ผลิต</h4></div>
        <div class="card-body">
            <p class="text-danger">*สามารถใส่ ชื่อ หรือ นามสกุล เพื่อค้นหาชื่อผู้ผลิต</p>
            <input class="form-control" id="myInput" autofocus type="text" placeholder="Search..">
            <br>
            <ul class="list-group" id="myList">
                <?php
                while ($row = mysql_fetch_assoc($con)) {
                    ?>
                    <a href="?page=report_user&garden=<?=$row["pd_id"]?>"><li class="list-group-item"><?= $row["pd_prefix"] ?><?= $row["pd_name"] ?>  <?= $row["pd_lastname"] ?></li></a>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <?php
} else {
    echo "<script>window.location.href='main.php?page=login';</script>";
}
?>