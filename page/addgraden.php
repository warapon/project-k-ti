<?php
if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 2) {
    $sql = sprintf("SELECT * FROM fruittype ");

    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>เพิ่มสวน/ไร่</h4></div>
        <div class="card-body">
            <form method="post" action="config/insert.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ชื่อสวน/ไร่</label>
                            <input type="text" name="gd_name" class="form-control" required>
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
                                    <option></option>
                                    <?php
                                }
                                while ($row = mysql_fetch_assoc($con)) {
                                    ?>
                                    <option value="<?=$row["ft_id"]?>"><?=$row["ft_nametype"]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>จำนวนพื้นที่/ไร่</label>
                            <input type="number" name="gd_area_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>กำลังผลิตต่อปี/ตัน</label>
                            <input type="number" name="gd_productivity" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รายละเอียด</label>
                            <textarea class="form-control" rows="5" id="comment" name="gd_detail" required></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รูปภาพ</label>
                            <img id="output" class="rounded" width="200px"/>
                            <input type="file" accept="image/*" name="fileupload" onchange="loadFile(event)" required>
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
                        <button type="submit" name="addgraden" value="1" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> ยืนยัน
                        </button>
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