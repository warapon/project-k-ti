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
if (!empty($_SESSION["user_id_system"]) AND !empty($_SESSION["level"]) AND $_SESSION["level"] == 2) {
    $sql = sprintf("SELECT * FROM `position` WHERE pt_pd_id = %s", $_SESSION["user_id_system"]);

    $con = new db();
    $con = $con->selects($sql);
    $num = mysql_num_rows($con);
    $row = mysql_fetch_assoc($con);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>MAP</h4></div>
        <div class="card-body">
            <?php
            if ($num > 0) {
                ?>
                <form method="post" action="config/update.php">

                    <div class="row">
                        <input type="hidden" name="id" value="<?= $row["pt_id"] ?>">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ละติจูด</label>
                                <input type="text" name="lat" value="<?= $row["pt_lat"] ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ลองจิจูด</label>
                                <input type="text" name="long" value="<?= $row["pt_long"] ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" name="position" value="1" class="btn btn-outline-success"><i
                                        class="fa fa-male"
                                        aria-hidden="true"></i> บันทึกการแก้ไข
                            </button>
                            <a href="?page=setting">
                                <button type="button" class="btn btn-outline-danger"><i class="fa fa-times-circle"
                                                                                aria-hidden="true"></i> ยกเลิก
                                </button>
                            </a>
                        </div>

                    </div>
                </form>
                <?php
            } else {
                ?>

                <form method="post" action="config/insert.php">

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="text-center">-- ยังไม่มีตำแหน่ง MAP กรุณาเพิ่ม --</p>
                        </div>
                        <input type="hidden" name="id" value="<?= $_SESSION["user_id_system"] ?>">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ละติจูด</label>
                                <input type="text" name="lat" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ลองจิจูด</label>
                                <input type="text" name="long" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" name="position" value="1" class="btn btn-outline-success"><i
                                        class="fa fa-male"
                                        aria-hidden="true"></i> เพิ่ม
                            </button>
                            <a href="?page=setting">
                                <button type="button" class="btn btn-outline-danger"><i class="fa fa-times-circle"
                                                                                aria-hidden="true"></i> ยกเลิก
                                </button>
                            </a>
                        </div>

                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
?>
