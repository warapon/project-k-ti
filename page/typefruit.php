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
    $sql = sprintf("SELECT * FROM `fruittype` ORDER BY ft_id DESC");

    $con = new db();
    $con = $con->selects($sql);
    ?>

    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>จัดการชนิดผลไม้</h4></div>
        <div class="card-body">
            <p>
                <a href="?page=addtypefruit">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"
                                                                            aria-hidden="true"></i> เพิ่มชนิดผลไม้
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
                            <th>รูปภาพ</th>
                            <th>ชื่อชนิด</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tr>
                                <td width="200px">
                                    <img class="card-img-top" src="img/type/<?= $row["ft_image"] ?>"
                                         alt="Card image">
                                </td>
                                <td><?= $row["ft_nametype"] ?></td>
                                <td>
                                    <a href="config/delete.php?idtype=<?= $row["ft_id"] ?>">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="return confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่!!')"><i
                                                    class="fa fa-trash-o"
                                                    aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="?page=edittypefruit&idfruit=<?= $row["ft_id"] ?>">
                                        <button type="button" class="btn btn-warning btn-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
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