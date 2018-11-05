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
    $sql = sprintf("SELECT * FROM `buyers` ORDER BY by_id DESC");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>ข้อมูลผู้ซื้อ</h4></div>
        <div class="card-body">
            <a href="report/report_buyers.php" class="btn btn-primary float-right" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> พิมพ์</a><br><br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เลขประชาชน</th>
                        <th>ชื่อบริษัท</th>
                        <th>ที่อยู่เลขที่</th>
                        <th>หมู่</th>
                        <th>ตำบล</th>
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>อีเมล์</th>
                        <th>ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysql_fetch_assoc($con)) {
                        ?>
                        <tr>
                            <th><?= $row["by_prefix"] ?><?= $row["by_name"] ?>  <?= $row["by_lastname"] ?></th>
                            <th><?= $row["by_card_number"] ?></th>
                            <th><?= $row["by_company"] ?></th>
                            <th><?= $row["by_addass_number"] ?></th>
                            <th><?= $row["by_m"] ?></th>
                            <th><?= $row["by_district"] ?></th>
                            <th><?= $row["by_citty"] ?></th>
                            <th><?= $row["by_province"] ?></th>
                            <th><?= $row["by_tel"] ?></th>
                            <th><?= $row["by_email"] ?></th>
                            <th>
                                <a href="config/delete.php?idbuyer=<?= $row["by_id"] ?>">
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