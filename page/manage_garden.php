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
if (!empty($_SESSION["user_id_system"])) {
    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE producers.pd_id = %s;", $_SESSION["user_id_system"]);

    $con = new db();
    $con = $con->selects($sql);
    ?>

    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>จัดการสวน/ไร่</h4></div>
        <div class="card-body">
            <p>
                <a href="?page=addgraden">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"
                                                                            aria-hidden="true"></i> เพิ่มสวน/ไร่
                    </button>
                </a>
            </p>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <?php
                    if (mysql_num_rows($con) == 0) {
                        echo "<div class='text-danger text-center'>ไม่มีข้อมูล</div>";
                    } else {
                        ?>
                        <thead>
                        <tr>
                            <th>ชื่อสวน/ไร่</th>
                            <th>ประเภทผลไม้</th>
                            <th>จำนวนพื้นที่/ไร่</th>
                            <th>กำลังผลิตต่อปี/ตัน</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tr>
                                <td><?= $row["gd_name"] ?></td>
                                <td><?= $row["ft_nametype"] ?></td>
                                <td><?= $row["gd_area_number"] ?></td>
                                <td><?= $row["gd_productivity"] ?></td>
                                <td>
                                    <?php
                                    if ($row["gd_status"] == 0) {
                                        ?>
                                        <a href="config/update.php?idstatus=<?= $row["gd_id"] ?>&status=on">
                                            <button type="button" class="btn btn-success btn-sm">ON</button>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="config/update.php?idstatus=<?= $row["gd_id"] ?>&status=off">
                                            <button type="button" class="btn btn-danger btn-sm">OFF</button>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <a href="?page=edit_garden&garden=<?= $row["gd_id"] ?>">
                                        <button type="button" class="btn btn-warning btn-sm"
                                                onclick="return confirm('ท่านต้องการแก้ไขรายการนี้ใช่หรือไม่!!')"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="config/delete.php?idstatus=<?= $row["gd_id"] ?>">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="return confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่!!')"><i
                                                    class="fa fa-trash-o"
                                                    aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <?php
                                    if ($row["gd_status"] == 1) {
                                        ?>
                                        <a href="?page=detail&id=<?= $row["gd_id"] ?>" target="_blank">
                                            <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-external-link"
                                                        aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <a href="?page=manage_images&id=<?= $row["gd_id"] ?>">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-picture-o"
                                                                                                aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        <?php
                    }
                    ?>
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
    echo "<script>window.location.href='index.php';</script>";
}
?>