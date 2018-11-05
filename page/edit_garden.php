<?php
if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 2) {
    $sql_garden = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id
 WHERE garden.gd_id = %s AND garden.producers_pd_id = %s", $_GET["garden"], $_SESSION["user_id_system"]);

    $con_garden = new db();
    $con_garden = $con_garden->selects($sql_garden);
    if (mysql_num_rows($con_garden) == 0) {
        echo "<script>window.location.href='?page=manage_garden';</script>";
    } else {
        $row_garden = mysql_fetch_assoc($con_garden);
    }

    $sql = sprintf("SELECT * FROM fruittype ");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>แก้ไขข้อมูลสวน/ไร่</h4></div>
        <div class="card-body">
            <form method="post" action="config/update.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ชื่อสวน/ไร่</label>
                            <input type="text" name="gd_name" value="<?= $row_garden["gd_name"] ?>" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ชนิดผลไม้</label>
                            <select class="form-control" name="fruittype_ft_id" id="sel1" required>
                                <?php
                                if (mysql_num_rows($con) == 0) {
                                    echo "<option>ไม่พบข้อมูลที่ต้องการค้นหา</option>";
                                } else {
                                    ?>
                                    <option value="<?= $row_garden["ft_id"] ?>"><?= $row_garden["ft_nametype"] ?></option>
                                    <?php
                                }
                                while ($row = mysql_fetch_assoc($con)) {
                                    ?>
                                    <option value="<?= $row["ft_id"] ?>"><?= $row["ft_nametype"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>จำนวนพื้นที่/ไร่</label>
                            <input type="number" name="gd_area_number" value="<?= $row_garden["gd_area_number"] ?>"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>กำลังผลิตต่อปี/ตัน</label>
                            <input type="number" name="gd_productivity" value="<?= $row_garden["gd_productivity"] ?>"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รายละเอียด</label>
                            <textarea class="form-control" rows="5" id="comment" name="gd_detail"
                                      required><?= $row_garden["gd_detail"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รูปภาพ</label>
                            <img id="output" src="img/garden/<?= $row_garden["gd_img"] ?>" class="rounded"
                                 width="200px"/>
                            <input type="file" accept="image/*" name="fileupload" onchange="loadFile(event)">
                            <script>
                                var loadFile = function (event) {
                                    var reader = new FileReader();
                                    reader.onload = function () {
                                        var output = document.getElementById('output');
                                        output.src = reader.result;
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                };
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="updategraden" value="<?= $_GET["garden"] ?>"
                                class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> แก้ไข
                        </button>
                        <a href="?page=manage_garden">
                            <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"
                                                                             aria-hidden="true"></i> ยกเลิก
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>