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
    $sql = sprintf("SELECT * FROM producers INNER JOIN login ON producers.pd_id = login.ln_user_id WHERE login.ln_type = 2 ORDER BY pd_id DESC");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>รายงานผู้ผลิตทั้งหมด</h4></div>
        <div class="card-body">
            <a href="report/report_producers.php" class="btn btn-primary float-right" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a><br><br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ป-ด-ว เกิด</th>
                        <th>เลขประชาชน</th>
                        <th>ที่อยู่เลขที่</th>
                        <th>หมู่</th>
                        <th>ตำบล</th>
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>อีเมล์</th>
                        <th>Facebook</th>
                        <th>Line</th>
                        <th>ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysql_fetch_assoc($con)) {
                        ?>
                        <tr>
                            <th><?= $row["pd_prefix"] ?><?= $row["pd_name"] ?>  <?= $row["pd_lastname"] ?></th>
                            <th><?= $row["pd_birthday"] ?></th>
                            <th><?= $row["pd_card_number"] ?></th>
                            <th><?= $row["pd_house_number"] ?></th>
                            <th><?= $row["pd_mu"] ?></th>
                            <th><?= $row["pd_district"] ?></th>
                            <th><?= $row["pd_city"] ?></th>
                            <th><?= $row["pd_province"] ?></th>
                            <th><?= $row["pd_tel"] ?></th>
                            <th><?= $row["pd_email"] ?></th>
                            <th><?= $row["pd_facebook"] ?></th>
                            <th><?= $row["pd_line"] ?></th>
                            <th>
                                <a href="config/delete.php?idproducer=<?= $row["pd_id"] ?>">
                                    <button type="button" class="btn btn-danger btn-sm"
                                            onclick="return confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่!!')"><i
                                                class="fa fa-trash-o"
                                                aria-hidden="true"></i>
                                    </button>
                                </a>
                            </th>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });
        });
    </script>

    <?php
} else {
    echo "<script>window.location.href='main.php?page=login';</script>";
}
?>