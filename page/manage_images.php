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
    $sql = sprintf("SELECT * FROM `garden` WHERE producers_pd_id=%s AND gd_id = %s", $_SESSION["user_id_system"], $_GET["id"]);

    $con = new db();
    $con = $con->selects($sql);
    if (mysql_num_rows($con) == 0) {
        echo "<script>window.location.href='?page=manage_garden';</script>";
    } else {
        $row = mysql_fetch_assoc($con);
        $name = $row["gd_name"];
    }
    $sql = sprintf("SELECT * FROM `imggarden` WHERE garden_gd_id='%s' ORDER BY img_gd_id DESC", $_GET["id"]);

    $con = new db();
    $con = $con->selects($sql);
    ?>

    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>จัดการรูปสวนผล <?= $name ?></h4></div>
        <div class="card-body">
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
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tr>
                                <td width="200px">
                                    <img class="card-img-top" src="img/orchard/<?= $row["img_gd_name"] ?>"
                                         alt="Card image">
                                </td>
                                <td>
                                    <a href="config/delete.php?idorchard=<?= $row["img_gd_id"] ?>&id=<?=$_GET["id"]?>">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="return confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่!!')"><i
                                                    class="fa fa-trash-o"
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
    <br>
    <div class="card">
        <div class="card-header bg-success text-white">เพิ่มรูปภาพให้สวน : <?= $name ?></div>
        <div class="card-body">
            <form method="post" action="config/insert.php" enctype="multipart/form-data">
                <input type="hidden" name="garden_id" value="<?= $_GET["id"] ?>">
                <input id="file-input" type="file" name="upload[]" multiple><br>
                <div id="preview"></div>
                <br>
                <button type="submit" name="manage_images" value="1" class="btn btn-primary">บันทึก</button>
                <button type="button" class="btn btn-danger" onclick="window.location.reload()">ยกเลิก</button>
            </form>

            <script>
                function previewImages() {

                    var preview = document.querySelector('#preview');

                    if (this.files) {
                        [].forEach.call(this.files, readAndPreview);
                    }

                    function readAndPreview(file) {

                        // Make sure `file.name` matches our extensions criteria
                        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                            return alert(file.name + " กรุณาตรวจสอบไฟล์รูปของท่าน");
                        } // else...

                        var reader = new FileReader();

                        reader.addEventListener("load", function () {
                            var image = new Image();
                            image.height = 100;
                            image.title = file.name;
                            image.src = this.result;
                            preview.appendChild(image);
                        }, false);

                        reader.readAsDataURL(file);

                    }

                }

                document.querySelector('#file-input').addEventListener("change", previewImages, false);
            </script>
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